<!doctype html>
<html lang="en">

<head>
	<!--title, description and keywords-->
	@yield('head')
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=0">

	<meta name="description" content="VK Ludo Player - Play Ludo King Win Real Money" data-react-helmet="true">
	<meta name="keywords" content="VK Ludo Player - Play Ludo King Win Real Money," data-react-helmet="true">
	<meta name="robots" content="noindex">
	<meta property="og:image" content="https://vkludopalyer.com/frontend/images/logo.png" />
<meta property="og:url" content="https://www.vkludopalyer.com/" />


	<!-- Primary Meta Tags -->
<title>VK Ludo Player - Play Ludo King Win Real Money</title>
<meta name="title" content="VK Ludo Player - Play Ludo King Win Real Money">
<meta name="description" content="VK Ludo Player - Play Ludo King Win Real Money">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://vkludopalyer.com/">
<meta property="og:title" content="VK Ludo Player - Play Ludo King Win Real Money">
<meta property="og:description" content="VK Ludo Player - Play Ludo King Win Real Money">
<meta property="og:image" content="https://vkludopalyer.com/frontend/images/logo.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://vkludopalyer.com/">
<meta property="twitter:title" content="VK Ludo Player - Play Ludo King Win Real Money">
<meta property="twitter:description" content="VK Ludo Player - Play Ludo King Win Real Money">
<meta property="twitter:image" content="https://vkludopalyer.com/frontend/images/logo.png">


<meta property="og:title" content="VK Ludo Player - Play Ludo King Win Real Money" />
<meta property="og:type" content="website" />


	<!--utf and viewport-->

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<!--google font roboto-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500,600,700,800,900&amp;display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400&amp;display=swap">

	<!--used css in site-->
	<link href="{{asset('frontend/static/css/2.cb99ed49.chunk.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/static/css/main.65fdbf1b.chunk.css')}}" rel="stylesheet">

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<script>
		// var auto_refresh = setInterval(
		// 	function() {
		// 		$('#walletBalance').load('<?php echo url('/wallet_balance/'); ?>');
		// 	}, 1000);

         

	</script>
	<!-- PWA  -->
	<meta name="theme-color" content="#21ad9f" />
	<link rel="apple-touch-icon" href="{{asset('frontend/images/apple-touch-icon.png')}}') }}">
	<link rel="manifest" href="{{ asset('/manifest.json') }}">



	<link rel="manifest" href="manifest.json">

</head>

<body>
	<div id="root">
		<!------Nav Menu Start------>


		<div id="menufade" onclick="closeMenu()" class=""></div>
		<div id="menulist" class="sideNav  ">
			<a class="sideNav-options" href="{{ url('profile') }}">
				<picture class="sideNav-icon">
					<img class="border-50" src="{{asset('frontend/images/avatars/Avatar2.png')}}" alt="My Profile">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">My Profile</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>
			<a class="sideNav-options" href="/">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/gamepad.png')}}" alt="Win Cash">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Win Cash</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>
			<a class="sideNav-options" href="{{ url('wallet') }}">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/sidebar-wallet.png')}}" alt="My Wallet">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">My Wallet</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>
			<a class="sideNav-options" href="{{ url('game-history') }}">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/sidebar-gamesHistory.png')}}" alt="Games History">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Games History</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>

		<!--<a class="sideNav-options" href="{{ url('top-10-players') }}">-->
		<!--		<picture class="sideNav-icon">-->
		<!--			<img class="" src="{{asset('frontend/images/top-player.png')}}" alt="Top 10 Players">-->
		<!--		</picture>-->
		<!--		<div class="position-relative ml-3">-->
		<!--			<div class="sideNav-text">Top 10 Players</div>-->
		<!--		</div>-->
		<!--		<picture class="sideNav-arrow">-->
		<!--			<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">-->
		<!--		</picture>-->
		<!--		<div class="sideNav-divider">-->

		<!--		</div>-->
		<!--	</a>-->

			<a class="sideNav-options" href="{{ url('transaction-history') }}">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/order-history.png')}}" alt="Transaction History">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Transaction History</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>


			<a class="sideNav-options" href="{{ url('refer-earn') }}">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/sidebar-referEarn.png')}}" alt="Refer &amp; Earn">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Refer &amp; Earn</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>

			<a class="sideNav-options" href="{{ url('refferal-history') }}">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/connections.png')}}" alt="Transaction History">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Referral History</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>
