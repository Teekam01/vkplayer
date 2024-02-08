@extends('admin.master')


@section('head')
<title> Recharge User </title>
@endsection


@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800"><a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back</a> Recharge Money to User Wallet  </h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Recharge Money</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
						    @if(Auth::user()->user_type == '1' || $permission->recharge_to_user == true)
							<h5>Search User</h5>
							<form action="{{ url('admin/search-user-result') }}" method="post">
							@csrf
							 <input type="text" class="form-control" name="keyword" placeholder="Name, User Id, Mobile, Email ..." required>
								<button type="submit"><i class="fa fa-search" aria-hidden="true"></i> Search User...</button>
							</form>
							@else
							    <p>you don't have any permission</p>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

@endsection
