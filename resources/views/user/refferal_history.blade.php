@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>

@endsection



@section('content')

<div class="main-area" style="padding-top: 60px;">
	@if($ref_history->count()==0)

	<div class="cxy flex-column px-4 text-center" style="margin-top: 70px;"><img src="{{asset('frontend/images/connections2.png')}}" width="280px" alt="">
		<div class="games-section-title mt-4" style="font-size: 1.2em;">You can refer and Earn 3% of your referral winning, every time</div>
		<div class="games-section-headline mt-2" style="font-size: 0.85em;">Like if your player plays for <b>₹10000</b> and wins, You will get <b>₹300</b> as referral amount.</div>
	</div>
	<div class="kyc-select">
		<div class="overlay"></div>
		<div class="box" style="bottom: -16px; position: absolute;">
			<div class="bg-white">
				<div class="header">
					<div class="d-flex position-relative align-items-center justify-content-center">
						<div class="header-text">Reedeem Details</div>
					</div>
				</div>
				<div class="px-5" style="padding-top: 100px; padding-bottom: 30px; justify-content: center;">
					<p><b>Order ID:</b> </p>
					<p><b>Redeem amount:</b> </p>
				</div>
			</div>
		</div>
	</div>
    @else

	@foreach($ref_history as $row)


	<div class="w-100 py-3 d-flex align-items-center list-item">
		<div class="center-xy list-date mx-2">
			<div>{{ $row->day }} {{ $row->month }}</div>
		</div>

		<div class="list-divider-y"></div>
		<div class="mx-3 d-flex list-body">
			<div class="d-flex align-items-center"></div>
			<div class="d-flex flex-column font-8" style="font-family: Saira Semi Condensed,sans-serif; font-weight:700 " >
			<?php  $by_user = App\User::where('id', $row->by_user_id)->first(); ?>
			Refferal earned by {{ $by_user->vplay_id }}
			<div class="games-section-headline" style="font-family: Dosis,sans-serif;">Refferal ID: {{ $row->refferal_id }}</div>
			</div>

		</div>
		<div class="right-0 d-flex align-items-end pr-3 flex-column">
			<div class="d-flex float-right font-8">

					<div class="text-success" >
					 (+)


				    <picture class="ml-1 mb-1"><img height="21px" width="21px" src="{{asset('frontend/images/global-rupeeIcon.png')}}" alt=""></picture><span class="pl-1">{{ $row->amount }}</span>
		     	</div>
			<!--<div class="games-section-headline" style="font-size: 0.6em;">Closing Balance: {{ $row->closing_balance }}</div>-->
		</div>
	</div>
	</div>
	@endforeach


</div>
 @endif
@endsection
