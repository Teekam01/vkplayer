@extends('admin.master')


@section('head')
@if(isset($employee)) <title>Edit Employee</title> @else <title>Add Employee</title> @endif
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"> @if(isset($employee)) Edit @else Add @endif Employee</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Employee @if(isset($employee)) EDIT @else CREATE @endif</h6>
		</div>
		<div class="card-body">

			@if(count($errors) > 0)
			<div>
				<ul class="text text-danger">
					@foreach($errors->all() as $error)
					{{ $error }}
					@endforeach
				</ul>
			</div>
			@endif
			@if(isset($employee))

			<form action="{{ url('admin/employee/update/'.$employee->id) }}" method="post" enctype="multipart/form-data">
				@else
				<form action="{{ url('admin/employee/save') }}" method="post" enctype="multipart/form-data">
					@endif

					@csrf

					<div class="com-md-12">
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="staticEmail" name="name" @if(isset($employee)) value="{{ $employee->name }}" @else placeholder="Enter Full name of Employee" @endif required>
							</div>
						</div>
					</div>


					<div class="com-md-12">
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="staticEmail" name="email" @if(isset($employee)) value="{{ $employee->email }}" @else placeholder="Enter valid email address" @endif required>
							</div>
						</div>
					</div>

					<div class="com-md-12">
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-2 col-form-label">Mobile</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" id="staticEmail" name="mobile" @if(isset($employee)) value="{{ $employee->mobile }}" @else placeholder="Enter mobile number" @endif required>
							</div>
						</div>
					</div>



					<div class="com-md-12">
						<div class="form-group row">
							<label for="staticEmail" class="col-sm-2 col-form-label"></label>
							<div class="col-sm-10">
								@if(isset($employee))
								<input type="submit" value="Update" class="btn btn-primary">
								@else
								<input type="submit" value="Submit" class="btn btn-primary">
								@endif

								<a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
							</div>
						</div>
					</div>


				</form>
			</form>
		</div>
	</div>

</div>
<!-- /.container-fluid -->


@endsection
