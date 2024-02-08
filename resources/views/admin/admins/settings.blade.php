@extends('admin.master')


@section('head')
<title> Dashboard</title>
@endsection


@section('content')


<!-- Begin Page Content -->
@if(Auth::user()->user_type == '1' || $permission->admin_settings == true)
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Owner Settings</h1>
	</div>


	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Set Owner Commission and Credentials</h6>
		</div>
		 @if(session()->has('success'))
							<div class="alert alert-success">
								{{ session()->get('success') }}
							</div>
							@endif
		<div class="card-body">
			<form action="{{ url('admin/update-comission/'.$comission->id) }}" method="post">
			@csrf
				<h6 class="text-primary"><u>Comission Settings</u></h6>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Battle Comission (With Refferal)</label>
					<div class="col-sm-10">
						<input type="number" name="battle_comission_with_referral" required class="form-control" id="staticEmail" value="{{ $comission->battle_comission_with_referral }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Refferal Comission</label>
					<div class="col-sm-10">
						<input type="number" name="refferal_comission" required class="form-control" id="staticEmail" value="{{ $comission->refferal_comission }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Battle Comission (Without Refferal)</label>
					<div class="col-sm-10">
						<input type="number" name="battle_comission_without_referral" required class="form-control" id="staticEmail" value="{{ $comission->battle_comission_without_referral }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<input type="submit" name="submit"  class="btn btn-info" value="Update Now">
					</div>
				</div>
			</form>
		</div>
	</div>
	
	
	
	
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Owner Details View &amp; Update</h6>
		</div>
		 @if(session()->has('success'))
							<div class="alert alert-success">
								{{ session()->get('success') }}
							</div>
							@endif
		<div class="card-body">
			<form action="{{ url('admin/update-profile/') }}" method="post">
			@csrf
				
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">ID</label>
					<div class="col-sm-10">
						<input type="text" name="id" required class="form-control"  value="{{ $profile->vplay_id }}" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Full Name</label>
					<div class="col-sm-10">
						<input type="text" name="name" required class="form-control" value="{{ $profile->name }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" name="email" required class="form-control" value="{{ $profile->email }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Mobile No.</label>
					<div class="col-sm-10">
						<input type="number" min="1" name="mobile" required class="form-control" value="{{ $profile->mobile }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<input type="submit" name="submit"  class="btn btn-info" value="Update Now">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--//ADMIN SOCIAL MEDIAL SETTING-->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Social Medial Link &amp; Update</h6>
		</div>
		 @if(session()->has('successSocial'))
    		<div class="alert alert-success">
    			{{ session()->get('successSocial') }}
    		</div>
		@endif
		<div class="card-body">
			<form action="{{ url('admin/update-sociallinks/') }}" method="post">
			@csrf
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Instagram</label>
					<div class="col-sm-10">
						<input type="text" name="instagram" class="form-control"  value="{{ $adminContactDetails->instagram }}" required>
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Telegram</label>
					<div class="col-sm-10">
						<input type="text" name="telegram" class="form-control" value="{{ $adminContactDetails->telegram }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="email" name="email" class="form-control" value="{{ $adminContactDetails->email }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Whats App Number</label>
					<div class="col-sm-10">
						<input type="number" min="1" name="whatsapp_number" class="form-control" value="{{ $adminContactDetails->whatsapp_number }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Youtube Link</label>
					<div class="col-sm-10">
						<input type="text" name="youtube_link" class="form-control" value="{{ $adminContactDetails->youtube_link }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Calling Number</label>
					<div class="col-sm-10">
						<input type="number" min="1" name="calling_number" class="form-control" value="{{ $adminContactDetails->calling_number }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Support</label>
					<div class="col-sm-10">
						<input type="text" name="support" class="form-control" value="{{ $adminContactDetails->support }}">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label">Game Play Notice</label>
					<div class="col-sm-10">
						<input type="text" name="home_page_notice" class="form-control" value="{{ $adminContactDetails->home_page_notice }}">
					</div>
				</div>
				<div class="form-group row">
					<label for="staticEmail" class="col-sm-2 col-form-label"></label>
					<div class="col-sm-10">
						<input type="submit" name="submit"  class="btn btn-info" value="Update Now">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@else
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
	    	<h1 class="h3 mb-0 text-gray-800">Owner Settings</h1>
    	</div>
        <div class="card shadow ">
            <div class="card-body">
                <p>You don't have any permission</p>
            </div>
        </div>
    </div>
@endif
<!-- /.container-fluid -->



@endsection
