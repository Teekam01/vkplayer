@extends('layouts.master')

@section('head')
<title>VK Ludo Player - Play Ludo King Win Real Money</title>
@endsection



@section('content')
<div class="main-area" style="padding-top: 60px;">
<div class="collapseCard">
	<!-----<div class="alert alert-info" role="alert">
			<marquee behavior="scroll" direction="left">VK Ludo Player के सभी प्लेयर का हमारे अपग्रेटेड प्लेटफॉर्म पर हार्दिक स्वागत है आप सभी से निवेदन है कि किसी भी समस्या के लिए <b>1234567890</b> पर <b>whatsapp</b> मैसेज करें।</marquee>
</div>---->
		</div>
		</div>

<?php $marque_notification = App\MarqueeNotification::where('status','1')->first(); ?>
@if($marque_notification)
<div class="alert alert-danger" role="alert">
  <marquee behavior="scroll" direction="left"><b>{{ $marque_notification->marquee_text }}</b></marquee>
</div>
@endif
@if(Auth::check() && Auth::user()->user_type == 2)
<?php $userData = App\UserData::where('user_id', Auth::user()->id)->first(); ?>
    @if($userData->verify_status == 0  )
        <div class="container">
            <div class="d-flex flex-row align-items-center justify-content-between p-3 border-danger card bg-outline text-white" style="background: #ff0000a6; ">
                <div class="d-flex flex-column align-items-start justify-content-center">
                                <span class="fw-bold text-capitalize">KYC Pending !</span>
                            </div>
                <div>
                    <a href="{{ url('/complete-kyc/step1') }}">
                        <button class="btn btn-sm text-capitalize bg-danger text-white">complete KYC</button>
                    </a>
                </div>
            </div>
        </div>
    @endif
@endif
	<section class="games-section p-3">
		<div class="d-flex align-items-center games-section-title">Our Games</div>
		<div class="games-section-headline mt-2 mb-1">
			<div class="games-window">
			@foreach($games as $game)
				<div class="gameCard-container">
					<span class="blink text-danger d-block text-right">◉ LUDO CLASSIC</span>
					<a class="gameCard" href="@if($game->id == 1 || $game->id == 2)
                                                {{ url('lobby/'.$game->url) }}
                                            @else
                                                javascript:
                                            @endif">
						<picture class="gameCard-image">
							<img width="100%" src="{{asset('images/games/'.$game->game_image)}}" alt="">

						</picture>
						<div class="gameCard-title">{{ $game->game_name }}</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>
				@endforeach
				<!--<div class="gameCard-container">
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
							<img width="100%" src="{{asset('frontend/images/games/ludo.png')}}" alt="">
						</picture>
						<div class="gameCard-title">Ludo Popular</div>
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
						<div class="gameCard-title">Snakes & Ladder</div>
						<picture class="gameCard-icon">
							<img src="{{asset('frontend/images/global-battleIconWhiteStroke.png')}}" alt="">
						</picture>
					</a>
				</div>
