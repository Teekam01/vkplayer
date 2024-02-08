@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>
<style>
	.Home_cxy {
		align-items: center;
		display: flex;
		justify-content: center;
		-webkit-font-smoothing: antialiased;
		-webkit-tap-highlight-color: transparent;
		font-family: Roboto !important;
		font-weight: 700;
		text-transform: uppercase;
		color: #959595;
		font-size: .76em;
		margin-bottom: -5px;
	}

	.Home_formControl_Jx9pO {
		background-clip: padding-box;
		background-color: #fff;
		border: 1px solid #5f5f5f;
		border-radius: 0.25rem;
		color: #495057;
		display: block;
		font-size: 1rem;
		font-weight: 700;
		height: calc(1.5em + 0.75rem + 2px);
		line-height: 1.5;
		padding: 0.375rem 0.75rem;
		transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
		width: 150px;
		margin-left: -15px;

	}

	.bg-green-btn {
		color: #fff !important;
		text-decoration: none;
		margin: 0.25rem !important;
		position: static !important;
		align-items: center;
		display: flex;
		justify-content: center;
		background-color: #0db25b;
		font-weight: 700;
		text-transform: uppercase;
		border: none;
		border-bottom-left-radius: 5px;
		border-color: initial;
		border-image-outset: 0;
		border-image-repeat: initial;
		border-image-slice: 100%;
		border-image-source: none;
		border-image-width: 1;
		border-radius: 5px;
		border-bottom-right-radius: 5px;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		bottom: 10px;
		font-size: .7em !important;
		height: 30px;
		padding: 0 22px;
		position: absolute;
		right: 10px;
	}

	.Home_betCardTitle__O-pNu {
		text-transform: uppercase !important;
		padding-left: 1rem !important;
		align-items: center !important;
		display: flex !important;
		border-bottom: 1px solid #f5e3ff;
		color: #2c2c2c;
		font-size: .65em;
		font-weight: 700;
		height: 30px;
		width: 100%;
		text-shadow: none;
	}

	.d-flex-new {
		padding-left: 1rem !important;
		display: flex !important;
	}

	.Home_betCardSubTitle__PZfJk {
		color: #dfa8ff;
		font-size: .55em;
		font-weight: 500;
		min-width: 50px;
		text-transform: uppercase;
	}

	.Home_betCardAmount__JyRSp {
		font-size: .9em;
		font-weight: 900;
		padding-left: 2px;
		text-transform: uppercase;
	}

	.Home_bgSecondary__0O2kVqq {

		padding: 0.25rem 0.5rem;
		border-radius: 0.1875rem;
		font-weight: 700;
		text-transform: uppercase;
		border: none;
		border-bottom-left-radius: 5px;
		border-color: initial;
		border-image-outset: 0;
		border-image-repeat: initial;
		border-image-slice: 100%;
		border-image-source: none;
		border-image-width: 1;
		border-radius: 5px;
		border-bottom-right-radius: 5px;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		bottom: 10px;
		font-size: .7em !important;
		height: 30px;
		padding: 0 22px;
		position: absolute;
		right: 10px;
		font-weight: 700;
		text-transform: uppercase;
		align-items: center;
		display: flex;
		justify-content: center;
		background-color: green !important;
		color: aliceblue;

	}

	.Home_bgSecondary__0O2kVyy {
		padding: 0.25rem 0.5rem;
		border-radius: 0.1875rem;
		font-weight: 700;
		text-transform: uppercase;
		border: none;
		border-bottom-left-radius: 5px;
		border-color: initial;
		border-image-outset: 0;
		border-image-repeat: initial;
		border-image-slice: 100%;
		border-image-source: none;
		border-image-width: 1;
		border-radius: 5px;
		border-bottom-right-radius: 5px;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		bottom: 10px;
		font-size: .7em !important;
		height: 30px;
		padding: 0 22px;
		position: absolute;
		right: 10px;
		font-weight: 700;
		text-transform: uppercase;
		align-items: center;
		display: flex;
		justify-content: center;
		background-color: green !important;
		color: aliceblue;

	}

	.Home_bgSecondary__0O2kVcc {
		padding: 0.25rem 0.5rem;
		border-radius: 0.1875rem;
		font-weight: 700;
		text-transform: uppercase;
		border: none;
		border-bottom-left-radius: 5px;
		border-color: initial;
		border-image-outset: 0;
		border-image-repeat: initial;
		border-image-slice: 100%;
		border-image-source: none;
		border-image-width: 1;
		border-radius: 5px;
		border-bottom-right-radius: 5px;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		bottom: 10px;
		font-size: .7em !important;
		height: 30px;
		padding: 0 22px;
		position: absolute;
		right: 105px;
		font-weight: 700;
		text-transform: uppercase;
		align-items: center;
		display: flex;
		justify-content: center;
		background-color: #830909 !important;
		color: aliceblue;

	}

	.Home_betCard_playerName__57U-C {
		font-size: .7em;
		font-weight: 500;
		line-height: 1px;
		padding-left: 10px;
	}

</style>
@endsection



@section('content')


<div class="main-area" style="padding-top: 60px;">

	<div class="px-4 py-3">
		<div class="head-battle" align="center">
			<div class="image">
				<img src="{{ asset('/frontend/images/send-money.png') }}" alt="" style="width:300px;">
			</div>
			<div class="kycPage">
				<form action="{{ url('/money-sent') }}" method="post" autocomplete="off">
					@csrf

					<p class="mt-2" style="color: rgb(149, 149, 149); font-size:20px">Enter details of Friend</p><br>
					<div style="margin-top: 10px;">
						<div class="kyc-doc-input">
						<input type="tel" name="mobile" required autocomplete="off" style="padding-top:20px">
							<div class="label" style="font-size:14px; padding-top:10px;">Friend's 10 digit Registered Mobile No.</div>
						</div><br>
						<div class="kyc-doc-input">
						    <input type="number" name="amount" required autocomplete="off" style="padding-top:20px">
							<div class="label" style="font-size:14px; padding-top:10px; ">Amount</div>
							<p class="text-danger">{{ $errors->first('amount') }}</p>
						</div>

					</div>
					<div style="padding-bottom: 80px;"></div>
					<div class="refer-footer">

						<input type="submit" class="refer-button cxy w-100 bg-primary"  value="Send Now">
					</div>
				</form>
			</div>
		</div>
		<hr>


	</div>




	@endsection
