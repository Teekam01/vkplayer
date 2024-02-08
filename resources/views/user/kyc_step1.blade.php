@extends('layouts.master')

@section('head')
<style>
	.overlayState {
		pointer-events: auto;
		opacity: 0.87;
	}

	.popupState {}

</style>
<title>VK Ludo Player-Play Ludo King Win Real Money</title>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

@endsection



@section('content')
<div class="main-area" style="padding-top: 60px;">

    @if($user_data_details->verify_status == 1)
        <div class="container mt-5 ">
            <div class="card bg-light mb-2">
                <div class="card-body">
                    <img src="https://www.svgrepo.com/show/501855/card.svg" style="width: 20px;margin-right: 20px;" >
                    <span style="font-size: 14px;">Aadhar Number : {{$user_data_details->DOCUMENT_NUMBER}}</span>
                </div>
            </div>
            <div class="card bg-light mb-2">
                <div class="card-body">
                    <img src="https://www.svgrepo.com/show/530412/user.svg" style="width: 20px;margin-right: 20px;" >
                    <span style="font-size: 14px;">Name : {{$user_data_details->DOCUMENT_FIRST_NAME}}</span>
                </div>
            </div>
            <div class="card bg-light mb-2">
                <div class="card-body">
                    <img src="https://www.svgrepo.com/show/530140/calendar.svg" style="width: 20px;margin-right: 20px;" >
                    <span style="font-size: 14px;">DOB  : {{$user_data_details->DOCUMENT_DOB}}</span>
                </div>
            </div>
            <div class="card bg-light mb-2">
                <div class="card-body">
                    <img src="https://www.svgrepo.com/show/475318/address-book.svg" style="width: 20px;margin-right: 20px;" >
                    <span style="font-size: 14px;">ADDRESS  : {{$user_data_details->DOCUMENT_STATE}}</span>
                </div>
            </div>
        </div>
    @else
	    <div class="kycPage">
		<div><span style="font-size: 1.5em;">Step 1</span> of 3</div>
		<p class="mt-2" style="color: rgb(149, 149, 149);">You need to submit a document that shows that you are <span style="font-weight: 500;">above 18 years</span> of age and not a resident of <span style="font-weight: 500;">Assam, Odisha, Sikkim, Nagaland, Telangana, Andhra Pradesh, Tamil Nadu and Karnataka.</span></p><br>

		<div id="alertBox" class="alert" style="display: none;"></div>

		<form action="{{ url('/complete-kyc/step3') }}" method="post" id="mainForm">
                @csrf
                <input type="hidden" name="DOCUMENT_NAME" value="UID">
                <input type="hidden" name="transId" value="{{$transId}}">
                <div style="margin-top: 50px;" class="UIDtext">
                    <div class="kyc-doc-input">
                        <input type="number" name="DOCUMENT_NUMBER" autocomplete="off" id="inpf1" required max="999999999999" min="111111111111">
                        <div class="label">Enter Aadhaar Card Number</div>
                    </div>
                </div>

                <!-- Display the captcha image -->
                <div class="kyc-doc-input">
                    <img src="data:image/jpeg;base64,{{ $captchaImage }}" alt="Captcha Image" />

                    <!-- Input box for the captcha -->
                    <input type="text" name="captcha_input" autocomplete="off" id="captchaInput" required placeholder="Enter Captcha" style="text-transform: none;">
                </div>

                <div style="padding-bottom: 80px;"></div>
                <div class="refer-footer">
                    <input type="submit" class="disabledButton btn btn-primary btn-lg" style="width:100%" value="NEXT" id="next">
                </div>
            </form>




	</div>
    @endif

	<script>
		/*$('.UIDtext').hide();
		$('.DLtext').hide();
		$('.VIDtext').hide();

		function showOtherOptions(val) {
			if (val === "UID") {
				$('.UIDtext').show();
				$('.DLtext').hide();
				$('.VIDtext').hide();
			}
			if (val === "DL") {
				$('.UIDtext').hide();
				$('.DLtext').show();
				$('.VIDtext').hide();
			}
			if (val === "VID") {
				$('.UIDtext').hide();
				$('.DLtext').hide();
				$('.VIDtext').show();
			}

		}

		$('#inpf1').keyup(function() {
			var textBox = $('#inpf1').val() * 1;
			if ((textBox >= 11)) {
				$('.disabledButton').prop("disabled", false);
			} else {
				$('.disabledButton').prop("disabled", true);
			}
		});

		$('#inpf2').keyup(function() {
			var textBox = $('#inpf2').val() * 1;
			if ((textBox >= 11)) {
				$('.disabledButton').prop("disabled", false);
			} else {
				$('.disabledButton').prop("disabled", true);
			}
		});

		$('#inpf3').keyup(function() {
			var textBox = $('#inpf3').val() * 1;
			if ((textBox >= 11)) {
				$('.disabledButton').prop("disabled", false);
			} else {
				$('.disabledButton').prop("disabled", true);
			}
		});
*/

	</script>

	<style>
		.inv {
			display: none;
		}

	</style>
	<script>
		document
			.getElementById('target')
			.addEventListener('change', function() {
				'use strict';
				var vis = document.querySelector('.vis'),
					target = document.getElementById(this.value);
				if (vis !== null) {
					vis.className = 'inv';
				}
				if (target !== null) {
					target.className = 'vis';
				}
			});


		function checkLength() {
			var textbox = document.getElementById("inpf1");
			if (textbox.value.length <= 12 && textbox.value.length >= 12) {
				return true;
			} else {
				alert("Your comment is too short, please write more.");
					return false;
			}
		}

	</script>

	<script>
	    $(document).ready(function() {
            $('#next').click(function(e) {
                e.preventDefault();

                // Get form data
                let formData = new FormData($('#mainForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ url('/complete-kyc/step2') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if(response.status && response.status == 'success') {
                            $('#alertBox').removeClass('alert-danger').addClass('alert-success').text('OTP sent to your phone number').show();

                            // Add OTP input box dynamically
                            const otpInput = `
                                <div class="kyc-doc-input">
                                    <input type="number" name="otp_input" maxlength="6" autocomplete="off" id="otpInput" required placeholder="Enter OTP">
                                    <div class="label">Enter OTP sent to your phone</div>
                                </div>
                            `;

                            // Inserting the OTP input before the refer-footer div
                            $('.refer-footer').before(otpInput);

                            // Replace the "NEXT" button with a "SUBMIT" button
                            $("#next").replaceWith('<input type="submit" class="btn btn-primary btn-lg" style="width:100%" value="SUBMIT">');

                        } else {
                            let errorMessage = response.message || 'An error occurred';
                            $('#alertBox').removeClass('alert-success').addClass('alert-danger').text(errorMessage).show();
                        }
                    },
                    error: function(error) {
                        console.error("Error:", error);
                        $('#alertBox').removeClass('alert-success').addClass('alert-danger').text('An unexpected error occurred').show();
                    }
                });
            });
        });


	</script>

</div>

@endsection