-->


			</div>
		</div>
		<section class="footer">
		<div class="footer-divider"></div>
		<a class="px-3 py-4 d-block" href="#!" style="text-decoration: none;">
			<picture class="">
				<img width="50px" hight="8px" src="{{asset('frontend/images/logo.png')}}" alt="">
			</picture>
			<span style="color: rgb(149, 149, 149); font-size: 0.8em; font-weight: 400;"> Terms, Privacy, Support</span>
			<picture class="footer-arrow">
				<button onclick="showMenu();" id="buttonmenu"><img width="21px" src="{{asset('frontend/images/global-grey-dropDown.png')}}" alt="" > </button>
				<button onclick="hideMenu();" id="buttonmenu2" style="display:none"><img width="21px" src="{{asset('frontend/images/global-grey-dropDown.png')}}" alt="" > </button>
			</picture>

		</a>

			<div class="footer-links container" id="otherPage" style="display:none">
			<div class="container">
			<div class="row">

				<div class="col-md-6"> <a href="{{url('/term-condition')}}" style="text-decoration:none; color:grey" >Terms &amp; Condition</a> </div>
				    <div class="col-md-6"> <a href="{{url('/privacy-policy')}}" style="text-decoration:none; color:grey">Privacy Policy</a></div>
					<div class="col-md-6"> <a href="{{url('/responsible-gaming')}}" style="text-decoration:none; color:grey">Responsible Gaming</a> </div>
					<div class="col-md-6"> <a href="{{url('/contact-us')}}" style="text-decoration:none; color:grey">Contact Us</a></div>
				</div>
				</div>
			</div>
			<br>
      <div class="footer-text-bold">About Us</div>
      <br>
      <div class="footer-text">VK Ludo Player is a real-money gaming product owned and operated by VK Ludo Player Gaming Zone ("VK Ludo Player" or "We" or "Us" or "Our").</div>
      <br>
      <div class="footer-text-bold">Our Business &amp; Products</div>
      <br>
      <div class="footer-text">We are an HTML5 game-publishing company and our mission is to make accessing games fast and easy by removing the friction of app-installs.</div>
      <br>
      <div class="footer-text">VK Ludo Player is a skill-based real-money gaming platform accessible only for our users in India. It is accessible on
      <a target="_blank" rel="noopener noreferrer" href="https://www.vkludopalyer.com">https://www.vkludopalyer.com</a>. On VK Ludo Player, users can compete for real cash in Tournaments and Battles. They can encash their winnings via popular options such as Paytm Wallet, Upi, Bank Account etc.</div>
      <br>
      <div class="footer-text-bold">Our Games</div>
      <br>
      <div class="footer-text">VK Ludo Player has a wide-variety of high-quality, premium HTML5 games. Our games are especially compressed and optimised to work on low-end devices, uncommon browsers, and patchy internet speeds.</div>
      <br>
      <div class="footer-text">We have games across several popular categories: Arcade, Action, Adventure, Sports &amp; Racing, Strategy, Puzzle &amp; Logic. We also have a strong portfolio of multiplayer games such as Ludo, Chess, 8 Ball Pool, Carrom, Tic Tac Toe, Archery, Quiz, Chinese Checkers and more! Some of our popular titles are: Escape Run, Bubble Wipeout, Tower Twist, Cricket Gunda, Ludo With Friends. If you have any suggestions around new games that we should add or if you are a game developer yourself and want to work with us, don't hesitate to drop in a line at
      <a href="mailto:info@vkludopalyer.com">info@vkludopalyer.com</a>!</div>
      </div>
      </section>
</section>
	</div>



	<script>
	    window.onscroll = function () {
    if (pageYOffset >= 250) {
        document.getElementById('backToTop').style.visibility = "visible";
    } else {
 document.getElementById('backToTop').style.visibility = "hidden";
    }
};

document.getElementById('backToTop').onclick = function()
{
    scrollTo(document.body, 0, 0);
}

function scrollTo(element, to, duration) {
    var start = element.scrollTop,
        change = to - start,
        currentTime = 0,
        increment = 20;

    var animateScroll = function(){
        currentTime += increment;
        var val = Math.easeInOutQuad(currentTime, start, change, duration);
        element.scrollTop = val;
        if(currentTime < duration) {
            setTimeout(animateScroll, increment);
        }
    };
    animateScroll();
}

//t = current time
//b = start value
//c = change in value
//d = duration
Math.easeInOutQuad = function (t, b, c, d) {
    t /= d/2;
    if (t < 1) return c/2*t*t + b;
    t--;
    return -c/2 * (t*(t-2) - 1) + b;
};
	</script>

	<!------Main Content End------>

	<!------Footer Start------>


	<div class="kyc-select">

		<div class="overlay">

		</div>
		<div class="box" style="bottom: 0px; position: absolute;">
			<div class="bg-white">
				<div class="header" style="border-bottom: unset;">
					<div class="d-flex position-relative align-items-center">
						<img src="{{asset('frontend/images/global-ytPlayIcon.png')}}" width="20px" alt="">
						<div class="games-section-title ml-3">How to play on VK Ludo Player?</div>
						<span class="position-absolute font-weight-bold cxy" style="right: 5px; height: 40px; width: 40px;">X</span>
					</div>

				<div style="padding-top: 150px; padding-bottom: 60px;">
					<div class="embed-responsive embed-responsive-16by9"></div>

				</div>
			</div>
		</div>
	</div>
</div>


<script>

	 function showMenu(){
		  document.getElementById("otherPage").style.display="block";
		  document.getElementById("buttonmenu").style.display="none";
		  document.getElementById("buttonmenu2").style.display="block";
	 }

	function hideMenu(){
		 document.getElementById("otherPage").style.display="none";
		  document.getElementById("buttonmenu").style.display="block";
		  document.getElementById("buttonmenu2").style.display="none";
	}

</script>
@endsection
