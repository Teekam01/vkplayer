@extends('admin.master')


@section('head')
<title> Battle Running </title>

<!--<script> 
   var auto_refresh = setInterval(
     function(){
		 $('#tableRUNNING').load('<?php echo url('/admin/battle_result_table/'); ?>');
	 },500);
   
</script>-->
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Battles Result</h1>
	 @if(session()->has('success'))
							<div class="alert alert-success">
								{{ session()->get('success') }}
							</div>
							@endif
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">ALL BATTLE</h6>
		</div>
		<div class="card-body" id="tableRUNNING">

			<div class="table-responsive">

				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

					<thead>
						<tr>
							<th>#</th>
							<th>Battle ID</th>
							<th>Entry Fee</th>
							<th>Winning Price</th>
							<th>Admin Commission</th>
							<th>Room Code</th>
							<th>Ludo Type</th>
							<th>Battle Create</th>
							<th>Status</th>
							@if(Auth::user()->user_type == '1' || $permission->battle_result == true)
							<th>Action</th>
							@endif
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Battle ID</th>
							<th>Entry Fee</th>
							<th>Winning Price</th>
							<th>Admin Commission</th>
							<th>Room Code</th>
							<th>Ludo Type</th>
							<th>Battle Create</th>
							<th>Status</th>
							@if(Auth::user()->user_type == '1' || $permission->battle_result == true)
							<th>Action</th>
							@endif
						</tr>
					</tfoot>

					<tbody>
						<?php $i=1; ?>
						@foreach($battles as $battle)
						<tr>
							<td>{{ $i }}</td>
							
							<td><img src="{{asset('frontend/images/battle.png')}}" style="width:15px" alt=""> {{ $battle->battle_id }}</td>
							<td>₹ {{ $battle->entry_fee }}</td>
							<td>₹ {{ $battle->prize }}</td>
							<td>{{ $battle->admin_commision }}</td>
							<td>{{ $battle->LOBBY_ID }}</td>
							<td>
								<?php 
									 $game = App\Game::where('id',$battle->game_id)->first();
								?>
								{{ $game->game_name }}
							</td>
							<?php 
											$date_time = explode(" ", $battle->created_at);
											$date = $date_time[0];
											$date_explode = explode("-", $date);
											$year = $date_explode[0];
											$month = $date_explode[1];
											$day = $date_explode[2];
											$time = $date_time[1];
											?>
							<td>{{$day}} / {{ $month }} / {{ $year }} {{$time}}</td>
							@if(Auth::user()->user_type == '1' || $permission->battle_result == true)
							<td>
								@if($battle->creator_result =='win'  &&  $battle->joiner_result =="lost")
							 	  <a href="{{ url('admin/battle-view/'.$battle->id) }}" class="btn btn-success">Approved</a>
								   @elseif($battle->creator_result=='lost' && $battle->joiner_result=='win')
								   <a href="{{ url('admin/battle-view/'.$battle->id) }}" class="btn btn-success">Approved</a>
								  @elseif($battle->creator_result=='cancel' && $battle->joiner_result=='cancel')
								  <a href="{{ url('/admin/battle-view/'.$battle->id) }}" class="btn btn-warning">Cancelled</a>
								  @elseif($battle->creator_result=='lost' && $battle->joiner_result=='lost')
								  <a href="{{ url('/admin/battle-pending/'.$battle->id) }}" class="btn btn-danger">Pending</a>
								   @elseif($battle->creator_result=='lost' && $battle->joiner_result=='cancel')
								  <a href="{{ url('/admin/battle-pending/'.$battle->id) }}" class="btn btn-danger">Pending</a>
								  @elseif($battle->creator_result=='win' && $battle->joiner_result=='win')
								  <a href="{{ url('/admin/battle-pending/'.$battle->id) }}" class="btn btn-danger">Pending</a>
								  @elseif($battle->creator_result=='cancel' && $battle->joiner_result=='win')
								  <a href="{{ url('/admin/battle-pending/'.$battle->id) }}" class="btn btn-danger">Pending</a>
								  @elseif($battle->creator_result=='cancel' && $battle->joiner_result=='lost')
								  <a href="{{ url('/admin/battle-pending/'.$battle->id) }}" class="btn btn-danger">Pending</a>
								  @elseif($battle->creator_result=='win' && $battle->joiner_result=='cancel')
								  <a href="{{ url('/admin/battle-pending/'.$battle->id) }}" class="btn btn-danger">Pending</a>
								  @elseif($battle->winner_id=='0' || $battle->loser_id=='0' && $battle->approve=='0')
								  <a href="{{ url('/admin/battle-pending/'.$battle->id) }}" class="btn btn-danger">Pending</a>
								@endif
							</td>
							@endif
							<td>
								<a href="{{ url('admin/battle-view/'.$battle->id) }}" class="btn btn-info">View</a>
								
							</td>
						</tr>
						<?php $i++; ?>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
	</div>

</div>
<!-- /.container-fluid -->


@endsection
