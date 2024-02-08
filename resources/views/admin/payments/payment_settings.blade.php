@extends('admin.master')


@section('head')
<title> Payment Settings </title>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Payment Gateway Settings</h1>
	@if(session()->has('success'))
	<div class="alert alert-success">
		{{ session()->get('success') }}
	</div>
	@endif

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Choose Active Gateway </h6>
		</div>
		@if(Auth::user()->user_type == '1' || $permission->payment_settings == true)
		<div class="card-body">
			<form method="post" action="{{ url('admin/payment-gateway-update/') }}">
				@csrf

				<div class="col-md-12 mb-3">
						@if($activated_gateway->name == 'Cashfree')
						<img src="{{ asset('/images/payments/cashfree.png') }}" style="width:150px">
						@endif
						@if($activated_gateway->name == 'UPI Gateway')
						<img src="{{ asset('/images/payments/UPI gateway.jpg') }}" style="width:150px">
						@endif
						@if($activated_gateway->name == 'UPI API')
						<img src="{{ asset('/images/payments/upiapilogo.png') }}" style="width:150px">
						@endif
					<div class="row">
						<div class="col-md-6">
						
						
							<select name="gateway_status" id="" class="form-control" required>
								<option style="color:green" value=" ">{{ $activated_gateway->name }} (Activated) </option>
								<option value=" ">--------------------------</option>
								<option value="upi_api"> UPI API </option>
								<option value="cashfree"> Cashfree Payment Gateway </option>
								<option value="upi_gateway"> UPI Gateway </option>
							</select>
						</div>
						<div class="col-md-5">
							<input type="submit" value="Active Now" class="btn btn-primary">
						</div>

					</div>
				</div>
			</form>
			<div class="col-md-12">
				<div class="row">
						<div class="col-md-4" style="border:1px solid #bababa; padding:10px">
						<img src="{{ asset('/images/payments/upiapilogo.png') }}" style="width:150px">
						<hr>
						<form action="{{ url('admin/payment-upiapi/update/'.$upi_api->id) }}" method="post">
							@csrf
							<div class="form-group">
								<label>UPI API KEY</label>
								<input type="text" name="UPIAPI_KEY" class="form-control" value="{{ $upi_api->parameter_one }}" required>
							</div>
                            
                            <div class="form-group">
								<label>UPI API SECRET</label>
								<input type="text" name="UPIAPI_SECRET" class="form-control" value="{{ $upi_api->parameter_two }}" required>
							</div>
                            
                            
                            
							<div class="form-group">
								<label>Minimum Add Amount for player</label>
								<input type="number" name="upiapi_min_add_amount" class="form-control" value="{{ $upi_api->min_add_amount }}" required>
							</div>
							<div class="form-group">
								<label>Maximum Add Amount for player</label>
								<input type="number" name="upiapi_max_add_amount" class="form-control" value="{{ $upi_api->max_add_amount }}" required>
							</div>
							<input type="submit" class="btn btn-primary" Value="Save Details">
						</form>
					</div>

					<div class="col-md-4" style="border:1px solid #bababa; padding:10px">
						<img src="{{ asset('/images/payments/cashfree.png') }}" style="width:85px">
						<hr>

						<form action="{{ url('admin/payment-cashfree/update/'.$cashfree->id) }}" method="post">
							@csrf
							<div class="form-group">
								<label>CASHFREE API KEY</label>
								<input type="text" name="CASHFREE_API_KEY" class="form-control" value="{{ $cashfree->parameter_one }}" required>
							</div>
							<div class="form-group">
								<label>CASHFREE API SECERT KEY</label>
								<input type="text" name="CASHFREE_API_SECRET" class="form-control" value="{{ $cashfree->parameter_two }}" required>
							</div>
							<div class="form-group">
								<label>Minimum Add Amount for player</label>
								<input type="number" name="cashfree_min_add_amount" class="form-control" value="{{ $cashfree->min_add_amount }}" required>
							</div>
							<div class="form-group">
								<label>Maximum Add Amount for player</label>
								<input type="number" name="cashfree_max_add_amount" class="form-control" value="{{ $cashfree->max_add_amount }}" required>
							</div>
							<input type="submit" class="btn btn-primary" Value="Save Details">
						</form>
					</div>

					<div class="col-md-4" style="border:1px solid #bababa; padding:10px">
						<img src="{{ asset('/images/payments/UPI gateway.jpg') }}" style="width:150px">
						<hr>
						<form action="{{ url('admin/payment-upigateway/update/'.$upi_gateway->id) }}" method="post">
							@csrf
							<div class="form-group">
								<label>UPI GATEWAY API KEY</label>
								<input type="text" name="UPIGATEWAY_API_KEY" class="form-control" value="{{ $upi_gateway->parameter_one }}" required>
							</div>

							<div class="form-group">
								<label>Minimum Add Amount for player</label>
								<input type="number" name="upigateway_min_add_amount" class="form-control" value="{{ $upi_gateway->min_add_amount }}" required>
							</div>
							<div class="form-group">
								<label>Maximum Add Amount for player</label>
								<input type="number" name="upigateway_max_add_amount" class="form-control" value="{{ $upi_gateway->max_add_amount }}" required>
							</div>
							<input type="submit" class="btn btn-primary" Value="Save Details">
						</form>
					</div>
				</div>
			</div>
		</div>
		
		@else
		<div class="card-body">
		    <p>You don't have any permission</p>
		</div>
		@endif


	</div>

</div>
<!-- /.container-fluid -->


@endsection
