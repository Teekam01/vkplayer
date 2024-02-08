@extends('admin.master')


@section('head')
<title> Marquee Notification </title>
@endsection


@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"> Marquee Notification  View </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Marquee Notification  View</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<h5>Marquee Notification Editable Details</h5>
							  @if(session()->has('success'))
							<div class="alert alert-success">
								{{ session()->get('success') }}
							</div>
							@endif
							<form method="post" action="{{ url('admin/marquee-save') }}">
							@csrf
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<tbody>
									<tr>
										<th>Marquee Notification Text</th>
										<td><textarea class="form-control" name="text" required>{{ $marquee->marquee_text }}</textarea></td>
									</tr>
									<tr>
										<th>Status</th>
										<td>
											<select name="status" id="" class="form-control">
												<option @if($marquee->status == '1') selected  @endif value="1">Show on Website</option>
												<option @if($marquee->status == '0') selected @endif value="0" >Hide From Homepage</option>
											</select>
										</td>
									</tr>
									<tr>
										<th></th>
										<td>
											<input type="submit" class="btn btn-primary" Value="Update Marquee Notification ">
										</td>
									</tr>
									
								</tbody>
							</table>
							</form>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

@endsection
