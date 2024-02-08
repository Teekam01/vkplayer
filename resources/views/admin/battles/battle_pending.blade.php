@extends('admin.master')


@section('head')
<title> Battle View </title>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Battle Pending Page </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">

		<div class="card-body">
			<div class="co-md-12" style="padding:30px">
				<div class="row" align="center">
					<div class="col-md-4" align="center">
						<img src="{{asset('frontend/images/avatars/Avatar2.png')}}" style="width:120px; height:auto; border:5px solid #395fcf; border-radius:50%; ">

						<div style="margin-top:20px; color: #395fcf">
							<a href="{{ url('/admin/player-view/'.$creator_details->id) }}">

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
									<h5> Battle Details</h5>
								</th>
							</tr>
							<tr>
								<th>Battle ID</th>
								<td><img src="{{asset('frontend/images/battle.png')}}" style="width:25px" alt=""> {{ $battle->battle_id }}</td>
								<th>Roomcode</th>
								<td><i class="fa-solid fa-house" style="color:#5779c6"></i> {{ $battle->LOBBY_ID }}</td>
							</tr>

							<tr>
								<th>Creator ID</th>
								<td> <a href="{{ url('admin/player-view/'.$creator_details->id) }}"><i class="fa-solid fa-user"></i> {{ $creator_details->vplay_id }}</a></td>
								<th>Joiner ID </th>
								<td> <a href="{{ url('admin/player-view/'.$joiner_details->id) }}"><i class="fa-solid fa-user"></i> {{ $joiner_details->vplay_id }}</a></td>
							</tr>
							<tr>
								<th>Creator Result</th>
								<!--<td>@if($battle->creator_result == 'win')<img src="{{asset('frontend/images/win.png')}}" style="width:25px"> WIN @else <img src="{{ asset('frontend/images/lost.png') }}" style="width:25px"> LOST @endif</td>
								<th>Joiner Result</th>
								<td>@if($battle->joiner_result == 'win')<img src="{{asset('frontend/images/win.png')}}" style="width:25px"> WIN @else <img src="{{ asset('frontend/images/lost.png') }}" style="width:25px"> LOST @endif</td>-->
								<td>
									@if($battle->creator_result == 'win')
								  <img src="{{asset('frontend/images/win.png')}}" style="width:25px"> WIN
								@elseif($battle->creator_result == 'lost')
								  <img src="{{ asset('frontend/images/lost.png') }}" style="width:25px"> LOST
								@elseif($battle->creator_result == null)
								  <span class="text text-danger">NOT UPDATED</span>
								@elseif($battle->creator_result == 'cancel')
								   <span class="text text-danger">NOT UPDATED</span>
								@endif
								</td>
								<th>Joiner Result</th>
								<td>
								@if($battle->joiner_result == 'win')
								  <img src="{{asset('frontend/images/win.png')}}" style="width:25px"> WIN
								@elseif($battle->joiner_result == 'lost')
								  <img src="{{ asset('frontend/images/lost.png') }}" style="width:25px"> LOST
								@elseif($battle->joiner_result == null)
									<span class="text text-danger">NOT UPDATED</span>
								@elseif($battle->joiner_result == 'cancel')
									  <span class="text text-danger">NOT UPDATED</span>
								@endif
								
									
								</td>
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
									@endif
								</td>
								<th>Is Running</th>
								<td>@if($battle->is_running=='yes')
									Running
									@else
									Not Running
									@endif
								</td>
							</tr>



							<tr>
								<th>Battle Created At</th>
								<td>{{ $battle->created_at }}</td>
								<th>cancel reason</th>
								<td>{{ $battle->cancel_reason }}</td>
							</tr>
						</table>
					</div>

					<div class="col-md-12">
						<table class="table table-striped table-dec">
							<tr style="background-color:#4e73df; color:white; font-weight:600">
								<th colspan="4">
									<h5 style="color:white"> Decision Section 
									@if($battle->admin_update_again == 1 )
									 (Admin Update Again)
									@endif
									</h5>
								</th>
							</tr>
							<tr>
								<th colspan="2" style="background-color:#75c0c6; color:white">Player One Submitted Details</th>
								<th colspan="2" style="background-color:#75c0c6; color:white">Player Two Submitted Details</th>
							</tr>
							<tr>
								<th>Result</th>
								<td>{{ $battle->creator_result }}</td>
								<th>Result</th>
								<td>{{ $battle->joiner_result }}</td>
							</tr>
							<tr>
								<th>Result Submitted Date and Time</th>
								<td>@if(isset($battle->creator_result_time)) {{ $battle->creator_result_time }} @else NOT AVALIABLE @endif</td>
								<th>Result Submitted Date and Time</th>
								<td>@if(isset($battle->joiner_result_time)) {{ $battle->joiner_result_time }} @else NOT AVALIABLE @endif</td>
							</tr>
							<tr>
								<th>Creator Screenshot</th>
								<td>@if(isset($battle->creator_screenshot))
									<a href="{{ url('/public/images/screenshots/'.$battle->creator_screenshot) }}" target="_blank" class="btn btn-xs btn-info">View Image</a>
									@else
									Not Avaliable
									@endif
								</td>
								<th>Joiner Screenshot</th>
								<td>@if(isset($battle->joiner_screenshot))
									<a href="{{ url('/public/images/screenshots/'.$battle->joiner_screenshot) }}" target="_blank" class="btn btn-xs btn-info">View Image</a>
									@else
									Not Avaliable
									@endif
								</td>
							</tr>
							<tr>
								<th>Creator Cancel Reason</th>
								<td>{{ $battle->creator_cancel_reason }}</td>
							    <th>Joiner Cancel Reason</th>
								<td>{{ $battle->joiner_cancel_reason }}</td>
							</tr>
							<tr>
								<th colspan="2">Battle Created Date and Time</th>
								<td colspan="2">@if(isset($battle->created_at)) {{ $battle->created_at }} @else NOT AVALIABLE @endif</td>
							</tr>
							<tr>
								<th colspan="2">Battle Send Request Date and Time</th>
								<td colspan="2">@if(isset($battle->send_request_time)) {{ $battle->send_request_time }}@else NOT AVALIABLE @endif</td>
							</tr>
							<tr>
								<th colspan="2">Battle Accept Request Date and Time</th>
								<td colspan="2">@if(isset($battle->accept_request_time)) {{ $battle->accept_request_time }} @else NOT AVALIABLE @endif</td>
							</tr>
							
						</table>
						<div class="col-md-12">
						<form action="#" method="post" id="winner_id">
						<!-- <form action="{{ url('admin/update-result/'.$battle->id) }}" method="post"> -->
							<input type="hidden" name="winnername" id="winnernameid" value="{{$battle->id}}">
							@csrf
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label">Choose Winner</label>
									<div class="col-sm-10">
										<select name="winner" id="" class="form-control" required>
									    	<option value=" ">Choose One</option>
											<option value="{{ $battle->creator_id }}">{{ $creator_details->vplay_id }}</option>
											<option value="{{ $battle->joiner_id }}">{{ $joiner_details->vplay_id }}</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-2 col-form-label"></label>
									<div class="col-sm-10">
										<input type="submit" id="winnerdisabled" class="btn btn-primary" value="Save" placeholder="Password">
										<button  id="winnercancel" data-id="{{$battle->id}}" class="btn btn-danger">Cancel The Battle</button>
										<!-- <a href="{{ url('admin/cancel-battle/'.$battle->id) }}" class="btn btn-danger">Cancel The Battle</a> -->
									</div>
								</div>
							</form>
							
						</div>
						
					</div>
				</div>

			</div>

		</div>
	</div>



