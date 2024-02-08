@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>

@endsection



@section('content')
<div class="main-area">

	@if($battle_history->count()==0)

	<div class="cxy flex-column px-4 text-center" style="margin-top: 70px;"><img src="{{asset('frontend/images/nogamehistory.png')}}" width="280px" alt="">
		<div class="games-section-title mt-4" style="font-size: 1.2em;">No Games Played yet!</div>
		<div class="games-section-headline mt-2" style="font-size: 0.85em;">Seems like you haven’t played any game yet, play now to win!</div>
	</div>

	@else

	<div class="main-area" style="margin-top:60px;">
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
					<div style="color:black">{{$row->match_result}} against <b>{{ isset($user_detailss->vplay_id) ? $user_detailss->vplay_id : '' }}</b>

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
@endsection
