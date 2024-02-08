@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    /* Give the tabs a rounded appearance */
.nav-tabs .nav-link {
    /*border-radius: 10px 10px 0 0 !important;*/
}

/* Set the active tab's background color to blue and others to a secondary color */
.nav-tabs .nav-link.active {
    background-color: #ffcc3c !important;
    color: white !important; /* White text for better contrast against the blue background */
}

.nav-tabs .nav-link {
    background-color: #e9ecef !important; /* Bootstrap's secondary color */
    color: #495057 !important; /* Bootstrap's default text color */
}
.nav-tabs .nav-link {
    border-radius: 71px !important;
}
</style>
@endsection



@section('content')

<div class="main-area" style="padding-top: 60px;">
    <div class="container mt-5">
    <ul class="nav nav-tabs rounded d-flex justify-content-between" id="myTab" role="tablist" style="border: 0 !important;">
        <li class="nav-item">
            <a class="nav-link active" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">Transaction</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="game-tab" data-toggle="tab" href="#game" role="tab" aria-controls="game" aria-selected="false">Game</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="referral-tab" data-toggle="tab" href="#referral" role="tab" aria-controls="referral" aria-selected="false">Referral</a>
        </li>
    </ul>
    <div class="tab-content mt-2" id="myTabContent">
        <!-- ALL TRANSACTIONS -->

        <!-- TRANSACTION TAB -->
        <div class="tab-pane fade active show" id="history" role="tabpanel" aria-labelledby="history-tab">
            @if($trans_history->count()==0)
    	<div class="cxy flex-column px-4 text-center" style="margin-top: 70px;"><img src="{{asset('frontend/images/notransactionhistory.png')}}" width="280px" alt="">
    		<div class="games-section-title mt-4" style="font-size: 1.2em;">No transactions yet!</div>
    		<div class="games-section-headline mt-2" style="font-size: 0.85em;">Seems like you haven’t done any activity yet</div>
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

	@foreach($trans_history as $row)


	<div class="w-100 py-3 d-flex align-items-center list-item">
		<div class="center-xy list-date mx-2">
			<div>{{ $row->day }} {{ $row->month }}</div><small>{{ $row->paying_time }}</small>
		</div>@if($row->add_or_withdraw=='withdraw')

		<!-----<a href="{{ url('view-withdrawal/'.$row->order_id) }}"><img src="{{asset('/frontend/images/eye_view_history.png')}}" style="width:20px; height:15px; float:left"></a>---->
		@endif


		<div class="list-divider-y"></div>
		<div class="mx-3 d-flex list-body">
			<div class="d-flex align-items-center"></div>
			<div class="d-flex flex-column font-8" style="font-family: Saira Semi Condensed,sans-serif; font-weight:700 " >
			@if($row->add_or_withdraw=='add' && $row->remark== null)
			Cash  Added
			@elseif($row->add_or_withdraw=='withdraw' && $row->remark== null)
			Cash  Withdrawal
			@endif

			@if($row->add_or_withdraw=='add' && $row->remark=='refferal')
			Refferal Added
			@endif

			@if($row->remark=='Sent To Friend' && $row->add_or_withdraw=='withdraw')
			<span>(Send To Friend)</span>
			@endif

			@if($row->remark=='Receive From Friend' && $row->add_or_withdraw=='add')
			<span>(Receive From Friend)</span>
			@endif

		    <!-- 493 == 493 and add-->
			<!--@if($row->user_id == Auth::user()->to_or_from_user_id && $row->add_or_withdraw == 'add')
			aaaa
			@endif

			@if($row->user_id == Auth::user()->to_or_from_user_id && $row->add_or_withdraw == 'withdraw')
			 bbb
			@endif-->

			@if($row->remark == "By Admin") By Admin  @endif

			@if($row->remark == "Penalty") Penalty  @endif

			<div class="games-section-headline" style="font-family: Dosis,sans-serif;">Order ID: {{ $row->order_id }}</div>
			</div>

		</div>
		<div class="right-0 d-flex align-items-end pr-3 flex-column">
			<div class="d-flex float-right font-8">
				 @if($row->add_or_withdraw=='add')
					<div class="text-success" >
					<span class="text text-success">SUCCESS</span> (+)
					@else
					<div class="text-danger" >
						 @if($row->withdraw_status=='pending')
						<span class="text text-warning">PENDING</span>

						@elseif($row->withdraw_status=='success')
						@elseif($row->withdraw_status==='SUCCESS')
						<span class="text text-success">PAID</span> (-)

						 @elseif($row->withdraw_status=='FAILED')
						<span class="text text-danger">FAILED</span>
					    <span class="text text-success">(+)</span>
						@elseif($row->withdraw_status=='penelty')
						<span class="text text-danger">PENALTY</span> (-)

						@elseif($row->withdraw_status=='reject')
						<span class="text text-danger">REJECT</span>
					    <span class="text text-success">(+)<img src="{{asset('/frontend/images/reverse.svg')}}" style="width:20px; height:20px; float:left"> </span>

						@endif

					@endif
						</div>
				<picture class="ml-1 mb-1"><img height="21px" width="21px" src="{{asset('frontend/images/global-rupeeIcon.png')}}" alt=""></picture><span class="pl-1">{{ $row->amount }}</span>
		     	</div>
			<div class="games-section-headline" style="font-size: 0.6em;">Closing Balance: {{ $row->closing_balance }}</div>
		</div>
	</div>

	@endforeach

        </div>
        <!-- GAME CONTENT -->
        <div class="tab-pane fade" id="game" role="tabpanel" aria-labelledby="game-tab">
                @if($battle_history->count()==0)

	<div class="cxy flex-column px-4 text-center" style="margin-top: 70px;"><img src="{{asset('frontend/images/nogamehistory.png')}}" width="280px" alt="">
		<div class="games-section-title mt-4" style="font-size: 1.2em;">No Games Played yet!</div>
		<div class="games-section-headline mt-2" style="font-size: 0.85em;">Seems like you haven’t played any game yet, play now to win!</div>
	</div>

	@else

	<div class="" >
		<!--<nav aria-label="pagination navigation" class="MuiPagination-root d-flex justify-content-center">
			<ul class="MuiPagination-ul">
				<li><button class="MuiButtonBase-root MuiPaginationItem-root MuiPaginationItem-page MuiPaginationItem-textSecondary Mui-disabled Mui-disabled" tabindex="-1" type="button" disabled="" aria-label="Go to previous page"><svg class="MuiSvgIcon-root MuiPaginationItem-icon" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
							<path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
						</svg></button></li>
				<li><button class="MuiButtonBase-root MuiPaginationItem-root MuiPaginationItem-page MuiPaginationItem-textSecondary Mui-selected" tabindex="0" type="button" aria-current="true" aria-label="page 1">1<span class="MuiTouchRipple-root"></span></button></li>
				<li><button class="MuiButtonBase-root MuiPaginationItem-root MuiPaginationItem-page MuiPaginationItem-textSecondary" tabindex="0" type="button" aria-label="Go to page 2">2<span class="MuiTouchRipple-root"></span></button></li>
				<li><button class="MuiButtonBase-root MuiPaginationItem-root MuiPaginationItem-page MuiPaginationItem-textSecondary" tabindex="0" type="button" aria-label="Go to page 3">3<span class="MuiTouchRipple-root"></span></button></li>
				<li><button class="MuiButtonBase-root MuiPaginationItem-root MuiPaginationItem-page MuiPaginationItem-textSecondary" tabindex="0" type="button" aria-label="Go to page 4">4<span class="MuiTouchRipple-root"></span></button></li>
				<li><button class="MuiButtonBase-root MuiPaginationItem-root MuiPaginationItem-page MuiPaginationItem-textSecondary" tabindex="0" type="button" aria-label="Go to page 5">5<span class="MuiTouchRipple-root"></span></button></li>
				<li><button class="MuiButtonBase-root MuiPaginationItem-root MuiPaginationItem-page MuiPaginationItem-textSecondary" tabindex="0" type="button" aria-label="Go to next page"><svg class="MuiSvgIcon-root MuiPaginationItem-icon" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
							<path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
						</svg><span class="MuiTouchRipple-root"></span></button></li>
			</ul>
		</nav>-->
		@foreach($battle_history as $row)
	<?php 	$user_detailss = App\User::where('id', $row->another_player_id )->first(); ?>
		<div class="w-100 py-3 d-flex align-items-center list-item">
			<div class="center-xy list-date mx-2">
				<div>{{$row->day}} {{$row->month}}</div><small>{{$row->paying_time}}</small>
			</div>
			<div class="list-divider-y"></div>
			<div class="mx-3 d-flex list-body">
				<div class="d-flex align-items-center">
					<picture class="mr-2"><img height="32px" width="32px" src="{{asset('frontend/images/ludo.png')}}" alt="" style="border-radius: 5px;"></picture>
				</div>
				<div class="d-flex flex-column font-7">
					<div style="color:black">{{$row->match_result}} against <b>{{ $user_detailss->vplay_id }}</b>

					@if($row->remark != null)
					   @if($row->remark == 'Cancelled by Admin')
					   <span class="text text-danger">({{$row->remark}})</span>
					   @else
					   <span class="text text-success">({{$row->remark}})</span>
					   @endif

					@endif.
					</div>
					<div class="games-section-headline">Battle ID: {{$row->battle_id}}</div>
				</div>
			</div>
			<div class="right-0 d-flex align-items-end pr-3 flex-column">
				<div class="d-flex float-right font-8">
				    @if($row->match_result=='win')
					<div class="text-success" >
					 (+)
					@elseif($row->match_result=='cancel')
					<div class="text-success" >
					 (+)
					 @else
					 <div class="text-danger" >
					 (-)

					@endif

					</div>
					<picture class="ml-1 mb-1"><img height="21px" width="21px" src="{{asset('frontend/images/global-rupeeIcon.png')}}" alt=""></picture><span class="pl-1">@if($row->match_result=='win') <?php echo $row->winning_amount-$row->lossing_amount; ?> @else {{$row->lossing_amount}} @endif</span>

				</div>
				<div class="games-section-headline" style="font-size: 0.6em;">Closing Balance: {{$row->closing_balance}} </div>
			</div>
		</div>
		@endforeach
	</div>
	@endif

        </div>
        <!-- REFERRAL CONTANET -->
        <div class="tab-pane fade" id="referral" role="tabpanel" aria-labelledby="referral-tab">
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
    @endif

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
    </div>
</div>





</div>
 @endif
@endsection