</div>
<!-- /.container-fluid -->
<style>
	.table-dec tr th {
		color: red
	}

</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">

	$("#winner_id").submit(function(){
		 event.preventDefault();
		 var win_id = $('#winnernameid').val();
       $('#winnerdisabled').prop('disabled', true);
        $.ajax({

              method: 'POST',
              url:"{{ url('admin/update-result/') }}/"+win_id,
              data: new FormData(this),
               contentType: false,
               cache: false,
               processData:false,
              headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
              success: function(data){
               // alert(data.url);
                 // var obj = JSON.parse(data);
                 if(data.status==true){
				swal({title: data.title, text: data.message, type: 
                    "success"}).then(function(){ 
                      window.location.href = data.url;
                     // $('#bettel_create_btn').prop('disabled', false);
                       }
                    );
				}
                // $("#module_id").html(data);
              }
        })
    })
</script>

<script type="text/javascript">
 $('#winnercancel').on('click',function(){
 	let button = $(this);
   let id = button.data('id');
   // Disable the button
     button.prop('disabled', true);
	  $.ajax({
        method: 'GET',
          url: "{{url('admin/cancel-battle/') }}/"+id,
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
          success: function(data){
             if(data.status==true){
				swal({title: data.title, text: data.message, type: 
                    "success"}).then(function(){ 
                      window.location.href = data.url;
                     // $('#bettel_create_btn').prop('disabled', false);
                       }
                    );
				}
	   }
    })
});
</script>
@endsection
