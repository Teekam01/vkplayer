@extends('admin.master')


@section('head')
<title> Payments View </title>
@endsection


@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</a> Payments View </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Payment View</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<h5>Payment Details</h5>
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<tbody>
									<tr>
										<th>Order ID</th>
										<td>{{ $payment->order_id }}</td>
									</tr>
									<tr>
										<th>Order Token</th>
										<td>{{ $payment->order_token }}</td>
									</tr>
									<tr>
										<th>Amount</th>
										<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> {{ $payment->amount }}</td>
									</tr>
									<tr>
										<th>Status</th>
										<td>
											 @if($payment->status == 'PAID')
												<span style="color:green; font-weight:800">Received</span>
                                               @elseif($payment->status == 'ACTIVE')
                                               <span style="color:#d9c000; font-weight:800">In Process</span>
                                               @else
                                                <span style="color:#d9c000; font-weight:800">Failed</span>
                                              @endif
										</td>
									</tr>
									<tr>
										<th>Created At</th>
										<?php 
												$date_time = explode(" ", $payment->created_at);
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
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
							<h5>User Details</h5>
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<tbody>
									<tr>
										<th>User</th>
										<td>{{ $userDetails->vplay_id }}</td>
									</tr>
									<tr>
										<th>Mobile</th>
										<td>{{ $userDetails->mobile }}</td>
									</tr>
									<tr>
										<th>Email</th>
										<td>{{ $userDetails->email }}</td>
									</tr>
									<tr>
									<?php $userDATA = App\UserData::where('user_id', $userDetails->id)->first(); ?>
										<th>Verified or, Not</th>
										<td>
										@if($userDATA->verify_satatus == 1)
										<img src="{{ asset('/backend/img/verify.png') }}" style="width:30px; float:left">
						             	&nbsp; <span style="font-size:25px; color:Green;">Verified</span>   
										@else
										<img src="{{ asset('/backend/img/verify.png') }}" style="width:30px; float:left">
							            &nbsp; <span style="font-size:25px; color:Green;">Verified</span> 
										@endif
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

@endsection
