@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>

@endsection



@section('content')
<div class="main-area" style="padding-top: 60px;">
	@if($user_kyc->verify_status == 0)
	<div class="divider-x"></div>
	<div class="p-4 bg-light">
		<div class="card text-center mt-3">
			<div style="height: 150px;">
				<picture class="ml-3"><img src="/images/alert.svg" alt="" width="32px" class="mt-4"></picture>
				<div class="ml-1 mt-2 mytext" style="color:red; font-weight:800">Complete KYC to take Withdrawals</div><br>
				<a href="{{ url('/complete-kyc/step1') }}" class="btn btn-primary"> Complete KYC </a>
			</div>
		</div>

	</div>
	@endif

	@if($user_kyc->verify_status == 1)
	<div class="row">
		<div class="col mx-auto">
			<div class="card text-center mt-3">
				<div class="card-body " style="padding: 15px;">
					<h4 class="pt-1 text-left"><b>Choose withdrawal option.</b></h4>
					<div>
						<a href="{{url('withdraw-through-upi')}}" style="text-decoration:none; color:black">
						<div class=" my-3" style="padding-top: 0px; height: 60px;">
							<div class="d-flex align-items-center" style="background-color: rgb(250, 250, 250); border: 1px solid grey; border-radius: 7px;">
								<div class="d-flex align-items-center" style="height: 60px; display: flex; text-align: center;"><img width="45px" src="{{asset('/frontend/images/UPI.png')}}" alt="" style="margin-left: 7px; padding-bottom: 10px; padding-left: 3px; padding-top: 5px;"></div>
								<div class="d-flex justify-content-center flex-column ml-4">
									<div class="text-left"><strong>Withdraw through UPI</strong><br><small class="text-warning">Minimum withdrawal amount ₹95</small></div>
									<div class="jss31"></div>
								</div>
							</div>
						</div>
						</a>
						<a href="{{url('withdraw-through-bank-transfer')}}"  style="text-decoration:none; color:black">
						<div class=" my-3" style="padding-top: 0px; height: 60px;">
							<div class="d-flex align-items-center" style="background-color: rgb(250, 250, 250); border: 1px solid grey; border-radius: 7px;">
								<div class="d-flex align-items-center" style="height: 60px; display: flex; text-align: center;"><img width="45px" src="{{asset('/frontend/images/Bank.png')}}" alt="" style="margin-left: 7px; padding-bottom: 10px; padding-left: 3px; padding-top: 5px;"></div>
								<div class="d-flex justify-content-center flex-column ml-4">
									<div class="text-left"><strong>Bank Transfer</strong><br><small class="text-warning">Minimum withdrawal amount ₹95</small><br><small class="text-danger">Direct Bank Transaction will take 1-2 hour</small></div>
									<div class="jss31"></div>
								</div>
							</div>
						</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col mx-auto">
			<div class="card text-center mt-3">
				<div class="card-body " style="padding: 5px;">
<!----<img src="{{asset('/frontend/images/w-logo.png')}}"  width="330" height="300">--->
</div>
			</div>
		</div>
	</div>
</div>

@endsection
