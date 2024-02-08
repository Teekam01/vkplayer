<style>
    /*@keyframes slideInFromLeft {*/
    /*        0% {*/
    /*            transform: translateX(-100%);*/
    /*            opacity: 0;*/
    /*        }*/

    /*        100% {*/
    /*            transform: translateX(0);*/
    /*            opacity: 1;*/
    /*        }*/
    /*    }*/

    /*    .betCard {*/
    /*        animation: 0.5s ease-out 0s 1 slideInFromLeft;*/
            /* Reduced from 1s to 0.5s for a faster animation */
    /*        animation-delay: calc(0.05s * var(--i));*/
            /* Reduced from 0.1s to 0.05s for a faster staggered effect */
    /*    }*/
</style>

@foreach($battle_running as $row) <!-- battle running-->
		<?php $creator = App\User::where('id', $row->creator_id)->first();
				$joiner = App\User::where('id', $row->joiner_id)->first();
			 ?>
		<div id="633c3b4e85a962efab2f95db" class="betCard mt-1 shadow-sm w-100" style="background: #fff !important;">
			<div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">
			    PLAYING FOR <img class="mx-1" src="{{asset('frontend/images/global-rupeeIcon.png')}}" width="21px" alt="">{{ $row->amount }}</span>
    			@if($row->creator_id==Auth::user()->id || $row->joiner_id==Auth::user()->id && $row->approve == 'under_review')
    			 <!-- <div class=" d-flex align-items-center text-uppercase">-->
    				<!--<span class="ml-auto mr-6"><a href="#" class="btn btn-info btn-sm" style="padding:3px; font-size:11px;"> Pending</a></span>-->
    				<!--</div>-->
    			@endif
    			@if($row->creator_id==Auth::user()->id || $row->joiner_id==Auth::user()->id)
    			<div class="  text-uppercase">
    			    <span class="ml-auto mr-3"><a href="{{url('/view-battle/'.$row->battle_id) }}" class="btn btn-info btn-sm" style="border:0 !important; font-size:11px;">View</a></span>
    			</div>
    			@else
    				<div class="betCard-title d-flex align-items-center text-uppercase"><span class="ml-auto mr-3">PRIZE<img class="mx-1" src="{{asset('frontend/images/global-rupeeIcon.png')}}" width="21px" alt="">{{(int) $row->prize }}</span></div>
    			@endif
			</div>
			<div class="py-1 row">
				<div class="pr-3 text-center col-5">
					<div class="pl-2"><img class="border-50" src="{{asset('/images/profilesImage/'.$creator->image)}}" width="21px" height="21px" alt=""></div>
					<div style="line-height: 1;"><span class="betCard-playerName">{{ $creator->vplay_id }} </span></div>
				</div>
				<div class="pr-3 text-center col-2 cxy">
					<div><img src="{{asset('frontend/images/versus.png')}}" width="21px" alt=""></div>
				</div>
				<div class="text-center col-5">
					<div class="pl-2"><img class="border-50" src="{{asset('/images/profilesImage/'.$joiner->image)}}" width="21px" height="21px" alt=""></div>
					<div style="line-height: 1;"><span class="betCard-playerName">{{$joiner->vplay_id}}</span></div>
				</div>
			</div>
		</div>
    @endforeach
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Check if animation has already been played
    if (!localStorage.getItem('animationPlayed')) {
        // If not, set the flag
        localStorage.setItem('animationPlayed', 'true');
    } else {
        // If animation has been played, remove the animation class from elements
        document.querySelectorAll('.betCard').forEach(function(card) {
            card.style.animation = 'none';
        });
    }
});

        
    </script>
