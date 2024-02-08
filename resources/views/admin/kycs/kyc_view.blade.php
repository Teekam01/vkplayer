@extends('admin.master')


@section('head')
<title> Transcation History  </title>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Player Profile </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">

		<div class="card-body">
			<div class="co-md-12" style="padding:30px">
				<div class="row">
					<div class="col-md-6">
						<img src="{{asset('frontend/images/avatars/Avatar2.png')}}" style="width:120px; height:auto; border:5px solid #395fcf; border-radius:50%; float:left ">

						<div style="float:left; margin-top:20px;  margin-bottom:40px; margin-left:20px; color: #395fcf">
							<h3><i class="fa-solid fa-id-card-clip"></i> {{ $user_details->vplay_id }}</h3>
							<h3><i class="fa-solid fa-phone-volume"></i> {{ $user_details->mobile }}</h3>
						</div>
					</div>
					<div class="col-md-1">
						<div class="win" style="padding-top:24px">
							<img src="{{ asset('frontend/images/win.png') }}" style="width:60px">
							<div style="font-size:40px; color:green; float:right">{{ $user_details->total_win }}</div>
						</div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-1">
						<div class="lost" style="padding-top:24px">
							<img src="{{ asset('frontend/images/lost.png') }}" style="width:60px"> <span style="font-size:40px; color:red; float:right">{{ $user_details->total_lost }}</span>
						</div>
					</div>
					
					<div class="col-md-1"></div>
					<div class="col-md-2">
						<div class="status" style="padding-top:24px">
							@if($user_kyc_details->verify_status==1) 
							<img src="{{ asset('/backend/img/verify.png') }}" style="width:50px; float:left">
							&nbsp; <span style="font-size:25px; color:Green;">Verified</span> 
							@else 
							<img src="{{ asset('/backend/img/unverify.png') }}" style="width:50px; float:left">&nbsp; <span style="font-size:25px; color:red;">Un-Verified</span> @endif
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered">
							<tr style="background-color:#4e73df; color:white; font-weight:600">
								<th >
									<h5> Update Kyc Status</h5>
								</th>
								<th>
								  @if($user_kyc_details->verify_status == '1')
								    <h5><form id="kycreject" method="post">
								    <!-- <h5><form action="{{ url('admin/kyc-reject/'.$user_kyc_details->id) }}" method="post"> -->
							        @csrf
							        <input type="hidden" value="{{$user_kyc_details->id}}" name="rejected_id" id="rejected_id">
							         <input type="text" name="reject_reason" class="form-control" Placeholder="Reject Reason Write Here">
							         <input type="submit"  class="btn btn-xs btn-danger rejected" value="Reject">
								   
								    </form></h5>
								  @else
								    <h5><button href="#" data-id="{{$user_kyc_details->id}}" class="btn btn-xs btn-success kyc_approved">Approve</button></h5>
								    <!-- <h5><a href="{{ url('admin/kyc-verify/'.$user_kyc_details->id) }}" class="btn btn-xs btn-success">Approve</a></h5> -->
								    <h5>
								    <form id="kycreject" method="post" enctype="multipart/form-data">
							        @csrf
							         <input type="hidden" name="rejected_id" value="{{$user_kyc_details->id}}" id="rejected_id">
							         <input type="text" name="reject_reason" class="form-control" Placeholder="Reject Reason Write Here">
							         <input type="submit" class="btn btn-xs btn-danger rejected" value="Reject">
								   
								    </form>
								    </h5>
								  @endif
									
									
								</th>
							</tr>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<table class="table table-bordered">
							<tr style="background-color:#4e73df; color:white; font-weight:600">
								<th colspan="2">
									<h5> KYC Documents Details</h5>
								</th>
							</tr>
							<tr>
								<th>Document Name</th>
								<td>{{ $user_kyc_details->DOCUMENT_NAME }}</td>
							</tr>
							<tr>
								<th>Document Number</th>
								<td>{{ $user_kyc_details->DOCUMENT_NUMBER }}</td>
							</tr>
							<tr>
								<th>First Name </th>
								<td>{{ $user_kyc_details->DOCUMENT_FIRST_NAME }}</td>
							</tr>
							<tr>
								<th>Last Name </th>
								<td>{{ $user_kyc_details->DOCUMENT_LAST_NAME }}</td>
							</tr>
							<tr>
								<th>Date Of Birth </th>
								<td>{{ $user_kyc_details->DOCUMENT_DOB }}</td>
							</tr>
							<tr>
								<th>State </th>
								<td>{{ $user_kyc_details->DOCUMENT_STATE }}</td>
							</tr>
							<tr>
								<th>Front Side Image</th>
								<td align="center"><a href="{{ asset('/public/images/kycdata/'.$user_kyc_details->user_id.'/'.$user_kyc_details->DOCUMENT_FRONT_IMAGE) }}" target="_blank"><i class="fa-solid fa-image"  style="font-size:35px"></i></a></td>
							</tr>
							<tr>
								<th>Back Side Image</th>
								<td align="center"><a href="{{ asset('/public/images/kycdata/'.$user_kyc_details->user_id.'/'.$user_kyc_details->DOCUMENT_BACK_IMAGE) }}" target="_blank"><i class="fa-solid fa-image"  style="font-size:35px"></i></a></td>
							</tr>
							<tr>
								<th>Verify Document status</th>
								<td>@if($user_kyc_details->verify_status == 0)
									<span class="btn btn-danger"> PENDING </span>
									@else
									<span class="btn btn-success"> VERIFIED</span>
									@endif
								</td>
							</tr>
						</table>
					</div>
					<div class="col-md-4">
						<table class="table table-bordered">
							<tr  style="background-color:#4e73df; color:white; font-weight:600">
								<th colspan="2">
									<h5> Bank Account Details</h5>
								</th>
							</tr>
							
							<tr>
								<th>UPI - Account Holder Name</th>
								<td>@if($user_bank_details) {{ $user_bank_details->upi_account_holder_name }}  @else Not Avaliable @endif</td>
							</tr>
							<tr>
								<th>UPI - Id</th>
								<td>@if($user_bank_details) {{ $user_bank_details->upi_id }} @else Not Avaliable  @endif</td>
							</tr>
							<tr>
								<th>Bank Account - Holder Name</th>
								<td>@if($user_bank_details) {{ $user_bank_details->bank_account_holder_name }} @else Not Avaliable  @endif</td>
							</tr>
							<tr>
								<th>Bank Account - Bank Account Number</th>
								<td>@if($user_bank_details) {{ $user_bank_details->bank_account_number }} @else Not Avaliable  @endif</td>
							</tr>
							<tr>
								<th>Bank Account - IFSC Code</th>
								<td>@if($user_bank_details) {{ $user_bank_details->ifsc_code }} @else Not Avaliable  @endif</td>
							</tr>
							
							<tr>
								<th>Created at</th>
								<td>@if($user_bank_details) {{ $user_details->created_at }} @else Not Avaliable  @endif</td>
							</tr>
							
						</table>
					</div>
					
					<div class="col-md-4">
						<table class="table table-bordered">
							<tr  style="background-color:#4e73df; color:white; font-weight:600">
								<th colspan="2">
									<h5> Other Details</h5>
								</th>
							</tr>
							<tr>
								<th>Email</th>
								<td>{{ $user_details->email }}</td>
							</tr>
							<tr>
								<th>Wallet</th>
								<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> {{ $user_details->wallet }}</td>
							</tr>
							<tr>
								<th>Refferal Code</th>
								<td>{{ $user_details->referral_code }}</td>
							</tr>
							<tr>
								<th>Reffered By</th>
								<td>{{ $user_details->reffered_by }}</td>
							</tr>
							
							<tr>
								<th>Created at</th>
								<td>{{ $user_details->created_at }}</td>
							</tr>
						</table>
					</div>
					
				</div>

			</div>
			<div class="col-md-6">

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

	$("#kycreject").submit(function(){
		 event.preventDefault();
       var rejected_id = $('#rejected_id').val();
       $('.rejected').prop('disabled', true);
        $.ajax({

              method: 'POST',
              url:"{{route('admin-kyc-reject')}}",
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
                    "error"}).then(function(){ 
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
 $('.kyc_approved').on('click',function(){
 	let button = $(this);
   let id = button.data('id');
   // Disable the button
     button.prop('disabled', true);
	  $.ajax({
        method: 'GET',
          url: "{{url('admin/kyc-verify/') }}/"+id,
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