<!----
			<a class="sideNav-options" href="{{ url('referral-history') }}">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/sidebar-referEarn.png')}}" alt="Refer &amp; Earn">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Referral History</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>----->

			<a class="sideNav-options" href="{{ url('contact-us') }}">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/sidebar-support.png')}}" alt="Support">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Support</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>
			<a class="sideNav-options" href="{{ url('notification') }}">
				<picture class="sideNav-icon">
					<img class="" src="{{asset('frontend/images/sidebar-notifications.png')}}" alt="Notification">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Notification</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">

				</div>
			</a>

			<a class="sideNav-options" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
				<picture class="sideNav-icon">
				<img class="" src="{{asset('frontend/images/shutdown.png')}}" alt="Log Out">
				</picture>
				<div class="position-relative ml-3">
					<div class="sideNav-text">Log Out</div>
				</div>
				<picture class="sideNav-arrow">
					<img src="{{asset('frontend/images/global-black-chevronRight.png')}}" alt="">
				</picture>
				<div class="sideNav-divider">
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</a>



		</div>



		<!------Nav Menu End------>

		<!------Hedar Start------>

		<div class="leftContainer">



			@if(Route::current()->getName() == 'loginWithOtpForm' || Route::current()->getName() == 'login' )

			@else
			<div class="headerContainer">
				@if(Auth::check())
				@if(Auth::user()->user_type == '2')
				<picture class="sideNavIcon ml-3 mr-2"><img src="{{asset('frontend/images/header-hamburger.png')}}" onclick="openMenu()" alt=""></picture>
				@endif
				@endif
				<a href="/">
					<picture class="ml-2 navLogo d-flex">
						<img src="{{asset('frontend/images/logo.png')}}" alt="">
					</picture>
				</a>
				<div class="menu-items">

					@if(Auth::check())
    					@if(Auth::user()->user_type == '1' )
    					    <a type="button" class="login-btn" href="{{ url('admin/dashboard') }}">Owner Dashboard</a>
					    @elseif(Auth::user()->user_type == '3')
    					    <a type="button" class="login-btn" href="{{ url('admin/dashboard') }}">Admin Dashboard</a>
    					@else
    					<div id="walletBalance">

    					</div>
    					@endif
					@else
    					<a type="button" class="login-btn" href="{{ url('login') }}">SIGNUP</a>
    					<a type="button" class="login-btn" href="{{ url('login') }}">LOGIN</a>
					@endif

				</div>

				<span class="mx-5"></span>


			</div>

			@endif


			@yield('content')


		</div>


		<div class="divider-y"></div>
		<div class="rightContainer">
			<div class="rcBanner flex-center">
				<picture class="rcBanner-img-container">
					<img src="{{asset('frontend/images/logo.png')}}" alt="">
				</picture>
				<div class="rcBanner-text"><span class="rcBanner-text-bold">VK Ludo Player - Play Ludo King Win Real Money</span></div>
				<div class="rcBanner-footer">For best experience, open&nbsp;<a href="#!" style="color: rgb(44, 44, 44); font-weight: 500; text-decoration: none;">vkludopalyer.com</a>&nbsp;on&nbsp;<img src="{{asset('frontend/images/global-chrome.png')}}" alt="">&nbsp;chrome mobile</div>

			</div>
		</div>





		<audio id="requestAudio" style="display:none" controls="">
			<source src="/audio/battle_request.mp3" type="audio/mpeg">
		</audio>
		<audio id="acceptedAudio" style="display:none" controls="">
			<source src="/audio/battle_accepted.mp3" type="audio/mpeg">
		</audio>
		<audio id="screenCollapseAudio" style="display:none" controls="">
			<source src="/audio/screen-collapse.mp3" type="audio/mpeg">
		</audio>
		<audio id="countTimerAudio" style="display:none" controls="">
			<source src="/audio/timer.mp3" type="audio/mpeg">
		</audio>
		<audio id="versusAudio" style="display:none" controls="">
			<source src="/audio/versus.mp3" type="audio/mpeg">
		</audio>
		<audio id="victoryAudio" style="display:none" controls="">
			<source src="/audio/victory.mp3" type="audio/mpeg">
		</audio>


		<script src="{{asset('frontend/static/js/2.7ffbbf86.chunk.js')}}"></script>
		<script src="{{asset('frontend/static/js/main.b84e208a.chunk.js')}}"></script>
		<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<!--<script src="//code.tidio.co/hkh1uehicyjkzpm6vjlz0zzfw6ramcxe.js" async></script>-->
		<script>
			$(document).ready(function() {
				$('.react-swipeable-view-container').slick({
					autoplay: false,
					arrows: true,
					prevArrow: "<button type='button' class='slick-prev pull-left' style='border:0px solid white; background-color:white; font-size:35px; color:#969696'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
					nextArrow: "<button type='button' class='slick-next pull-right'  style='border:0px solid white; background-color:white; font-size:35px; color:#969696'><i class='fa fa-angle-right' aria-hidden='true'></i></button>"
				});
			});

		</script>
		@include('sweetalert::alert')
		<script>
			function openMenu() {
				const fade = document.getElementById("menufade");
				const box = document.getElementById("menulist");
				fade.classList.toggle("sideNav-overlay");
				box.classList.add("sideNav-open");
			}

			function closeMenu() {
				const fadeClose = document.getElementById("menufade");
				const boxClose = document.getElementById("menulist");
				fadeClose.classList.remove("sideNav-overlay");
				boxClose.classList.remove("sideNav-open");
			}

		</script>

		<style data-jss="" data-meta="MuiSvgIcon">
			.MuiSvgIcon-root {
				fill: currentColor;
				width: 1em;
				height: 1em;
				display: inline-block;
				font-size: 1.5rem;
				transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
				flex-shrink: 0;
				user-select: none;
			}

			.MuiSvgIcon-colorPrimary {
				color: #3f51b5;
			}

			.MuiSvgIcon-colorSecondary {
				color: #f50057;
			}

			.MuiSvgIcon-colorAction {
				color: rgba(0, 0, 0, 0.54);
			}

			.MuiSvgIcon-colorError {
				color: #f44336;
			}

			.MuiSvgIcon-colorDisabled {
				color: rgba(0, 0, 0, 0.26);
			}

			.MuiSvgIcon-fontSizeInherit {
				font-size: inherit;
			}

			.MuiSvgIcon-fontSizeSmall {
				font-size: 1.25rem;
			}

			.MuiSvgIcon-fontSizeLarge {
				font-size: 2.1875rem;
			}

		</style>
		<style data-jss="" data-meta="MuiInputBase">
			@-webkit-keyframes mui-auto-fill {}

			@-webkit-keyframes mui-auto-fill-cancel {}

			.MuiInputBase-root {
				color: rgba(0, 0, 0, 0.87);
				cursor: text;
				display: inline-flex;
				position: relative;
				font-size: 1rem;
				box-sizing: border-box;
				align-items: center;
				font-family: "Roboto", "Helvetica", "Arial", sans-serif;
				font-weight: 400;
				line-height: 1.1876em;
				letter-spacing: 0.00938em;
			}

			.MuiInputBase-root.Mui-disabled {
				color: rgba(0, 0, 0, 0.38);
				cursor: default;
			}

			.MuiInputBase-multiline {
				padding: 6px 0 7px;
			}

			.MuiInputBase-multiline.MuiInputBase-marginDense {
				padding-top: 3px;
			}

			.MuiInputBase-fullWidth {
				width: 100%;
			}

			.MuiInputBase-input {
				font: inherit;
				color: currentColor;
				width: 100%;
				border: 0;
				height: 1.1876em;
				margin: 0;
				display: block;
				padding: 6px 0 7px;
				min-width: 0;
				background: none;
				box-sizing: content-box;
				animation-name: mui-auto-fill-cancel;
				letter-spacing: inherit;
				animation-duration: 10ms;
				-webkit-tap-highlight-color: transparent;
			}

			.MuiInputBase-input::-webkit-input-placeholder {
				color: currentColor;
				opacity: 0.42;
				transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
			}

			.MuiInputBase-input::-moz-placeholder {
				color: currentColor;
				opacity: 0.42;
				transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
			}

			.MuiInputBase-input:-ms-input-placeholder {
				color: currentColor;
				opacity: 0.42;
				transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
			}

			.MuiInputBase-input::-ms-input-placeholder {
				color: currentColor;
				opacity: 0.42;
				transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
			}

			.MuiInputBase-input:focus {
				outline: 0;
			}

			.MuiInputBase-input:invalid {
				box-shadow: none;
			}

			.MuiInputBase-input::-webkit-search-decoration {
				-webkit-appearance: none;
			}

			.MuiInputBase-input.Mui-disabled {
				opacity: 1;
			}

			.MuiInputBase-input:-webkit-autofill {
				animation-name: mui-auto-fill;
				animation-duration: 5000s;
			}

			label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-webkit-input-placeholder {
				opacity: 0 !important;
			}

			label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-moz-placeholder {
				opacity: 0 !important;
			}

			label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:-ms-input-placeholder {
				opacity: 0 !important;
			}

			label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-ms-input-placeholder {
				opacity: 0 !important;
			}

			label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-webkit-input-placeholder {
				opacity: 0.42;
			}

			label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-moz-placeholder {
				opacity: 0.42;
			}

			label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus:-ms-input-placeholder {
				opacity: 0.42;
			}

			label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-ms-input-placeholder {
				opacity: 0.42;
			}

			.MuiInputBase-inputMarginDense {
				padding-top: 3px;
			}

			.MuiInputBase-inputMultiline {
				height: auto;
				resize: none;
				padding: 0;
			}

			.MuiInputBase-inputTypeSearch {
				-moz-appearance: textfield;
				-webkit-appearance: textfield;
			}

		</style>
		<style data-jss="" data-meta="MuiInput">
			.MuiInput-root {
				position: relative;
			}

			label+.MuiInput-formControl {
				margin-top: 16px;
			}

			.MuiInput-colorSecondary.MuiInput-underline:after {
				border-bottom-color: #f50057;
			}

			.MuiInput-underline:after {
				left: 0;
				right: 0;
				bottom: 0;
				content: "";
				position: absolute;
				transform: scaleX(0);
				transition: transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
				border-bottom: 2px solid #3f51b5;
				pointer-events: none;
			}

			.MuiInput-underline.Mui-focused:after {
				transform: scaleX(1);
			}

			.MuiInput-underline.Mui-error:after {
				transform: scaleX(1);
				border-bottom-color: #f44336;
			}

			.MuiInput-underline:before {
				left: 0;
				right: 0;
				bottom: 0;
				content: "\00a0";
				position: absolute;
				transition: border-bottom-color 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
				border-bottom: 1px solid rgba(0, 0, 0, 0.42);
				pointer-events: none;
			}

			.MuiInput-underline:hover:not(.Mui-disabled):before {
				border-bottom: 2px solid rgba(0, 0, 0, 0.87);
			}

			.MuiInput-underline.Mui-disabled:before {
				border-bottom-style: dotted;
			}

			@media (hover: none) {
				.MuiInput-underline:hover:not(.Mui-disabled):before {
					border-bottom: 1px solid rgba(0, 0, 0, 0.42);
				}
			}

		</style>
		<style data-jss="" data-meta="MuiFormControl">
			.MuiFormControl-root {
				border: 0;
				margin: 0;
				display: inline-flex;
				padding: 0;
				position: relative;
				min-width: 0;
				flex-direction: column;
				vertical-align: top;
			}

			.MuiFormControl-marginNormal {
				margin-top: 16px;
				margin-bottom: 8px;
			}

			.MuiFormControl-marginDense {
				margin-top: 8px;
				margin-bottom: 4px;
			}

			.MuiFormControl-fullWidth {
				width: 100%;
			}

		</style>

		<script src="{{ asset('/sw.js') }}"></script>
		<script>
			if (!navigator.serviceWorker.controller) {
				navigator.serviceWorker.register("/sw.js").then(function(reg) {
					console.log("Service worker has been registered for scope: " + reg.scope);
				});
			}

		</script>
		<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
