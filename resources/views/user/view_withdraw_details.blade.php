@extends('layouts.master')

@section('head')
<title>VK Ludo Player-Play Ludo King Win Real Money</title>

@endsection



@section('content')

<div class="main-area" style="padding-top: 60px;">





			<table class="table table-striped">

  <tbody>
    <tr>
      <th>Transaction Id</th>
      <th>{{ $withdraw_details->transferId }}</th>
    </tr>
    <tr>
      <th>Amount</th>
      <th>{{ $withdraw_details->amount }}</th>
    </tr>
     <tr>
      <th>Status</th>
		 <th>
		 @if($withdraw_details->status == 'SUCCESS')
		 <span class="btn btn-success btn-xs">Paid</span>
		 @else
		 <span class="btn btn-danger btn-xs">{{ $withdraw_details->status }}</span>
		 @endif
		 </th>
    </tr>
     <tr>
      <th>Method</th>
      <th>{{ $withdraw_details->method }}</th>
    </tr>
     <tr>
      <th>Date and Time</th>
      <th>{{ $withdraw_details->created_at }}</th>
    </tr>


  </tbody>
</table>



</div>

@endsection
