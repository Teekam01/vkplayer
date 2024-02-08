@extends('admin.master')


@section('head')
<title> Withdraw View </title>
@endsection


@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</a> Withdraw Request View </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Withdraw Request Full Details View</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<h5>Withdraw Request Details</h5>
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<tbody>
									<tr>
										<th>Requset ID</th>
										<td>#{{ $request->withdraw_id }}</td>
									</tr>
									<tr>
										<th>Amount</th>
										<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> {{ $request->amount }}</td>
									</tr>
									<tr>
										<th>Status</th>
										<td>
											@if($request->status == 'process')
												<span style="color:#d9c000; font-weight:800">Process</span>
                                              @elseif($request->status == 'success')
                                                <span style="color:green; font-weight:800">Success</span>
                                              @else
                                                <span style="color:red; font-weight:800">Reject</span>  
                                              @endif
										</td>
									</tr>
									<tr>
										<th>Tranfer Via</th>
										<td>
                               		    	<span>{{$request->get_amount_via}}</span>
                                		</td>
									</tr>
									<tr>
										<th>Created At</th>
										<?php 
												$date_time = explode(" ", $request->created_at);
												$date = $date_time[0];
												$date_explode = explode("-", $date);
												$year = $date_explode[0];
												$month = $date_explode[1];
												$day = $date_explode[2];
												$time = $date_time[1];
											?>
										<td>
											<i class="fa-regular fa-clock"></i>
											{{$day}} / {{ $month }} / {{ $year }} {{$time}}
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
							<h5>User Details</h5>
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<tbody>
									<tr>
										<th>User</th>
										@if(isset($userDetails))
										<td>{{ $userDetails->vplay_id }}</td>
										@endif
									</tr>
									<tr>
										<th>Mobile</th>
										@if(isset($userDetails))
										<td>{{ $userDetails->mobile }}</td>
										@endif
									</tr>
									<tr>
										<th>Email</th>
										@if(isset($userDetails))
										<td>{{ $userDetails->email }}</td>
										@endif
									</tr>
									<tr>
									<?php $userDATA = App\UserData::where('user_id', $userDetails->id)->first(); ?>
										<th>Verified or, Not</th>
										<td>
										@if($userDATA->verify_satatus == 1)
										<img src="{{ asset('/backend/img/verify.png') }}" style="width:30px; float:left">
						             	&nbsp; <span style="font-size:25px; color:Green;">Verified</span>   
										@else
										<img src="{{ asset('/backend/img/verify.png') }}" style="width:30px; float:left">
							            &nbsp; <span style="font-size:25px; color:Green;">Verified</span> 
										@endif
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<div class="col-md-12"><br><br>
							<h5>Bank Details</h5>
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<tbody>
								@if($request->get_amount_via == 'UPI Transfer')
									<tr>
										<th>Name</th>
										<td>{{ $userBank->upi_account_holder_name }}</td>
									</tr>
									<tr>
										<th>UPI Id</th>
										<td>{{ $userBank->upi_id }}</td>
									</tr>
						    	@endif	
						    	
						    	@if($request->get_amount_via == 'Bank Account Transfer')
									<tr>
										<th>Account Holder Name</th>
										<td>{{ $userBank->bank_account_holder_name }}</td>
									</tr>
					    	         <tr>
										<th>Account Number</th>
										<td>{{ $userBank->bank_account_number }}</td>
									</tr>
									  <tr>
										<th>IFSC Code</th>
										<td>{{ $userBank->ifsc_code }}</td>
									</tr>
						    	@endif	
						    	
								</tbody>
							</table>
						</div>
						
						<div class="col-md-12">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<tbody>
								   <tr>
									   <th>
									   	<button  class="btn btn-success" data-id="{{$request->id}}" id="withdrawapproved" style="float:right">Approve</button></th> 
									   	<!-- <a href="{{ url('admin/withdraw-approved/'.$request->id) }}" class="btn btn-success" style="float:right">Approve</a></th>  -->
									   <th>
									   <form action="#" id="withdrawreject" method="get">
									   <!-- <form action="{{ url('admin/withdraw-reject/'.$request->id) }}" method="get"> -->
									   	<input type="hidden" name="withdrawrejectname" id="rejectid" value="{{$request->id}}">
									   	@csrf
									   	<input type="text" name="reject_reason" class="form-control" Placeholder="Reject Reason Write Here" required >
									   	 <input type="submit" id="withdrawrejectid" class="btn btn-danger" Value="Reject">
									   </form>
									   		
									</tr>
						     	</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">

	$("#withdrawreject").submit(function(){
		 event.preventDefault();
		 var rejectid = $('#rejectid').val();
       $('#withdrawrejectid').prop('disabled', true);
        $.ajax({

              method: 'GET',
              url:"{{ url('admin/withdraw-reject/') }}/"+rejectid,
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
 $('#withdrawapproved').on('click',function(){
 	let button = $(this);
   let id = button.data('id');
   // Disable the button
     button.prop('disabled', true);
	  $.ajax({
        method: 'GET',
          url: "{{ url('admin/withdraw-approved/') }}/"+id,
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
