@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>

@endsection



@section('content')
<div class="main-area" style="padding-top:60px">
		<div class="cxy flex-column mx-5 mt-5 text-center">
		    <p><strong> You will get your withdrawal in just </strong></p>
            <div id="countdown">Time Remaining: 15:00</div>
			<div class="my-3 text-center" style="width: 100%;">
				<div class="footer-text" style="font-size: 0.9em;">We are verifying your details. You will be notified when your amount is Approved.</div>
			</div>
		</div>
		
		<div class="container">
		    
		    <h5>Your Withdraw Request</h5>
		    <div class="card mb-3 bg-light">
		        <div class="card-body d-flex justify-content-between">
		            <div>
		                <p class="text-success m-0"><strong>₹{{$request->amount}}</strong></p>
		                <small class="text-secondary">{{Carbon\Carbon::parse($request->created_at)->format('d-M-Y, h:i A') }}</small>
		            </div>
		            <div>
		                <p class="badge badge-{{$request->status == 'proccess' ? 'success' : 'danger' }} ">{{$request->status}}</p>
		            </div>
		        </div>
		    </div>
		</div>
		<div class="backButton text-center">
		    <a href="/" class="btn btn-success btn-sm">Go back to games</a>
		</div>
	</div>
	<script>
    const createdAt = new Date('{{ $request->created_at }}'); // Convert Laravel datetime string to JavaScript Date object
    const endTime = new Date(createdAt.getTime() + 15 * 60000); // Add 15 minutes to created_at time
    
    function updateCountdown() {
        const now = new Date();
        const diff = endTime - now;

        if(diff <= 0) {
            document.getElementById('countdown').textContent = 'Time is up!';
            clearInterval(interval); // Stop the countdown
        } else {
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            document.getElementById('countdown').textContent = `Time Remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }
    }

    const interval = setInterval(updateCountdown, 1000); // Update countdown every second
</script>


@endsection
