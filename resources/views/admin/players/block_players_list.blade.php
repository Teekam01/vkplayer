@extends('admin.master')


@section('head')
<title> Blocked Players </title>
@endsection


@section('content')

     <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Blocked Players</h1>
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ALL BLOCKED PLAYERS</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>Mobile No</th>
                                            <th>Wallet</th>
                                            <th>Refferal Code</th>
                                            <th colspan="2">Total Game Played </th>
                                            <th>Joined At </th>
                                            @if(Auth::user()->user_type == '1' || $permission->block_players == true)
                                                <th>Action </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>User ID</th>
                                            <th>Mobile No</th>
                                            <th>Wallet</th>
                                            <th>Refferal Code</th>
                                            <th colspan="2">Total Game Played </th>
                                            <th>Joined At </th>
                                            @if(Auth::user()->user_type == '1' || $permission->block_players == true)
                                                <th>Action </th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                  
                                      <?php $i=1; ?>
                                       @foreach($blocked_users as $user)
                                        <?php $userDATA = App\UserData::where('user_id', $user->id)->first(); ?>
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td><a href="{{ url('admin/player-view/'.$user->id) }}">@if($userDATA->verify_status==1) <img src="{{ asset('/backend/img/verify.png') }}" style="width:18px; float:left">@else <img src="{{ asset('/backend/img/unverify.png') }}" style="width:18px; float:left"> @endif &nbsp; {{ $user->vplay_id }}</a></td>
                                            <td><i class="fa-solid fa-phone-volume"></i> {{ $user->mobile }}</td>
											<td><img src="{{asset('frontend/images/global-rupeeIcon.png')}}" style="width:25px" alt=""> {{ $user->wallet }}
												<!--<a href="{{ url('admin/rechage-wallet/'.$user->id) }}" class="btn btn-success btn-sm" style="float:right">Recharge</a>
                                            </td>-->
                                            <td>{{ $user->referral_code }}</td>
											<td><span class="text-success"><img src="{{ asset('frontend/images/win.png') }}" style="width:30px"> {{ $user->total_win }}</span></td>
											<td><span class="text-danger"><img src="{{ asset('frontend/images/lost.png') }}" style="width:30px">{{ $user->total_lost }}</span></td>
                                            <?php 
											$date_time = explode(" ", $user->created_at);
											$date = $date_time[0];
											$date_explode = explode("-", $date);
											$year = $date_explode[0];
											$month = $date_explode[1];
											$day = $date_explode[2];
											$time = $date_time[1];
											?>
                                            <td><i class="fa-regular fa-clock"></i> {{$day}} / {{ $month }} / {{ $year }}  {{$time}}</td>
											@if(Auth::user()->user_type == '1' || $permission->block_players == true)
    											<td>
                                                    <a href="{{ url('admin/unblock-user/'.$user->id) }}" class="btn btn-danger btn-sm" title="Unblock User">Un-Block User</a>
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
