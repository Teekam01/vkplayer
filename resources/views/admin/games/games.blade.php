@extends('admin.master')


@section('head')
<title> Games </title>
@endsection


@section('content')

     <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Games</h1>
                     @if(session()->has('success'))
							<div class="alert alert-success">
								{{ session()->get('success') }}
							</div>
							@endif
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">ALL GAMES <a href="{{ url('admin/games/create') }}" style="float:right" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Game</a></h6>
                        </div>
                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            @if(Auth::user()->user_type == '1' || $permission->games == true)
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            @if(Auth::user()->user_type == '1' || $permission->games == true)
                                            <th>Action </th>
                                            @endif
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                  
                                      <?php $i=1; ?>
                                       @foreach($games as $game)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $game->game_id }}</td>
                                            <td>{{ $game->game_name }}</td>
                                            <td><img src="{{ asset('images/games/'.$game->game_image) }}" style="width:110px;"></td>
											<td>@if($game->status == '1')
												<span class="text-success">Active</span>
											    @else
											      <span class="text-danger">De-activate</span>
											    @endif
											</td>
											@if(Auth::user()->user_type == '1' || $permission->games == true)
											<td>
                                             <a href="{{ url('admin/games/'.$game->id) }}" class="btn btn-info btn-sm" >View</a>
                                             
                                             <a href="{{ url('admin/games/'.$game->id.'/edit') }}" class="btn btn-warning btn-sm" >Edit</a>
                                             
                                             <a href="{{ url('admin/games/destroy/'.$game->id) }}" onclick="return confirm('Do you want to Delete Game, All battle of this game is also will deleted ?');" class="btn btn-danger btn-sm" >Delete</a>
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
