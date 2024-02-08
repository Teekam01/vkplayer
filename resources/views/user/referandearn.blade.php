@extends('layouts.master')

@section('head')
    <title>VK Ludo Player-Play Ludo King Win Real Money</title>
@endsection



@section('content')
    <div class="main-area" style="padding-top: 60px;">
        <div class="center-xy">

            <div class="mb-1">


            </div>
        </div>

        <img src="{{ asset('frontend/images/referral-user-welcome.png') }}" alt="refer" class="center">
    </div>
    <div class="container">
        <div>
            <div>
                </br>
                <div class="input-group">

                </div>
            </div>
        </div>
        </br>
        <div class="d-grid">
            <a
                href="whatsapp://send?text=Play Ludo and earn ₹10000 daily.%0ACommission Charge - 5% Only%0AReferral - 3% On All Games%0A24x7 Live Chat Support%0AInstant Withdrawal Via UPI/Bank%0ARegister Now, My refer code is {{ $user->referral_code }}.%0A👇👇%0Ahttps://vkludoplayer.com/login?refer={{ $user->referral_code }}">


                <button class="btn btn-success btn-lg mb-3 d-flex align-items-center justify-content-center w-100"> <i
                        class="fa fa-whatsapp"></i> Share on Whatsapp </button>
            </a>
        </div>


        <div class="d-grid">
            <a
                href="https://telegram.me/share/url?url=Play Ludo and earn ₹10000 daily.%0ACommission Charge - 5% Only%0AReferral - 3% On All Games%0A24x7 Live Chat Support%0AInstant Withdrawal Via UPI/Bank%0ARegister Now, My refer code is {{ $user->referral_code }}.%0A👇👇%0A https://vkludoplayer.com/login?refer={{ $user->referral_code }}">


                <button class="btn btn-primary btn-lg mb-3 d-flex align-items-center justify-content-center w-100"> <i
                        class="fa fa-telegram"></i> Share on Telegram </button>
            </a>
        </div>

        <input type="hidden"
            value="Play Ludo and earn ₹10000 daily.Commission Charge - 5% Only Referral - 3% On All Games 24x7 Live Chat Support. Instant Withdrawal Via UPI/Bank Register Now, My refer code is {{ $user->referral_code }}. 👇👇 https://vkludoplayer.com/login?refer={{ $user->referral_code }}"
            id="myInput2">
        <button onclick="myFunction2()" class="btn btn-secondary btn-md w-100"> <i class="fa fa-clipboard"></i> Copy to
            Clipboard</button>



        <div class="mb-3 shadow card">
            <div class="card-body">
                <div class="g-0 gx-2 mb-2 row">
                    <div class="col">
                        <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card">
                            <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                                <div class="hstack gap-1 minBreakpoint-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16"
                                        height="16" fill="currentColor">
                                        <path
                                            d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z">
                                        </path>
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                        </path>
                                        <path
                                            d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                        </path>
                                    </svg>
                                    <span>Total Refers</span>
                                </div>
                            </div>
                            <div class="fs-5 fw-semibold text-start py-1 px-2 card-body"><b>{{ $total_refferal }}</b></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex flex-column align-items-stretch justify-content-start h-100 w-100 card">
                            <div class="text-capitalize text-start px-2 card-header" style="font-size: 0.9rem;">
                                <div class="hstack gap-1 minBreakpoint-xs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16"
                                        height="16" fill="currentColor">
                                        <path
                                            d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z">
                                        </path>
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z">
                                        </path>
                                        <path
                                            d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                                        </path>
                                    </svg>
                                    <span>Referral Earning</span>
                                </div>
                            </div>
                            <div class="fs-5 fw-semibold text-start py-1 px-2 card-body"><b>₹{{ $user->wallet_reffer }}</b>
                                <a href="{{ url('comission-reedem') }}">Reedem</a></div>
                        </div>
                    </div>
                </div>




                <div class="mb-3 card">
                    <div class="bg-light text-dark card-header">
                        <center><b>How It Works</b></center>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">You can refer and <b>Earn 3%</b> of your referral winning, every
                                time</li>
                            <li class="list-group-item">Like if your player plays for <b>₹10000</b> and wins, You will get
                                <b>₹300</b> as referral amount.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function myFunction() {
            // Get the text field
            var copyText = document.getElementById("myInput");

            // Select the text field


            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
    </script>

    <script>
        function myFunction2() {
            // Get the text field
            var copyText = document.getElementById("myInput2");

            // Create a temporary input element
            var tempInput = document.createElement("input");

            // Set the value of the input element to the text to be copied
            tempInput.setAttribute("value", copyText.value);

            // Add the input element to the DOM
            document.body.appendChild(tempInput);

            // Select the text field
            tempInput.select();

            // Execute the copy command
            document.execCommand("copy");

            // Remove the input element from the DOM
            document.body.removeChild(tempInput);

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
        // function myFunction2() {
        //   // Get the text field
        //   var copyText = document.getElementById("myInput2");

        //   // Select the text field


        //   // Copy the text inside the text field
        //   navigator.clipboard.writeText(copyText.value);

        //   // Alert the copied text
        //   alert("Copied the text: " + copyText.value);
        // }
    </script>
@endsection
