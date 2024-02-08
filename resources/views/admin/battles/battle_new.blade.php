@extends('admin.master')


@section('head')
<title> New Battle </title>


@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">New Battles</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">ALL NEW BATTLE</h6>
		</div>
		<div class="card-body" id="tablenew">

			<div class="table-responsive">

				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

					<thead>
						<tr>
							<th>#</th>
							<th>Battle ID</th>
							<th>Battle Creator</th>
							<th>Entry Fee</th>
							<th>Winning Price</th>
							<th>Room Code</th>
							<th>Ludo Type</th>
							<th>Battle Create</th>	
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Battle ID</th>
							<th>Battle Creator</th>
							<th>Entry Fee</th>
							<th>Winning Price</th>
							<th>Room Code</th>
							<th>Ludo Type</th>
							<th>Battle Create</th>	
						</tr>
					</tfoot>

					<tbody>
						<?php $i=1; ?>
						@foreach($battles as $battle)
						<tr>
							<td>{{ $i }}</td>
							<td><img src="{{asset('frontend/images/battle.png')}}" style="width:15px" alt=""> {{ $battle->battle_id }}</td>
							
							
							<?php $user_details = App\User::where('id', $battle->creator_id)->first(); ?>
							<td><a href="{{ url('admin/player-view/'.$battle->creator_id) }}">{{ $user_details->vplay_id }}</a></td>
							<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> {{ $battle->entry_fee }}</td>
							<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> {{ $battle->prize }}</td>
							<td><i class="fa-solid fa-house" style="color:#5779c6"></i> {{ $battle->LOBBY_ID }}</td>
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
