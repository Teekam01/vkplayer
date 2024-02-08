@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>
@endsection



@section('content')
<div class="main-area" style="padding-top: 65px;">
	<div class="center-xy">
		<!--<picture class="mt-1"><img width="226px" src="{{asset('frontend/images/referral-user-welcome.png')}}" alt=""></picture>-->
		<div class="mb-1 container">
			<div class="font-15">Redeem your refer balance <span role="img" aria-label="party-face">🥳</span></div>
			<div class="d-flex justify-content-center">TDS (0%) will be deducted after annual referral earning of ₹15,000.</div><br>
			<div class="text-bold mt-3 text-center">
			<!-- <form action="{{ url('comission-sent') }}" method="post"> -->
			<form action="#" id="comissionreedem" method="post">
			@csrf
				<input type="number" class="form-control" name="amount" Placeholder="ENTER AMOUNT" min="95" required autocomplete="off">
				<span style="color:orange; font-size:13px; font-weight:200; float:left">Minimum withdrawal amount ₹95</span><br>
				<span style="color:#222222; font-size:17px; font-weight:400; float:left">Money will be added to Wallet.</span><div>
				<input type="submit" id="reedemdisbled" name="submit" class="btn btn-primary" value="Reedem Now"></div>
			</form>

			</div>
		</div>
	</div>
	<br>
	<div class="divider-x"></div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <script>
	$(function(){

	$("#comissionreedem").validate({
		submitHandler: function(form) {
	    var formData= new FormData(jQuery('#comissionreedem')[0]);
	    $('#reedemdisbled').prop('disabled', true);
		jQuery.ajax({
				url: "{{ url('comission-sent') }}",
				type: "post",
				cache: false,
				data: formData,
				processData: false,
				contentType: false,

				success:function(data) {
				// var obj = JSON.parse(data);

				if(data.status==true){
				swal({title: data.title, text: data.message, type:
                    "success"}).then(function(){
                      window.location.href = data.url;
                     // $('#bettel_create_btn').prop('disabled', false);
                       }
                    );
				}
				else{
					swal({title: data.title, text: data.message, type:
                    "error"}).then(function(){
                      window.location.href = data.url;
                     // $('#bettel_create_btn').prop('disabled', false);
                       }
                    );
				}

				}
			});
		}
	});
});

</script>

@endsection
