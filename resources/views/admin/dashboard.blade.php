@extends('admin.master')


@section('head')
<title> Dashboard</title>
@endsection


@section('content')


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Welcome "{{ Auth::user()->name }}" to {{Auth::user()->user_type == "1" ? "(Owner)" : "(Admin)" }} Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                 
                    <!-- DataTales Example -->
                <!--    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Running Tables</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                              
                                <table class="table table-stripped" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Battle ID</th>
                                            <th>Player 1</th>
                                            <th>Player 2</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Game Type</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $i=1; ?>
                                        @foreach($battles as $row)
                                         <tr>
                                            <td>{{ $i }}</td>
                                            <td><img src="{{asset('frontend/images/battle.png')}}" style="width:25px" alt=""> {{ $row->battle_id }}</td>
                                            <td>
												<?php $player_one = App\User::where('id', $row->creator_id)->first(); ?>
												{{ $player_one->vplay_id }}
                                            </td>
                                            <td>
                                            @if(isset($row->joiner_id))
												<?php $player_two = App\User::where('id', $row->joiner_id)->first(); ?>
												{{ $player_two->vplay_id }}
                                           @else
                                               Waiting for Player
                                           @endif
                                            </td>
                                            <td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> {{ $row->entry_fee }}</td>
                                            <td>
                                             @if($row->is_running == 'yes' && $row->game_status == '1')
                                               <span  class="text-xs font-weight-bold text-success text-uppercase " style="font-size:15px; ">Running</span>
                                             @elseif($row->game_status == '3')
                                               <span  class="text-xs font-weight-bold text-primary text-uppercase " style="font-size:15px">Completed</span>
                                             @elseif($row->game_status == '1')
                                              <span  class="text-xs font-weight-bold text-warning text-uppercase " style="font-size:15px">New</span>
                                             @endif
                                            </td>
                                             <td><?php  $game_details = App\Game::where('id',$row->game_id)->first(); ?> {{ $game_details->game_name  }}</td>
                                             
                                            <td> <?php 
											$date_time = explode(" ", $row->created_at);
											$date = $date_time[0];
											$date_explode = explode("-", $date);
											$year = $date_explode[0];
											$month = $date_explode[1];
											$day = $date_explode[2];
											$time = $date_time[1];
											?>
                                            <i class="fa-regular fa-clock"></i> {{$day}} / {{ $month }} / {{ $year }}  {{$time}}</td>
                                        </tr>
                                        <?php $i++; ?>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>-->

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TOTAL USERS</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $no_of_users }}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa-sharp fa-solid fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               TOTAL USERS WALLET BALANCE</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="fa-solid fa-indian-rupee-sign"></i> {{ $total_user_wallet_balance }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-indian-rupee-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">TODAY NEW USERS
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $today_user }}</div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-user-plus fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                          <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">TOTAL BLOCKED USERS
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $blocked_user }}</div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-user-times fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                TODAY GAME</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$today_battle}}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa-solid fa-dice fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                          <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                               ALL GAME</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$all_battle}}</div>
                                        </div>
                                        <div class="col-auto">
                                       <i class="fa-solid fa-dice fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                          <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                TODAY SUCCESS GAME</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $today_succes_game }}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa-solid fa-dice fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                     <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                TOTAL CANCEL GAME</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_cancel_game}}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa-sharp fa-solid fa-ban fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                     <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               TOTAL ADMIN COMMISSION</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <i class="fa-solid fa-indian-rupee-sign"></i>{{ $total_admin_comission }}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa-solid fa-money-bill-1 fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        		
                     <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               TODAY ADMIN COMMISSION</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <i class="fa-solid fa-indian-rupee-sign"></i>{{ $today_admin_comission }}</div>
                                        </div>
                                        <div class="col-auto">
                                           <i class="fa-solid fa-money-bill-1 fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                 TOTAL DEPOSIT</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <i class="fa-solid fa-indian-rupee-sign"></i> {{ $total_deposite }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-piggy-bank fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                     <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                TODAY DEPOSIT</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> <i class="fa-solid fa-indian-rupee-sign"></i> {{ $today_total_deposite }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-piggy-bank fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                         <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                 TOTAL WITHDRAWAL</div>
                                            <div class="h5 mb-0 font-weight-bold "> <i class="fa-solid fa-indian-rupee-sign"></i>{{ $total_withdraw }}</div>
                                        </div>
                                        <div class="col-auto">
                                          <i class="fa-solid fa-money-bill-transfer  fa-2x text-gray-300"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
						
                     <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                TODAY  WITHDRAWAL</div>
                                            <div class="h5 mb-0 font-weight-bold "> <i class="fa-solid fa-indian-rupee-sign"></i>{{$today_total_withdraw}}</div>
                                        </div>
                                        <div class="col-auto">
                                          <i class="fa-solid fa-money-bill-transfer  fa-2x text-gray-300"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                     <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                             TOTAL WON AMOUNT</div>
                                            <div class="h5 mb-0 font-weight-bold text-gtay-800"> <i class="fa-solid fa-indian-rupee-sign"></i> {{ $total_won_amount }}</div>
                                        </div>
                                        <div class="col-auto">
                                         <i class="fa-solid fa-trophy fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
						
                        	
                     <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                             TODAY WON AMOUNT</div>
                                            <div class="h5 mb-0 font-weight-bold text-gtay-800"> <i class="fa-solid fa-indian-rupee-sign"></i> {{ $today_won_amount }}</div>
                                        </div>
                                        <div class="col-auto">
                                         <i class="fa-solid fa-trophy fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                  
						
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                TOTAL PENDING KYC</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$total_pending_KYC}}</div>
                                        </div>
                                        <div class="col-auto">
                                          <i class="fa-solid fa-file  fa-2x text-gray-300"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                   
                   <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                TOTAL APPROVED KYC</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$total_approved_KYC}}</div>
                                        </div>
                                        <div class="col-auto">
                                          <i class="fa-solid fa-file  fa-2x text-gray-300"></i> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   
                   
                   
                    </div>

                    <!-- Content Row -->

                  
                </div>
                <!-- /.container-fluid -->

       

@endsection
