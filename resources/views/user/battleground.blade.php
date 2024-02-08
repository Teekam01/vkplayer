@extends('layouts.master')
@section('head')
    <title>VK Ludo Player - Play Ludo King Win Real Money</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .resp-r {
            margin-left: 70px !important;
        }

        @media screen and (min-width: 480px) {
            .resp-r {
                margin-left: 130px !important;
            }
        }

        .Home_bgSecondary__0O2kV {
            background-color: #6c757d !important;
        }

        .Home_playButton__V95wM {
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

        .Home_cxy__fI4uz {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        @keyframes slideInFromLeft {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .slide-in {
            animation: slideInFromLeft 0.5s forwards;
        }
        .openBattle {
            transition: transform 1s, opacity 1s;
            transform: translateX(-100%);
            opacity: 0;
        }
        
        .openBattle.slide-enter {
            transform: translateX(0);
            opacity: 1;
        }


    </style>

  


    <script>
        var auto_refresh = setInterval(
        	function() {
        		$('#runningBattle').load('<?php echo url('/battle_running/' . $game_id); ?>');
    	}, 1000);

           var auto_refresh = setInterval(
        	function() {
        		$('#openBattle').load('<?php echo url('/battle_open/' . $game_id); ?>');
        	}, 1000);




     

      

    </script>
@endsection



@section('content')
    <div class="main-area" style="padding-top: 60px;">
<span class="btn btn-danger" style="width:100%;font-size:12px"><b>Notice: </b> {{$homePageNotice->home_page_notice}} </span>
        <!---------------------------
                 -----------------------------
                 Code For SET BATTLE START
                 -----------------------------
                 ---------------------------->
                 
        <span class="cxy battle-input-header">Create a Battle!</span>
        <div class=" d-flex my-2 w-60 resp-r">
            <!--<form action="{{ url('create-lobby') }}" id="setbettel" method="post">-->
            <form action="#" id="setbettel" method="post">
                <input type="hidden" name="game_url" value="{{ $url }}">
                @csrf
                <div style="margin-top:10px">
                    <input class="form-control" type="tel" name="amount" placeholder="Amount" value="" required
                        style="width:79%;">
                    <button id="bettel_create_btn" class="bg-green playButton cxy position-static" type="submit"
                        style="margin: -35px; margin-right: -27px; float:right">Set</button>
                </div>


                <!--<div style="margin-top:10px; margin-bottum:10px; display: flex; justify-content: space-between;">-->
                <!--	<input type="text" class="form-control" type="tel" name="label" placeholder="Add Conditions " value="" style="width:79%;">-->
                <!--	<a href="{{ url('info-conditions') }}"><img class="ml-2" src="{{ asset('frontend/images/global-grey-iButton.png') }}" alt="" style="float:right; margin-top:7px; margin-right:1px"></a>-->
                <!--</div>-->

            </form>
        </div>


        <!---------------------------
                 -----------------------------
                 Code For SET BATTLE END
                 -----------------------------
                 ---------------------------->

        <div class="divider-x"></div>


        <div class="px-4 py-3">
            <div class="mb-2" style="display: flex; justify-content: space-between;">
                <div>
                    <img src="{{ asset('frontend/images/global-battleIconWhiteStroke.png') }}" width="20px"
                        alt="">
                    <span class="ml-2 games-section-title">Open Battles</span>
                </div>
                <a href="{{ url('rules') }}"><span
                        class="games-section-headline text-uppercase position-absolute mt-2 font-weight-bold"
                        style="right: 1.3rem;">Rules
                        <img class="ml-2" src="{{ asset('frontend/images/global-grey-iButton.png') }}"
                            alt=""></span></a>
            </div>
            <div id="myOpenBattles"></div>
            
            

            <!--//Open Battle is here-->
            <div id="openBattle">

            </div>


    <!-- OPEN BATTLE FAKE TABLES -->
    
            <div id="bet" class="betCard mt-1 openBattle">
                <span class="betCard-title pl-3 d-flex align-items-center text-uppercase">
                    CHALLENGE FROM<span class="ml-1" style="color: brown;">Tanisa Yadav</span>
                </span>
            
                <div class="d-flex pl-3">
                    <div class="pr-3 pb-1">
                        <span class="betCard-subTitle">Entry Fee</span>
                        <div>
                            <img src="https://rajludoplayer.com/frontend/images/global-rupeeIcon.png" width="21px" alt="">
                            <span class="betCard-amount">100</span>
                        </div>
                    </div>
                    <div>
                        <span class="betCard-subTitle">Prize</span>
                        <div>
                            <img src="https://rajludoplayer.com/frontend/images/global-rupeeIcon.png" width="21px" alt="">
                            <span class="betCard-amount">197</span>
                        </div>
                    </div>
                    <div style="margin-top:17px; margin-left:14px; font-size:11px" align="center">
                        <div align="center"></div>
                    </div>
            
                    <a onclick="playRequest(this)" href="javascript:void(0);" class="playBtn Home_bgSecondary__0O2kV Home_playButton__V95wM Home_cxy__fI4uz btn-sm" style="color:white; font-size:0.7em; font-weight:700; text-decoration:none">PLAY</a>

                </div>
            </div>
    
        <!-- OPEN BATTLE FAKE TABLES END -->


        </div>
        <!---------------------------
                 -----------------------------
                 Code For OPEN BATTLE END
                 -----------------------------
                 ---------------------------->

        <div class="divider-x"></div>


        <!---------------------------
                 -----------------------------
                 Code For Running Battle start
                 -----------------------------
                 ---------------------------->
    
        <div class="px-4 py-3">
            <div class="mb-2"><img src="{{ asset('frontend/images/global-battleIconWhiteStroke.png') }}" width="20px"
                    alt=""><span class="ml-2 games-section-title">Running Battles </span></div>

    

            <div id="myRunningBattles"></div>
            



            <div id="runningBattle">
            </div>
            <div id="container">
                @foreach (range(0, 49) as $item)
                    @php
                        if($game_id == 2 )
                            $money = mt_rand(2000, 50000);
                        else
                            $money = mt_rand(100, 2000);
                        $price = $money - ($money * ($commission/100));
                    @endphp
                    <div class="betCard1 mt-1 shadow-sm" id="playing-chdiv-2213314" style="--i:{{ $item }};background: #fff;"  >
                        <div class="d-flex"><span class="betCard-title pl-3 d-flex align-items-center text-uppercase">PLAYING
                                FOR<img class="mx-1" src="{{ asset('frontend/images/global-rupeeIcon.png') }}" width="21px"
                                    alt="">{{ $money }}</span>
                            <div class="betCard-title d-flex align-items-center text-uppercase"><span
                                    class="ml-auto mr-3">PRIZE<img class="mx-1"
                                        src="{{ asset('frontend/images/global-rupeeIcon.png') }}" width="21px" alt="">{{round($price)}}</span></div>
                        </div>
                        <div class="py-1 row">
                            <div class="pr-3 text-center col-5">
                                <div class="pl-2"><img class="border-50"
                                        src="{{ asset('images/profilesImage/Avatar2.png') }}" width="21px" height="21px"
                                        alt=""></div>
                                <div style="line-height: 1;"><span class="betCard-playerName">{{ Str::random(6) }}</span></div>
                            </div>
                            <div class="pr-3 text-center col-2 cxy">
                                <div><img src="{{ asset('frontend/images/versus.png') }}" width="30px" alt=""></div>
                            </div>
                            <div class="text-center col-5">
                                <div class="pl-2"><img class="border-50"
                                        src="{{ asset('images/profilesImage/Avatar2.png') }}" width="21px" height="21px"
                                        alt=""></div>
                                <div style="line-height: 1;"><span class="betCard-playerName">{{ Str::random(6) }}</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!---------------------------
                 -----------------------------
                 Code For Running Battle end
                 -----------------------------
                 ---------------------------->

    </div>
    <!-- Modal -->
    <div class="modal fade" id="room_code_model" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Room Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="room_code_model_body">

                </div>
                {{-- <div class="modal-footer">

		</div> --}}
            </div>
        </div>
    </div>
    <a class="bg-light border shadow rounded-circle d-flex align-items-center justify-content-center position-fixed text-dark"
        href="/support" style="height: 60px; width: 60px; z-index: 10; bottom: 30px; right: 30px;"><svg
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" height="36px" fill="currentColor">
            <path
                d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z">
            </path>
        </svg></a>

    <script>
        $(document).on('click', '.setcustumcode', function(e) {
            var Battles = $(this).data("id");
            var html = '<form method="GET" id="store_code" action="/lobby/start/' + Battles +
                '" ><input type="text" hidden class="form-control " name="battlesid" placeholder="Room Code" value="' +
                Battles +
                '"><input type="text" class="form-control " name="roomcode" placeholder="Room Code" value="" maxlength="8"  minlength="8" required><div class="d-block mt-2"><button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button><button type="submit" class="btn btn-success">Save</button></div></form>';
            $('#room_code_model_body').html(html);
            $('#room_code_model').modal('show');
        });

        //  $("#setbettel").submit(function(e){
        //     e.preventDefault();
        //         $("#setbettel")[0].submit();
        //         $('#bettel_create_btn').attr('type', 'button');
        //     //  $('#bettel_create_btn').prop('disabled', true);
        // });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <script>
        $(function() {

            $("#setbettel").validate({
                submitHandler: function(form) {
                    var formData = new FormData(jQuery('#setbettel')[0]);
                    $('#bettel_create_btn').prop('disabled', true);
                    jQuery.ajax({
                        url: "{{ url('create-lobby') }}",
                        type: "post",
                        cache: false,
                        data: formData,
                        processData: false,
                        contentType: false,

                        success: function(data) {
                            // var obj = JSON.parse(data);

                            if (data.status == false) {
                                swal({
                                    title: data.title,
                                    text: data.message,
                                    type: "error"
                                }).then(function() {
                                    //   window.location.reload();
                                    $('#bettel_create_btn').prop('disabled', false);
                                });
                            }

                        }
                    });
                }
            });
        });
    </script>

    <script>
    $(document).ready(function () {
    
    function generateRandomString(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

    function generateDiv() {
        // Generate a random entry fee between 50 to 2000 which is divisible by 50
        const entryFee = Math.floor((Math.random() * 40) + 1) * 50;
        var prize = entryFee- Math.floor(entryFee * 0.03);
        const randomNameLength = Math.floor(Math.random() * 3) + 6; // Random length between 6-8
        const randomName = generateRandomString(randomNameLength);

        // Return the div with the given structure and random values
        return `
            <div class="betCard mt-1 openBattle">
                <span class="betCard-title pl-3 d-flex align-items-center text-uppercase">
                    CHALLENGE FROM<span class="ml-1" style="color: brown;">${randomName}</span>
                </span>
                
                <div class="d-flex pl-3">
                    <div class="pr-3 pb-1">
                        <span class="betCard-subTitle">Entry Fee</span>
                        <div>
                            <img src="https://rajludoplayer.com/frontend/images/global-rupeeIcon.png" width="21px" alt="">
                            <span class="betCard-amount">₹${entryFee}</span>
                        </div>
                    </div>
                    <div>
                        <span class="betCard-subTitle">Prize</span>
                        <div>
                            <img src="https://rajludoplayer.com/frontend/images/global-rupeeIcon.png" width="21px" alt="">
                            <span class="betCard-amount">₹${prize}</span>
                        </div>
                    </div>
                    
                    <a onclick="playRequest(this)" href="javascript:void(0);" class="playBtn1 Home_bgSecondary__0O2kV Home_playButton__V95wM Home_cxy__fI4uz btn-sm" style="color:white; font-size:0.7em; font-weight:700; text-decoration:none">PLAY</a>


                </div>
            </div>
        `;
    }


    function addDiv() {
        const newDiv = $(generateDiv());
        // Insert a new div before the first `.openBattle`
        $('.openBattle:first').before(newDiv);

        // Add slide animation to the newly added div
        setTimeout(() => {
            newDiv.addClass('slide-enter');
        }, 10); // A slight delay ensures the transform transition takes effect

        // If there are more than 5 `.openBattle` divs, remove the last one
        if ($('.openBattle').length > 5) {
            $('.openBattle:last').remove();
        }
    }

    // Populate initial 5 divs
    for (let i = 0; i < 5; i++) {
        addDiv();
    }

    // Setup interval to randomly add a new div and remove the last one
    setInterval(function () {
        const randomTime = Math.floor(Math.random() * 2000) + 1000; // Random time between 1-3 seconds
        setTimeout(addDiv, randomTime);
    }, 1000);
});
    </script>
<script>
    $(document).on('click', '.playBtn1', function() {
        $(this).text('Already Accepted');
        setTimeout(() => {
            $(this).text('PLAY');
        }, 1000);
    });
</script>
@endsection
