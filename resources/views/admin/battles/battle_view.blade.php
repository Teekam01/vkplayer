@extends('admin.master')


@section('head')
<title> Battle View </title>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Battle View </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">

		<div class="card-body">
			<div class="co-md-12" style="padding:30px">
				<div class="row" align="center">
					<div class="col-md-4" align="center">
						<img src="{{asset('frontend/images/avatars/Avatar2.png')}}" style="width:120px; height:auto; border:5px solid #395fcf; border-radius:50%; ">

						<div style="margin-top:20px; color: #395fcf">
							<a href="{{ url('/admin/player-view/'.$creator_details->id) }}">
							  <h3>
								  @if($battle->creator_result == 'win')<img src="{{asset('frontend/images/win.png')}}" style="width:55px"> <span style="color:black;  text-decoration:none; font-weight:800">Winner  </span>@else <img src="{{ asset('frontend/images/lost.png') }}" style="width:65px"> <span style="color:black;  text-decoration:none; font-weight:800">Loser </span> @endif
								</h3>
								<h3><i class="fa-solid fa-id-card-clip"></i> {{ $creator_details->vplay_id }}</h3>
								<h3><i class="fa-solid fa-phone-volume"></i> {{ $creator_details->mobile }}</h3>
								
							</a>
						</div>
					</div>
				
					<div class="col-md-4" align="center">
						<img src="{{asset('/public/backend/img/vs.png')}}" style="width:60%;">
					</div>
					
					<div class="col-md-4" align="center">
						<img src="{{asset('frontend/images/avatars/Avatar2.png')}}" style="width:120px; height:auto; border:5px solid #395fcf; border-radius:50%; ">

						<div style="margin-top:20px; color: #395fcf">
							<a href="{{ url('/admin/player-view/'.$joiner_details->id) }}">
						      <h3>
								  @if($battle->joiner_result == 'win')<img src="{{asset('frontend/images/win.png')}}" style="width:55px"> <span style="color:black;  text-decoration:none; font-weight:800">Winner </span>@else <img src="{{ asset('frontend/images/lost.png') }}" style="width:65px"> <span style="color:black;  text-decoration:none; font-weight:800">Loser</span>  @endif
								</h3>
							    <h3><i class="fa-solid fa-id-card-clip"></i> {{ $joiner_details->vplay_id }}</h3>
							     <h3><i class="fa-solid fa-phone-volume"></i> {{ $joiner_details->mobile }}</h3>
							</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped ">
							<tr style="background-color:#4e73df; color:white; font-weight:600">
								<th colspan="4">
									<h5> Battle Details @if($battle->approve == 'approved') <span class="btn btn-info"> Approved </span> @else <span class="btn btn-danger"> Pending </span> @endif </h5>
								</th>
							</tr>
							<tr>
								<th>Battle ID</th>
								<td><img src="{{asset('frontend/images/battle.png')}}" style="width:25px" alt=""> {{ $battle->battle_id }}</td>
								<th>Roomcode</th>
								<td><i class="fa-solid fa-house" style="color:#5779c6"></i> {{ $battle->LOBBY_ID }}</td>
							</tr>
							<tr>
								<th>Admin Comission</th>
								<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> ₹ {{ $battle->admin_commision }}</td>
								<th></th>
								<td></td>
							</tr>
							<tr>
								<th>Reffer Person</th>
								<td>
								<?php $reffer = App\User::where('id', $battle->reffer_id)->first();  ?>
									<a href="{{ url('admin/player-view/'.$battle->reffer_id) }}"><i class="fa-solid fa-user"></i> @if(isset($reffer)) {{  $reffer->vplay_id }}  @else  {{  $battle->reffer_id }}@endif</a>
								</td>
								<th>Reffer Comission</th>
								<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> ₹ {{ $battle->reffer_comission }}</td>
							</tr>
							<tr>
								<th>Creator ID</th>
								<td>	<a href="{{ url('admin/player-view/'.$creator_details->id) }}"><i class="fa-solid fa-user"></i> {{ $creator_details->vplay_id }}</a></td>
								<th>Joiner ID </th>
									<td>	<a href="{{ url('admin/player-view/'.$joiner_details->id) }}"><i class="fa-solid fa-user"></i> {{ $joiner_details->vplay_id }}</a></td>
							</tr>
							<tr>
								<th>Creator Result</th>
								<td>@if($battle->creator_result == 'win')<img src="{{asset('frontend/images/win.png')}}" style="width:25px"> WIN @else <img src="{{ asset('frontend/images/lost.png') }}" style="width:25px">  LOST @endif</td>
								<th>Joiner Result</th>
								<td>@if($battle->joiner_result == 'win')<img src="{{asset('frontend/images/win.png')}}" style="width:25px"> WIN @else <img src="{{ asset('frontend/images/lost.png') }}" style="width:25px"> LOST @endif</td>
							</tr>
							<tr>
								<th>Entry Fee</th>
								<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> ₹ {{ $battle->entry_fee }}</td>
								<th>Prize</th>
								<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> ₹ {{ $battle->prize }}</td>
							</tr>
							<tr>
								<th>Game Status</th>
								<td>@if($battle->game_status=='1') 
									New
								    @elseif($battle->game_status=='2')
								    Running
								    @elseif($battle->game_status=='3')
									<span class="text text-success">Completed</span>
								    @endif </td>
								<th>Is Running</th>
								<td>@if($battle->is_running=='yes') 
									Running
								    @else
								    Not Running
								    @endif
								</td>
							</tr>
							<tr>
								<th>Winner</th>
								<td><?php $winner = App\User::where('id', $battle->winner_id)->first();  ?>
									<a href="{{ url('admin/player-view/'.$battle->winner_id) }}"><i class="fa-solid fa-user"></i> @if(isset($winner)) {{  $winner->vplay_id }}  @else  {{  $battle->winner_id }}@endif</a>
							    </td>
								<th></th>
							     	<td></td>
							</tr>
							<tr>
								<th>Creator Screenshot</th>
								<td>@if(isset($battle->creator_screenshot)) 
									<a href="{{ url('/public/images/screenshots/'.$battle->creator_screenshot) }}" target="_blank" class="btn btn-xs btn-info">View Image</a>
								    @else
								    Not Avaliable
								    @endif</td>
								 <th>Joiner Screenshot</th>
								<td>@if(isset($battle->joiner_screenshot)) 
									<a href="{{ url('/public/images/screenshots/'.$battle->joiner_screenshot) }}" target="_blank" class="btn btn-xs btn-info">View Image</a>
								    @else
								    Not Avaliable
								    @endif</td>
							</tr>
							<tr>
								<th>Creator Cancel Reason</th>
								<td>{{ $battle->creator_cancel_reason }}</td>
								 <th>Joiner Cancel Reason</th>
								<td>{{ $battle->joiner_cancel_reason }}</td>
							</tr>
							<tr>
								<th>Loser</th>
								<td><?php $loser = App\User::where('id', $battle->loser_id)->first();  ?>
									<a href="{{ url('admin/player-view/'.$battle->loser_id) }}"><i class="fa-solid fa-user"></i> @if(isset($loser)) {{  $loser->vplay_id }}  @else  {{  $battle->loser_id }}@endif</a>
								</td>
								
							</tr>
							<tr>
								<th>Condition</th>
								<td>@if(isset($battle->label)) 
									{{ $battle->label }}
								    @else
								    Not Avaliable
								    @endif</td>
								    <th></th>
							     	<td></td>
							</tr>
							<tr>
								<th>Battle Created At</th>
								<td>{{ $battle->created_at }}</td>
								<th></th>
							     	<td></td>
							</tr>
							<tr>
								<th>Battle Send Request Date and Time</th>
								<td>@if(isset($battle->send_request_time)) {{ $battle->send_request_time }}@else NOT AVALIABLE  @endif</td>
								<th>Battle Send Request Date and Time</th>
								<td>@if(isset($battle->send_request_time)) {{ $battle->send_request_time }}@else NOT AVALIABLE  @endif</td>
							</tr>
							<tr>
								<th>Creator Result Submit on</th>
								<td>@if(isset($battle->creator_result_time)) {{ $battle->creator_result_time }} @else NOT AVALIABLE  @endif</td>
								<th>Joiner Result Submit on</th>
								<td>@if(isset($battle->joiner_result_time)) {{ $battle->joiner_result_time }} @else NOT AVALIABLE  @endif</td>
							</tr>
						</table>
					</div>
				</div>

			</div>
			
		</div>
	</div>
</div>
</div>

</div>
<!-- /.container-fluid -->


@endsection
