@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>

@endsection



@section('content')
<div class="main-area" style="padding-top: 60px;">
	<div class="row">
		<div class="container">
			<div class="col mx-auto">
				<div class="card text-center mt-3">
					<div class="card-body " style="padding: 15px;">
						<h4 class="pt-1 text-left"><b>Withdraw through</b></h4>
						<div>
							<!--<form action="{{ url('withdraw-now-bank') }}" method="post">-->
							<form action="#" method="post" id="withdrawbnk">
								<input type="hidden" name="userid" value="{{ Auth::user()->id }}">
								<input type="hidden" name="get_amount_via" value="Bank Account Transfer">
								@csrf
								<div class="row bg-light p-1">
									<div class="text-left w-100 container" style="background: white;">
										<div class=" my-3" style="padding-top: 0px; height: 83px;">
											<div class="d-flex align-items-center" style="background-color: rgb(250, 250, 250); border: 1px solid grey; border-radius: 7px;">
												<div class="d-flex align-items-center" style="height: 60px; display: flex; text-align: center;"><img width="45px" src="{{asset('/frontend/images/Bank.png')}}" alt="" style="margin-left: 7px; padding-bottom: 10px; padding-left: 3px; padding-top: 5px;"></div>
												<div class="d-flex justify-content-center flex-column ml-4">
													<div class="text-left"><strong>Bank Transfer</strong><br><small class="text-warning">Minimum withdrawal ₹95</small><br><small class="text-danger">Direct Bank Transaction will take 1-2 hour</small></div>
													<div class="jss31"></div>
												</div><a href="{{ url('/withdraw-check') }}" class=" btn btn-info ml-auto mr-3" >Edit</a>
											</div>
										</div><br>
										<div class="">
											<div>
												<div>
													<label for="username " class="mr-5"><i class="fa fa-user" aria-hidden="true"></i> Account holder name</label>

													<div class="col-12 mb-3 p-0">
														<input type="text" class="form-control" placeholder="Enter Account Holder Name" name="bank_account_holder_name" @if($user_bank_details->bank_account_holder_name != null) value="{{ $user_bank_details->bank_account_holder_name }}"   @endif required="">
													</div>
												</div>
												<div>
													<label for="username " class="mr-5"><i class="fa fa-university" aria-hidden="true"></i> Account Number</label>

													<div class="col-12 mb-3 p-0">
														<input type="text" class="form-control" placeholder="Enter Account Number" name="bank_account_number"
														@if($user_bank_details->bank_account_number != null) value="{{ $user_bank_details->bank_account_number }}"   @endif required="">
													</div>
												</div>
												<label for="username " class="mr-5"><i class="fa fa-university" aria-hidden="true"></i> IFSC Code</label>
												<div class="col-12 mb-3 p-0">
													<input type="text" class="form-control" placeholder="Enter IFSC CODE" name="ifsc_code"  @if($user_bank_details->ifsc_code != null) value="{{ $user_bank_details->ifsc_code }}"   @endif  required="">
												</div>
											</div>
										</div>
									</div>
									<div class="container">
									<div>
										<label for="username " class="mr-5" style="float:left">
											<i class="fa fa-inr" aria-hidden="true"></i> Amount</label>
									</div>
									<div class="field col-12 p-0 mt-1 mb-3">
										<input type="number" class="form-control search-slt" name="amount" placeholder="amount" required max="{{ Auth::user()->wallet_winning_cash }}">
										<p class="text-danger">{{ $errors->first('amount') }}</p>
									</div>
									<div class="col-12 p-0 mt-2 pt-3">
										<button type="submit" class=" btn-block btn-sm" id="bnkwithdraw" style="height: 40px; background-color: rgb(15, 125, 44); color: white; border-radius: 21px;">Withdraw</button>
									</div>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <script>
	$(function(){
// 	alert('ddd');
	$("#withdrawbnk").validate({
		submitHandler: function(form) {
	    var formData= new FormData(jQuery('#withdrawbnk')[0]);
	    $('#bnkwithdraw').prop('disabled', true);
		jQuery.ajax({
				url: "{{ url('withdraw-now-bank') }}",
				type: "post",
				cache: false,
				data: formData,
				processData: false,
				contentType: false,

				success:function(data) {
				// var obj = JSON.parse(data);

				if(data.status==true){
				swal({title: data.title, text: data.message, type:
                    "success"}).then(function(){
                    window.location.href = data.url;

                       }
                    );
				}
				else{
				swal({title: data.title, text: data.message, type:
                    "success"}).then(function(){
                    window.location.href = data.url;

                       }
                    );
				}

				}
			});
		}
	});
});

</script>

@endsection
