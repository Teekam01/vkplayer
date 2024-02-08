@extends('admin.master')


@section('head')
<title> Admin </title>
@endsection


@section('content')

     <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Admins</h1>
                     @if(session()->has('success'))
							<div class="alert alert-success">
								{{ session()->get('success') }}
							</div>
							@endif
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">ALL Admin <a href="{{ url('admin/employee/create') }}" style="float:right" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Admin</a></h6>
                        </div>
                        <div class="card-body">
                           
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Action </th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                  
                                      <?php $i=1; ?>
                                       @foreach($employees as $employee)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $employee->vplay_id }}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td>{{ $employee->mobile }}</td>
											<td>
                                             <a href="{{ url('admin/employees/'.$employee->id) }}" class="btn btn-info btn-sm" >View</a>
                                             
                                             <a href="{{ url('admin/employees/edit/'.$employee->id) }}" class="btn btn-warning btn-sm" >Edit</a>
                                             
                                             <a href="{{ url('admin/employees/destroy/'.$employee->id) }}" onclick="return confirm('Do you want to Delete Employee ?');" class="btn btn-danger btn-sm" >Delete</a>
                                             </td>
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
