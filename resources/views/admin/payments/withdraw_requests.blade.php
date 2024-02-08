@extends('admin.master')


@section('head')
<title> Withdraw Requests </title>
@endsection


@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Withdraw Requests </h1>

	<!-- DataTales Example -->
@if(Auth::user()->user_type == '1' || $permission->withdraw_request == true)
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="col-md-12">
				<h6 class="m-0 font-weight-bold text-primary">ALL PAYMENT REQUESTS</h6>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div>
						Withdraw Request Set To
						<form action="{{ url('admin/save-withdrawal-option') }}" method="post" style="float:right; color:black; font-weight:800; font-size:15px">
							@csrf
							<input class="form-check-input" type="radio" name="withdraw_option" id="automatic" value="automatic" @if($withdraw_setting->options == 'automatic') checked @endif >
							<label class="form-check-label" for="automatic">
								Automatic
							</label>
							&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
							<input class="form-check-input" type="radio" name="withdraw_option" id="manual" value="manual" @if($withdraw_setting->options == 'manual') checked @endif>
							<label class="form-check-label" for="manual">
								Manual
							</label>

							<input type="submit" name="submit" class="btn btn-info btn-sm" value="Save ">
						</form>
					</div>
				</div>
			</div><hr>
			<div class="row">
				
					   <div class="col-md-4">
						Withdraw API (CASHFREE) Credentials :
						</div>
						<div class="col-md-8">
						<form action="{{ url('admin/save-withdrawal-creds') }}" method="post" style="float:right; color:black; font-weight:800; font-size:15px">
							@csrf
							Client ID <input type="text" name="clientId" value="{{ $withdraw_setting->clientId }}" style="height:31px">  &nbsp;
							Client Secret <input type="text" name="clientSecret" value="{{ $withdraw_setting->clientSecret }}" style="height:31px">

							<input type="submit" name="submit" class="btn btn-info btn-sm" value="Save Credentials " style="float:right">
						</form>
						</div>
			</div>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Request ID</th>
							<th>User ID</th>
							<th>Mobile</th>
							<th>Amount</th>
							<th>Payment Via</th>
							<th>Status </th>
							<th>Created At </th>
							<th>Action </th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Request ID</th>
							<th>User ID</th>
							<th>Mobile</th>
							<th>Amount</th>
							<th>Payment Via</th>
							<th>Status </th>
							<th>Created At </th>
							<th>Action </th>
						</tr>
					</tfoot>
					<tbody>

						<?php $i=1; ?>
						@foreach($requests as $request)
						<?php $userDetails = App\User::where('id', $request->user_id)->first(); 
										      $userData = App\UserData::where('user_id', $request->user_id)->first();
										?>
						<?php $userBankDetails = App\UserBankDetail::where('id', $request->bank_details_id)->first(); ?>
						<tr>
							<td>{{ $i }}</td>
							<td>#{{ $request->withdraw_id }}</td>
							<td>
								<a href="{{ url('admin/player-view/'.$userDetails->id) }}"> @if($userData->verify_status == 1) <img src="{{asset('backend/img/verify.png')}}" style="width:18px; float:left"> @else <img src="{{asset('backend/img/unverify.png')}}" style="width:18px; float:left"> @endif &nbsp; {{ $userDetails->vplay_id}} </a>
							</td>
							<td>{{ $userDetails->mobile}}</td>
							<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> ₹ {{ $request->amount}}</td>
							<td>{{ $request->get_amount_via}}</td>
							<td>
								@if($request->status == 'process')
								<span style="color:#d9c000; font-weight:800">Process</span>
								@elseif($request->status == 'success')
								<span style="color:green; font-weight:800">Success</span>
								@else
								<span style="color:red; font-weight:800">Reject</span>
								@endif

							</td>

							<?php 
												$date_time = explode(" ", $request->created_at);
												$date = $date_time[0];
												$date_explode = explode("-", $date);
												$year = $date_explode[0];
												$month = $date_explode[1];
												$day = $date_explode[2];
												$time = $date_time[1];
											?>
							<td>
								<i class="fa-regular fa-clock"></i>
								{{$day}} / {{ $month }} / {{ $year }} {{$time}}
							</td>
							<td>
								<a href="{{ url('admin/withdraw-view/'.$request->id) }}" class="btn btn-info btn-sm btn-xs" title="View ">View </a>
							</td>
						</tr>
						<?php $i++; ?>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</div>
@else
<div class="card">
    <div class="card-body">
        <p>You Don't Have Any Permission</p>
    </div>
</div>
@endif
</div>
<!-- /.container-fluid -->

@endsection
