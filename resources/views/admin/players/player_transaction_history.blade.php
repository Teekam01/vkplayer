@extends('admin.master')


@section('head')
<title> Transcation History </title>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Transaction History of {{ $user_details->vplay_id }} </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">

			<div class="co-md-12"  style="padding:30px">
			<div class="row">
				<div class="col-md-6">
					<img src="{{asset('frontend/images/avatars/Avatar2.png')}}" style="width:120px; height:auto; border:5px solid #395fcf; border-radius:50%; float:right ">
				</div>
				<div class="col-md-6">
				<div style="float:left; margin-top:10px; color: #395fcf">
				<h4>{{ $user_details->vplay_id }}</h4>
				<h4>{{ $user_details->mobile }}</h4>
				<h4><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:40px" alt=""> {{ $user_details->wallet }}</h4>
					</div>
				</div>
				</div>
			</div>

		</div>

		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Transction Details</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Order/Battle ID</th>
							<th>Day</th>
							<th>Month</th>
							<th>Paying/Playing Time</th>
							<th>Amount</th>
							<th>Status</th>
							<th>Reason</th>
							<th>Closing Balance</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Order/Battle ID</th>
							<th>Day</th>
							<th>Month</th>
							<th>Paying/Playing Time</th>
							<th>Amount</th>
							<th>Status</th>
							<th>reason</th>
							<th>Closing Balance</th>
						</tr>
					</tfoot>
					<tbody>

						<?php $i=1; ?>
						@foreach($trans_history as $row)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $row->order_id }}</td>
							<td>{{ $row->day }}</td>
							<td>{{ $row->month }} </td>
							<td><i class="fa-regular fa-clock"></i> {{ $row->paying_time }}</td>
							<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt="">  {{ $row->amount }}</td>
							<td>
					           @if($row->add_or_withdraw == 'cancel' && $row->where_to_show == 'admin')
						         
						             <span class="text text-danger"> Game Cancelled </span>
						         
							    @endif 
					          
					          @if($row->add_or_withdraw == 'add') 
						          @if($row->remark == 'Receive From Friend')
					                <?php $deetail = App\User::where('id', $row->to_or_from_user_id)->first(); ?>
						            <span class="text text-success">Receive from Friend ({{$deetail->vplay_id}}) </span>
						           @elseif($row->add_or_withdraw == 'add' && $row->where_to_show == 'admin')
					                 <span class="text text-success"> Game Won </span>
					               @elseif($row->add_or_withdraw == 'add' && $row->remark == 'refferal')
					                 <span class="text text-success"> Refferal Amount Added </span>
					               @elseif($row->add_or_withdraw == 'add' && $row->remark == 'By Admin')
					                 <span class="text text-success"> Added by Admin</span>  
					               @else
						             <span class="text text-success"> CASH ADDED </span>
						          @endif
							    @endif 
							    
							    @if($row->add_or_withdraw == 'withdraw') 
						          @if($row->remark == 'Sent To Friend')
					               <?php $deetail_s = App\User::where('id', $row->to_or_from_user_id)->first();?>
						            <span class="text text-danger">Sent to Friend ({{$deetail_s->vplay_id}})</span>
						          @elseif($row->add_or_withdraw == 'withdraw' && $row->where_to_show == 'admin')
					                 <span class="text text-danger"> Game Lost </span>
						          @elseif($row->remark == 'Penalty')
						          
						            <span class="text text-danger">Penalty</span> 
						          @elseif($row->withdraw_status == 'SUCCESS')
						          <span class="text text-danger">WITHDRAW SUCCESS</span> 
						          @elseif($row->withdraw_status == 'reject')
						          <span class="text text-danger">WITHDRAW REJECTED</span> 
						          @else
						            <span class="text text-danger">CASH WITHDRAW (Auto)</span> 
						          @endif
							      
							     @endif</td>
							     <td>
							         @if($row->reason)
							         {{ $row->reason }}
							         @else {{_('N/A')}}@endif</td>
							<td> <img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt="">  {{ $row->closing_balance }}</td>
						</tr>
						<?php $i++; ?>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->


@endsection
