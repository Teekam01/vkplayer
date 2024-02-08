@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>
@endsection



@section('content')
<div class="main-area" style="padding-top: 60px;">
	<div class="collapseCard-container">
		<div class="collapseCard">
			<a href="#!" style="text-decoration: none;">
				<div class="collapseCard-body" style="height: 64px; opacity: 1; transition: height 0.3s ease 0s, opacity 0.3s ease 0s;">
					<div class="collapseCard-text">How to win money?</div>
					<picture class="collapseCard-closeIcon">
						<img class="position-relative" src="{{asset('frontend/images/global-circularCrossIcon.png')}}" alt="" width="14px" height="14px">
					</picture>
				</div>
			</a>
			<div class="collapseCard-header" style="left: 22px; transition: left 0.3s ease 0s;">
				<picture>
					<img height="10px" width="14px" src="{{asset('frontend/images/global-ytPlayIcon.png')}}" alt="">
				</picture>
				<div class="collapseCard-title ml-1 mt-1">Video Help</div>
			</div>
		</div>
	</div>
	<section class="games-section p-3">
		<div class="d-flex align-items-center games-section-title">Our Games</div>
		<div class="games-section-headline mt-2 mb-1">
			<div class="games-window">
				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ LIVE</span>
					<a class="gameCard" href="#">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('frontend/images/games/kb_ludo.jpeg')}}" alt="">

						</picture>
						<div class="gameCard-title">Ludo Classics</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>
				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ LIVE</span>
					<a class="gameCard" href="#">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('frontend/images/games/ludo.png')}}" alt="">
						</picture>
						<div class="gameCard-title">Ludo Popular</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>


				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ Live</span>
					<a class="gameCard" href="#">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('frontend/images/games/kb_ludo.jpeg')}}" alt="">

						</picture>
						<div class="gameCard-title">Ludo No Cut</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>
				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ Live</span>
					<a class="gameCard" href="#">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('frontend/images/games/ludo.png')}}" alt="">
						</picture>
						<div class="gameCard-title">Ludo Ulta</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>




				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ Comming Soon</span>
					<a class="gameCard" href="#">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('frontend/images/rummy.png')}}" alt="">

						</picture>
						<div class="gameCard-title">Rummy</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>
				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ Comming Soon</span>
					<a class="gameCard" href="#">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('frontend/images/teen.png')}}" alt="">
						</picture>
						<div class="gameCard-title">Teen Patti</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>


				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ Comming Soon</span>
					<a class="gameCard" href="#">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('frontend/images/games/fantasy-cricket.jpeg')}}" alt="">
						</picture>
						<div class="gameCard-title">Snakes & Ladders</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>
				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ Comming Soon</span>
					<a class="gameCard" href="#">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('frontend/images/games/unnamed.webp')}}" alt="">
						</picture>
						<div class="gameCard-title">Dragon Tiger</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>


			</div>
		</div>
	</section>
	<!------Main Content End------>

	<!------Footer Start------>
	<section class="footer">
		<div class="footer-divider"></div>
		<a class="px-3 py-4 d-block" href="#!" style="text-decoration: none;">
			<picture class="">
				<img width="100px" hight="20px" src="{{asset('frontend/images/vplay-logo.png')}}" alt="">
			</picture>
			<span style="color: rgb(149, 149, 149); font-size: 0.8em; font-weight: 400;"> . Terms, Privacy, Support</span>
			<picture class="footer-arrow">
				<img width="21px" src="{{asset('frontend/images/global-grey-dropDown.png')}}" alt="">
			</picture>
		</a>
		<div class="px-3 overflow-hidden" style="height: 0px; transition: height 0.5s ease 0s;">
			<div class="row footer-links">
				<a class="col-6" href="/term-condition">Terms &amp; Condition</a>
				<a class="col-6" href="/privacy-policy">Privacy Policy</a>
				<a class="col-6" href="/refund-policy">Refund/Cancellation Policy</a>
				<a class="col-6" href="/contact-us">Contact Us</a>
				<a class="col-6" href="/responsible-gaming">Responsible Gaming</a>
			</div>
		</div>
		<div class="footer-divider"></div>
		<div class="px-3 py-4">
			<div class="footer-text-bold">About Us</div><br>
			<div class="footer-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</div><br>
			<div class="footer-text-bold">Our Business &amp; Products</div><br>
			<div class="footer-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</div><br>
			<div class="footer-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. </div><br>
			<div class="footer-text-bold">Our Games</div><br>
			<div class="footer-text">Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </div><br>
			<div class="footer-text">
				Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. !
			</div>
		</div>
	</section>
	<div class="kyc-select">
		<div class="overlay"></div>
		<div class="box" style="bottom: 0px; position: absolute;">
			<div class="bg-white">
				<div class="header" style="border-bottom: unset;">
					<div class="d-flex position-relative align-items-center">
						<img src="{{asset('frontend/images/global-ytPlayIcon.png')}}" width="20px" alt="">
						<div class="games-section-title ml-3">How to play on Vplay?</div>
						<span class="position-absolute font-weight-bold cxy" style="right: 5px; height: 40px; width: 40px;">X</span>
					</div>
					<div class="tutorialVideo">
						<div id="tabNav-1" class="tab tabActive">
							<span>Hindi</span>
							<div class="selectedLine"></div>
						</div>
						<div id="tabNav-2" class="tab">
							<span>English</span>
						</div>
					</div>
				</div>
				<div style="padding-top: 150px; padding-bottom: 60px;">
					<div class="embed-responsive embed-responsive-16by9"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
