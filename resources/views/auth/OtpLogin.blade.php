@extends('layouts.master') 

@section('content')


<div class="main-area">
				<div style="overflow-y: hidden;">
					<div class="splash-overlay"></div>
					<div class="splash-screen">
						<figure><img width="100%" src="{{asset('frontend/images/global-gameSheetSplash.png')}}" alt=""></figure>
					</div>
					<form name="loginform" action="{{ route('loginWithOtpSubmit') }}"  id='loginform' method="post">
					@csrf
					<div class="position-absolute w-100 center-xy mx-auto" style="top: 45%; z-index: 4;">
						<div class="d-flex text-white font-15 mb-4">Sign in or Sign up</div>
							<div class="message"></div>
						<div class="bg-white px-4 cxy flex-column py-4" id="incheight" style="width: 85%;  border-radius: 5px;">
						
							<div class="input-group" style="transition: top 0.5s ease 0s;">
								<div class="input-group-prepend">
									<div class="input-group-text" style="width: 100px;">+91</div>
								</div><input class="form-control" name="mobile" id="mobile" type="tel" placeholder="Mobile number" min="0000000000" maxlength="10"  style="transition: all 3s ease-out 0s;" value="{{ session('mb_no') }}" required>
							</div>
							 <span id="error" class="error"></span>
							
							<div class="input-group pt-2 otp" style="transition: left 0.5s ease 0s; ">
								<div class="input-group-prepend">
									<div class="input-group-text" style="width: 100px;">OTP</div>
								</div><input class="form-control" name="otp" type="number" placeholder="Enter OTP" autocomplete="off" value=""  required>
								<div class="invalid-feedback">Enter a correct OTP</div>
							</div> 
							 <div class="input-group py-2 justify-content-between timer">
                            <div id="show_time">Time Remaining:<span id="timer"></span></div>
                            <div>
                                <a href="#"id="resend_otp_btn" onclick="sendOtp()">Resend OTP</a>
                            </div>
                        </div>
						</div>
						<button type="submit" class="bg-green refer-button cxy mt-4 otp" style="width: 85%;">lOGIN</button>
						<a href="#" class="bg-green refer-button cxy mt-4 send-otp" onclick="sendOtp()" style="width: 85%;">Send OTP</a>
					</div>
					
					</form>
					
				<div class="login-footer">By proceeding, you agree to our <a href="/term-condition">Terms of Use</a>, <a href="/privacy-policy">Privacy Policy</a> and that you are 18 years or older. You are not playing from Assam, Odisha, Nagaland, Sikkim, Meghalaya, Andhra Pradesh, or Telangana.</div>
				</div>
			</div>


@php
  $reffered_by = $_GET['refer'] ?? '';
@endphp
    <script>
        $('.otp').hide();
        $('.timer').hide();
        
        $('#loginform').on('submit', function(e) {
            let formData = new FormData(this);
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'loginWithOtp',
                type: 'post',
                contentType: false,
                // dataType: 'json',
                cache: false,
                processData: false,
                data: formData,
                success: function(data) {
					if(data.status){
						$('.message').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+data.msg+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						setTimeout(function() {
							window.location.href = data.url
						}, 2000);
					}else {
						$('.message').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+data.msg+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#otp').val('');
					}
                   
                },
                error: function() {
                    console.log('error');
                }
            });

        });
        
        function sendOtp() {
        	var reffered_by = '{{ $reffered_by }}';
			let mobile = document.forms["loginform"]["mobile"].value;
			  if (mobile == "" || mobile.length < 10) {
					error.textContent = "Please enter a valid number"
					error.style.color = "red"
				
				return false;
			  }
			
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //alert($('#mobile').val());
            $.ajax( {
                url:'sendOtp',
                type:'post',
                data: {'mobile': $('#mobile').val(),'reffered_by':reffered_by},
                success:function(data) {
                     console.log(data);
                    if(data.status){
                        
                        $('.message').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+data.msg+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                        timer(30);
                        $('#resend_otp_btn').addClass("disable-click");
                        $('.timer').show();
                        $('.otp').show();
                        $('.error').hide();
                        $('.send-otp').hide();
				// 		const incHeight = document.getElementById("incheight");
			 //            incHeight.classList.add("height-120");
                    }else {
                        $('.message').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+data.msg+' <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                    }   
                },
                error:function () {
                    console.log('error');
                }
            });
        }
        
         let timerOn = true;

        function timer(remaining) {
			// $('#show_time').show();
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;

            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            document.getElementById('timer').innerHTML = m + ':' + s;
            remaining -= 1;

            if (remaining >= 0 && timerOn) {
                setTimeout(function() {
                    timer(remaining);
                }, 1000);
                return;
            }

            if (!timerOn) {
                // Do validate stuff here
                return;
            }
            // Do timeout stuff here
            $('#resend_otp_btn').removeClass("disable-click");
			// $('#show_time').hide();


        }
    </script>
    <style>
     .disable-click {
            pointer-events: none;
        }
		.height-70{
			height: 70px;
		}
		.height-120{
			height: 120px;
		}
		
    </style>
@endsection