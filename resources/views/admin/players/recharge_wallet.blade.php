@extends('admin.master')


@section('head')
<title> Players </title>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Players</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Recharge Wallet of "{{ $user->mobile }}"</h6>
		</div>
		<div class="card-body">
			<form method="post" action="#" id="user_recharge">
			<!-- <form method="post" action="{{ url('/admin/rechage-now') }}"> -->
			  @csrf
			  <input type="hidden" name="id" value="{{ $user->id }}">
			  <input type="hidden" name="wallet" value="{{ $user->wallet }}">
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">UserID</label>
					<div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="staticEmail" name="vplay_id" value="{{ $user->vplay_id }}">
					</div>
				</div>
                <div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Mobile No.</label>
					<div class="col-sm-10">
						<input type="text" readonly class="form-control-plaintext" id="staticEmail" name="mobile" value="{{ $user->mobile }}">
					</div>
				</div>
				 <div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Amount to be Add</label>
					<div class="col-sm-10">
						<input type="number" value="" required name="amount" class="form-control">
					</div>
				</div>
				
				<div class="form-group row">
				    <label for="staticEmail" class="col-sm-2 col-form-label">Reason</label>
					<div class="col-sm-10">
					 <textarea placeholder="Recharge required Reason Write Here" name="reason" class="form-control" id="exampleFormControlTextarea1" rows="3"  cols="auto"></textarea>
					</div>
				</div>
				
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<input type="submit" id="rechargedisable" value="Recharge Balance" class="btn btn-success">
					</div>
				</div>
			</form>
		</div>
	</div>

</div>
<!-- /.container-fluid -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">

	$("#user_recharge").submit(function(){
		 event.preventDefault();
       $('#rechargedisable').prop('disabled', true);
        $.ajax({
              method: 'POST',
              url:"{{ url('/admin/rechage-now') }}",
              data: new FormData(this),
               contentType: false,
               cache: false,
               processData:false,
              headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
              success: function(data){
               // alert(data.url);
                 // var obj = JSON.parse(data);
                 if(data.status==true){
				swal({title: data.title, text: data.message, type: 
                    "success"}).then(function(){ 
                      window.location.href = data.url;
                      $('#rechargedisable').prop('disabled', true);
                       }
                    );
				}
                // $("#module_id").html(data);
              }
        })
    })
</script>

@endsection
