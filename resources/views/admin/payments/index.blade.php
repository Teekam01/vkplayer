@extends('admin.master')


@section('head')
<title> Payments </title>
@endsection


@section('content')
   <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Payments </h1>
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ALL PAYMENTS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>User ID</th>
                                            <th>Mobile</th>
                                            <th>Amount</th>
                                            <th>Status </th>
                                            <th>Created At </th>
                                            @if(Auth::user()->user_type == '1' || $permission->payment_received == true)
                                                <th>Action </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                         <tr>
                                            <th>#</th>
                                            <th>Order ID</th>
                                            <th>User ID</th>
                                            <th>Mobile</th>
                                            <th>Amount</th>
                                            <th>Status </th>
                                            <th>Created At </th>
                                            @if(Auth::user()->user_type == '1' || $permission->payment_received == true)
                                            <th>Action </th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                  
                                      <?php $i=1; ?>
                                       @foreach($payments as $payment)
                                        <?php $userDetails = App\User::where('id', $payment->user_id)->first(); ?>
                                        <?php $userDATA = App\UserData::where('user_id', $userDetails->id)->first(); ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $payment->order_id}}</td>
                                            @if(Auth::user()->user_type == '1' || $permission->payment_received == true)
                                            <td>
												<a href="{{ url('admin/player-view/'.$userDetails->id) }}">
												   @if($userDATA->verify_status==1) 
												   <img src="{{ asset('/backend/img/verify.png') }}" style="width:18px; float:left">
												   @else 
												   <img src="{{ asset('/backend/img/unverify.png') }}" style="width:18px; float:left"> 
												   @endif 
												   &nbsp; {{ $userDetails->vplay_id }}
												</a>
                                            </td>
                                            @else
                                            <td>
                                                {{ $userDetails->vplay_id }}
                                            </td>
                                            @endif
                                            <td>
												<i class="fa-solid fa-phone-volume"></i> 
												{{ $userDetails->mobile }}
                                            </td>
											<td>
												<img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> {{ $payment->amount }}
                                            </td>
                                            <td>
                                              @if($payment->status == 'PAID')
												<span style="color:green; font-weight:800">Received</span>
                                               @elseif($payment->status == 'ACTIVE')
                                               <span style="color:#d9c000; font-weight:800">In Process</span>
                                               @else
                                                <span style="color:#d9c000; font-weight:800">Failed</span>
                                              @endif
                                               
                                            </td>
                                            
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
												{{$day}} / {{ $month }} / {{ $year }}  {{$time}}
                                            </td>
                                            @if(Auth::user()->user_type == '1' || $permission->payment_received == true)
											<td>
												 <a href="{{ url('admin/payment-details/'.$payment->id) }}" class="btn btn-info btn-sm btn-xs" title="View ">View </a>
                                             </td>
                                             @endif
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
