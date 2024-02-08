@extends('layouts.master')

@section('head')
    <title>VK Ludo Player-Play Ludo King Win Real Money</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        #output {
            width: 100%;
            border: 1px solid black;
            padding: 5px;
        }

        .showhide {
            display: none;
        }
    </style>

    <style>
        #loading {
            position: fixed;
            width: 100%;
            height: 100vh;
            background: #fff url('{{ asset('images/loader/loading.gif') }}') no-repeat center;
            z-index: 99999;
            display: none
        }
        @keyframes blinkWithFade {
          0%, 100% {
            opacity: 1;
          }
          50% {
            opacity: 0;
          }
        }

        .roomCode .badge.badge-success {
          animation: blinkWithFade 2s infinite;
        }

    </style>
@endsection



@section('content')
    <div id="loading"></div>
    <div class="main-area" style="padding-top: 60px;">
        <div class="battleCard-bg">
            <div class="battleCard">
                <div class="players cxy pt-2">
                    <div class="flex-column cxy">
                        <h5></h5><img src="{{ asset('/images/profilesImage/' . $creator_detail->image) }}" width="50px"
                            height="50px" alt="" style="border-radius: 50%;">
                        <div style="line-height: 1;"><span
                                class="Home_betCard_playerName__57U-C">{{ $creator_detail->vplay_id }} </span></div>
                    </div><img class="mx-3" src="{{ asset('frontend/images/versus.png') }}" width="23px" alt="">
                    <div class="flex-column cxy ">
                        <h5> </h5><img src="{{ asset('/images/profilesImage/' . $joiner_detail->image) }}" width="50px"
                            height="50px" alt="" style="border-radius: 50%;">
                        <div style="line-height: 1;"><span
                                class="Home_betCard_playerName__57U-C">{{ $joiner_detail->vplay_id }} </span></div>
                    </div>
                </div>
                <div class="amount cxy mt-2"><span style="opacity: 0.8;">Playing for</span><img class="mx-1"
                        src="{{ asset('frontend/images/global-rupeeIcon.png') }}" width="25x" alt=""><span
                        style="font-size: 1.2em; font-weight: 700; opacity: 0.8;">{{ $battle_details->entry_fee }}</span>
                </div>
                <div class="thin-divider-x my-3"></div>
                <div class="roomCode cxy flex-column">
                    <div class="text-center">
                        @if($battle_details->creator_id == Auth::id() && ($battle_details->LOBBY_ID == '' && $battle_details->LOBBY_ID == NULL))
                        <p>Copy Roomcode From Ludo King And Enter Here</p>
                        <form method="post" action={{url('updateroomcode')}}>
                            @csrf
                            <input type="hidden" name="battleid" value="{{$battle_details->battle_id}}">
                            <input type="text" name="roomcode" id="roomcode" class="form-control mb-3" style="height: 60px;" placeholder="Enter room code" >
                            <input type="submit" id="submitButton" class="btn btn-success mb-4" value="Submit Room Code" disabled>

                        </form>

                        @elseif($battle_details->joiner_id == Auth::id() && ($battle_details->LOBBY_ID == '' && $battle_details->LOBBY_ID == NULL))
                        <div class="roomCode"><p class="badge badge-success">Wait For Room Code</p></div>
                            <!--<h3>{{$battle_details->LOBBY_ID}}</h3>-->
                        @else
                        <div>Room Code</div>
                        <span>
                            <input type="hidden" id="myInput"
                                value="{{ $battle_details->LOBBY_ID }}">{{ $battle_details->LOBBY_ID }}</span>
                    </div>

                    <button class="bg-green playButton position-static mt-2" onclick="myFunction()" id="copyCode"
                        style="color:white;">Copy Code</button>
                    <button class="bg-green playButton position-static mt-2" id="copyShow"
                        style="display:none; color:white">
                        Room Code Copied
                    </button>
                    @endif
                </div>
                <div class="cxy app-discription flex-column">
                    <div class="mt-2">

                    </div>
                </div>
            </div>


            <div>
                <div class="rules"><span class="cxy mb-1"><u>Game Rules</u></span>
                    <ol class="list-group list-group-numbered">
                        <li class="list-group-item">Record Every Game While Playing.</li>
                        <li class="list-group-item">For Cancellation of Game, Video Proof is Necessary.</li>
                        <li class="list-group-item">
                            <h6 class="d-none  text-danger d-block text-justify">◉ Opponent की एक गोटी खुलने के तुरंत बाद आप
                                Game Left करते हो तो Opponent को 30% Win कर दिया जायेगा । Auto Exit में Admin का निर्णय ही
                                अंतिम निर्णय होगा जिसे आपको मानना होगा । लेकिन यदि आप गेम को जानबूझकर Auto Exit में छोड़ते है
                                तो आपको Loss कर दिया जायेगा । ध्यान रहे यदि किसी भी केस में Opponet की 2 गोटी बाहर आ जाती है
                                तो आप पूरा गेम Loss ही होंगे ।</h6>
                        </li>
                        <li class="list-group-item">
                            <h6 class="d-none  text-danger d-block text-justify">◉ महत्वपूर्ण नोट: यदि आप गेम के परिणामों को
                                अपडेट नहीं करते हैं, तो आपके वॉलेट बैलेंस पर जुर्माना लगाया जाएगा।
                                <br>
                                <style>
                                    .rule-btn {
                                        background-color: black;
                                        color: white;
                                        padding: 5px 7px;
                                        text-decoration: none;
                                        text-align: center;
                                        margin: 10px 60px;
                                    }
                                </style>
                            </h6>
                        </li>
                    </ol>
                </div>



        <div class="container">
            <div class=" rounded p-0" style="border:1px solid">
                    <div class="">
                        <p class="alert alert-danger">Match Status</p>
                    </div>
                @if ($battle_details->joiner_id == Auth::user()->id && $battle_details->joiner_result != null)
                    <p class="p-2 text-danger">You have submitted result as <strong>"{{"$battle_details->joiner_result"}}"</strong>  at <strong>"{{$battle_details->joiner_result_time}}"</strong></p>
                @elseif($battle_details->creator_id == Auth::user()->id && $battle_details->creator_result != null)
                    <p class="p-2 text-danger">You have submitted result as <strong>{{"$battle_details->creator_result"}}</strong>  at <strong>{{$battle_details->creator_result_time}}</strong></p>
                @else
                <div class="d-flex justify-content-between">
                    <label class="radio-inline">
                        <input type="radio" name="battleResult" id="won_div" value="win"
                            onchange="chooseResult(this);" required>
                        <h6 style="color:green"> I Won </h6>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="battleResult" id="lost_div" value="lost"
                            onchange="chooseResult(this);" required>
                        <h6 style="color:red"> I Lost </h6>
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="battleResult" id="cancel_div" value="cancel"
                            onchange="chooseResult(this);" required>
                        <h6 style="color:orange"> Cancel </h6>
                    </label>
                </div>
                @endif
            </div>
            </div>




                <!--winner form-->
                <div id="win">
                    <!--<form action="{{ url('/battle-result/' . $battle_details->id) }}" enctype="multipart/form-data" method="post" style="border:1px solid grey; background-color:#efefef; padding:10px" align="center">-->
                    <form action="#" id="winbattle" enctype="multipart/form-data" method="post"
                        style="border:1px solid grey; background-color:#efefef; padding:10px" align="center">

                        @csrf
                        <input type="hidden" name="player_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="battleResult" value="win">
                        <input type="hidden" name="winuser_id" id="winuser_id" value="{{ $battle_details->id }}">
                        <!------Image Upload Code------->

                        <div id="screen_shot_upload" align="center">
                            <label>
                                <input type="file" name="screenshot_image" class="form-control" style="height:50px; tex-align:center; background-color:green; color:white "  accept="image/*" required>
          </label>
         </div>





     <script>
         function upload(file) {
             var fr = new FileReader();

             fr.onload = function(event) {
                 var src = event.target.result;
                 var img = new Image();

                 img.onload = function() {
                     $('.select-img').remove();
                     $('#image').css('display', 'block').attr('src', src).resizable({
                         aspectRatio: this.width / this.height
                     });
                 };

                 img.src = src;
             };

             fr.readAsDataURL(file);
         }

         $('.select-img').click(function() {
             var fileInput = $(document.createElement("input"));
             fileInput.attr('type', 'file');
             fileInput.attr('accept', 'image/*');
             fileInput.trigger('click');

             $(fileInput).on('change', function(ev) {
                 upload(ev.target.files[0]);
             });

             return false;
         });
     </script>


        <style>
    .select-img {
                width: 250px;
                height: 250px;
                border-radius: 10px;
                cursor: pointer;
                border: 3px dashed gray;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: sans-serif;
                font-size: 25px;
            }

            #image {
                display: none;
            }
        </style>




      <!------Image Upload Code------->

         <div align="center">
          <input   type="submit" id="windisabled" class="btn btn-success" value="Submit Result">

         </div>
         <br>
        </form>
       </div>
       <!--loser form-->
       <div id="lose">
        <!--<form action="{{ url('/battle-result/' . $battle_details->id) }}" enctype="multipart/form-data" method="post" style="border:1px solid grey; background-color:#efefef; padding:10px" align="center">-->
        <form action="#" id="lostbattle" enctype="multipart/form-data" method="post" style="border:1px solid grey; background-color:#efefef; padding:10px" align="center">
         @csrf
         <input type="hidden" name="player_id" value="{{ Auth::user()->id }}">
         <input type="hidden" name="battleResult" value="lost">
         <input type="hidden" name="lostuser_id" id="lostuser_id" value="{{ $battle_details->id }}">
         <div id="lost_message" align="center">
          <label>
           Best Luck for Next Time, Try Again!
          </label>
         </div>

         <div align="center">
          <input onclick="rejectRequest(this)" id="lostdisabled" type="submit" class="btn btn-success" value="Submit Result">
         </div>
         <br>
        </form>
       </div>
       <!--cancel form-->
       <div id="cancel">
        <!--<form action="{{ url('/battle-result/' . $battle_details->id) }}" enctype="multipart/form-data" method="post" style="border:1px solid grey; background-color:#efefef; padding:10px" align="center">-->
        <form action="#" id="cancelbattle" enctype="multipart/form-data" method="post" style="border:1px solid grey; background-color:#efefef; padding:10px" align="center">
         @csrf
         <input type="hidden" name="player_id" value="{{ Auth::user()->id }}">
         <input type="hidden" name="battleResult" value="cancel">
         <input type="hidden" name="canceluser_id" id="canceluser_id" value="{{ $battle_details->id }}">

         <div id="cancel_reason" align="center">
            <label>
                <select name="cancel_reason" class="form-control" required>
                    <option value="">चुनें</option>
                    <option value="no_room_code">no room code</option>
                    <option value="not_joined">not joined</option>
                    <option value="room_code_popular_mode">Room code in popular mode</option>
                    <option value="game_not_started">game not started</option>
                    <option value="not_playing">not playing</option>
                    <option value="others">others</option>
                </select>
            </label>
        </div>


         <div align="center">
          <input onclick="rejectRequest(this)" id="canceldisabled" type="submit" class="btn btn-success" value="Submit Result">
         </div>
        </form>
       </div>


       <style>
        .radio-inline {
         padding: 23px;
         font-weight: 900;
         font-size: 16px;
        }

        /*input[type=radio] {
         border: 0px;
         width: 100%;
         height: 2em;
        }*/

       </style>

      </div>
        </div>
    </div>
    <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td  {
      border: 1px solid #dddddd;
      text-align: left;bold;
      padding: 4px;
      color:red;
      text
    }
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 4px;

    }


    </style>
    </head>
    <body>



    <table>
      <tr>
        <th>Penalty Amount</th>
        <th>Reason</th>

      </tr>
      <tr>
        <td><b>₹ 100</b></td>
        <th>Fraud/Fake Screenshot</th>

      </tr>
      <tr>
        <td><b>₹ 50</b></td>
        <th>Wrong Update</th>

      </tr>
      <tr>
        <td><b>₹ 50</b></td>
        <th>No Update</th>

      </tr>
      <tr>
        <td><b>₹ 25</b></td>
        <th>Abusing</th>

      </tr>

    </table>
    <!---RoomCode Copy----->
    <script>
        function myFunction() {
            // Get the text field
            var copyText = document.getElementById("myInput");




            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            document.getElementById("copyShow").style.display = "block";
            document.getElementById("copyCode").style.display = "none";
        }
    </script>
    <!---End RoomCode Copy----->
    <script>
        $(function() {

            // listen for changes
            $('input[type="radio"]').on('change', function() {

                // get checked one
                var $target = $('input[type="radio"]:checked');
                // hide all divs with .showhide class
                $(".showhide").hide();
                // show div that corresponds to selected radio.
                $($target.attr('data-section')).show();

                // trigger the change on page load
            }).trigger('change');

        });
    </script>

    <script>
        function rejectRequest(link) {
            link.onclick = function(event) {
                event.preventDefault();
            }
        }


        $(document).ready(function() {

            document.getElementById("win").style.display = "none";
            document.getElementById("lose").style.display = "none";
            document.getElementById("cancel").style.display = "none";
        });


        /*$(document).ready(function() {
        	$("#won_div").click(function() {
        		$("#screen_shot_upload:hidden").show('slow');
        		$("#lost_message").hide();
        		$("#cancel_reason").hide();
        	});

        });

        $(document).ready(function() {
        	$("#lost_div").click(function() {
        		$("#screen_shot_upload").hide();
        		$("#lost_message:hidden").show('slow');
        		$("#cancel_reason").hide();
        	});

        });


        $(document).ready(function() {
        	$("#cancel_div").click(function() {
        		$("#screen_shot_upload").hide();
        		$("#lost_message").hide();
        		$("#cancel_reason:hidden").show('slow');
        	});

        });*/
    </script>


     <script>
         function chooseResult(that) {
             if (that.value == "win") {
                 //alert('win');
                 document.getElementById("win").style.display = "block";
                 document.getElementById("lose").style.display = "none";
                 document.getElementById("cancel").style.display = "none";
             }
             if (that.value == "lost") {
                 //alert('lost');
                 document.getElementById("win").style.display = "none";
                 document.getElementById("lose").style.display = "block";
                 document.getElementById("cancel").style.display = "none";
             }
             if (that.value == "cancel") {
                 //alert('cancel');
                 document.getElementById("win").style.display = "none";
                 document.getElementById("lose").style.display = "none";
                 document.getElementById("cancel").style.display = "block";
             }
         }
     </script>

       <script>
           var preloader = document.getElementById('loading');


           function loaderfunction() {
               preloader.style.display = 'block';
           }
       </script>



      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

        <script>
            $(function() {

                $("#winbattle").validate({

                    submitHandler: function(form) {
                        var winid = $('#winuser_id').val();
                        var formData = new FormData(jQuery('#winbattle')[0]);
                        $('#windisabled').prop('disabled', true);
                        jQuery.ajax({
                            url: "{{ url('/battle-result') }}/" + winid,
                            type: "post",
                            cache: false,
                            data: formData,
                            processData: false,
                            contentType: false,

                            success: function(data) {
                                // var obj = JSON.parse(data);

                                if (data.status == true) {
                                    swal({
                                        title: data.title,
                                        text: data.message,
                                        type: "success"
                                    }).then(function() {
                                        window.location.href = data.url;
                                        //  $('#bettel_create_btn').prop('disabled', false);
                                    });
                                } else {
                                    swal({
                                        title: data.title,
                                        text: data.message,
                                        type: "error"
                                    }).then(function() {
                                        window.location.href = data.url;
                                        //  $('#bettel_create_btn').prop('disabled', false);
                                    });
                                }

                            }
                        });
                    }
                });
            });
        </script>

    <script>
        $(function() {

            $("#lostbattle").validate({

                submitHandler: function(form) {
                    var lostid = $('#lostuser_id').val();
                    var formData = new FormData(jQuery('#lostbattle')[0]);
                    $('#lostdisabled').prop('disabled', true);
                    jQuery.ajax({
                        url: "{{ url('/battle-result/') }}/" + lostid,
                        type: "post",
                        cache: false,
                        data: formData,
                        processData: false,
                        contentType: false,

                        success: function(data) {
                            // var obj = JSON.parse(data);

                            if (data.status == true) {
                                swal({
                                    title: data.title,
                                    text: data.message,
                                    type: "success"
                                }).then(function() {
                                    window.location.href = data.url;
                                    //  $('#bettel_create_btn').prop('disabled', false);
                                });
                            } else {
                                swal({
                                    title: data.title,
                                    text: data.message,
                                    type: "error"
                                }).then(function() {
                                    window.location.href = data.url;
                                    //  $('#bettel_create_btn').prop('disabled', false);
                                });
                            }

                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(function() {

            $("#cancelbattle").validate({

                submitHandler: function(form) {
                    var cancelid = $('#canceluser_id').val();

                    var formData = new FormData(jQuery('#cancelbattle')[0]);
                    $('#canceldisabled').prop('disabled', true);
                    jQuery.ajax({
                        url: "{{ url('/battle-result/') }}/" + cancelid,
                        type: "post",
                        cache: false,
                        data: formData,
                        processData: false,
                        contentType: false,

                        success: function(data) {
                            // var obj = JSON.parse(data);

                            if (data.status == true) {
                                swal({
                                    title: data.title,
                                    text: data.message,
                                    type: "success"
                                }).then(function() {
                                    window.location.href = data.url;
                                    //  $('#bettel_create_btn').prop('disabled', false);
                                });
                            } else {
                                swal({
                                    title: data.title,
                                    text: data.message,
                                    type: "error"
                                }).then(function() {
                                    window.location.href = data.url;
                                    //  $('#bettel_create_btn').prop('disabled', false);
                                });
                            }

                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#roomcode").on("input", function() {
                var value = $(this).val();
                if (/^0\d{7}$/.test(value)) { // Check if the value starts with 0 and has 8 digits in total
                    $("#submitButton").prop("disabled", false);
                } else {
                    $("#submitButton").prop("disabled", true);
                }
            });
        });

    </script>
@endsection
