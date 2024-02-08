@extends('admin.master')


@section('head')
<title>Permissions</title>
<style>
	.col-md-6 {
		border: 1px solid grey;
		padding: 5px
	}

	.col-md-4 {
		border: 1px solid grey;
		padding: 5px
	}

</style>
@endsection


@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">Allow Permission for employee</h1>
	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Choose option for employees</h6>
		</div>
		<div class="card-body">
			<form action="{{ url('admin/permission/update/'.$permission->id) }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="row">

					<!--Players options-->
					<div class="col-md-4">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Players</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="players" id="playersYes" value="1" @if($permission->players == 1) checked @endif>
									<label class="form-check-label" for="playersYes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="players" id="playersNo"  value="0" @if($permission->players == 0) checked @endif >
									<label class="form-check-label" for="playersNo">
										No
									</label>
								</div>
							</div>

							<div class="col-12" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold  text-info">All Players</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="all_players" id="allplayersyES" value="1"  @if($permission->all_players == 1) checked @endif>
									<label class="form-check-label" for="allplayersyES">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="all_players" id="allplayersNo"  value="0"  @if($permission->all_players == 0) checked @endif>
									<label class="form-check-label" for="allplayersNo">
										No
									</label>
								</div>
							</div>
							<div class="col-12" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold text-info">Blocked Players</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="blocked_players" value="1"  id="blockedPlayersYes" @if($permission->block_players == 1) checked @endif>
									<label class="form-check-label" for="blockedPlayersYes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="blocked_players"  value="0"  id="blockedPlayersNo" @if($permission->block_players == 0) checked @endif>
									<label class="form-check-label" for="blockedPlayersNo">
										No
									</label>
								</div>
							</div>
						</div>

					</div>




					<!--KYC options-->
					<div class="col-md-4">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">KYC</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="kyc" id="kycYes" value="1"  @if($permission->kyc == 1) checked @endif>
									<label class="form-check-label" for="kycYes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="kyc" id="kycNo"   value="0" @if($permission->kyc == 0) checked @endif>
									<label class="form-check-label" for="kycNo">
										No
									</label>
								</div>
							</div>

							<div class="col-12" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold  text-info">Pending KYC</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="pending_kyc" id="pendingKYCYes" value="1"  @if($permission->pending_kyc == 1) checked @endif>
									<label class="form-check-label" for="pendingKYCYes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="pending_kyc" id="pendingKYCNo"  value="0"  @if($permission->pending_kyc == 0) checked @endif>
									<label class="form-check-label" for="pendingKYCNo">
										No
									</label>
								</div>
							</div>

							<div class="col-12" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold  text-info">Approved KYC</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="approved_kyc" id="approved_kyc_Yes" value="1"  @if($permission->approved_kyc == 1) checked @endif>
									<label class="form-check-label" for="approved_kyc_Yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="approved_kyc" id="approved_kyc_no"  value="0"  @if($permission->approved_kyc == 0) checked @endif>
									<label class="form-check-label" for="approved_kyc_no">
										No
									</label>
								</div>
							</div>



						</div>

					</div>


					<!--Employee management options-->
					<div class="col-md-4">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Employee Management</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="employee_management" value="1"  id="emp_mang_yes" @if($permission->employees_management == 1) checked @endif>
									<label class="form-check-label" for="emp_mang_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="employee_management"  value="0"  id="emp_mang_no" @if($permission->employees_management == 0) checked @endif>
									<label class="form-check-label" for="emp_mang_no">
										No
									</label>
								</div>
							</div>

							<div class="col-12" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold  text-info">Employees</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="employees" id="employees_yes" value="1"  @if($permission->employees == 1) checked @endif>
									<label class="form-check-label" for="employees_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="employees" id="employees_no"  value="0"  @if($permission->employees == 0) checked @endif>
									<label class="form-check-label" for="employees_no">
										No
									</label>
								</div>
							</div>
							
							<div class="col-12" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold text-info">Permission</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="permission" id="permission_yes" value="1"  @if($permission->permission == 1) checked @endif>
									<label class="form-check-label" for="permission_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="permission" id="permission_no"  value="0"  @if($permission->permission == 0) checked @endif>
									<label class="form-check-label" for="permission_no">
										No
									</label>
								</div>
							</div>
						</div>

					</div>



					<!--Battle options-->
					<div class="col-md-6">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Battle</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="battle" id="battle_yes" value="1"  @if($permission->battle == 1) checked @endif>
									<label class="form-check-label" for="battle_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="battle" id="battle_no"  value="0"  @if($permission->battle == 0) checked @endif>
									<label class="form-check-label" for="battle_no">
										No
									</label>
								</div>
							</div>

							<div class="col-sm-4" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold  text-info">New Battle</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="new_battle" id="new_battle_yes" value="1"  @if($permission->new_battle == 1) checked @endif>
									<label class="form-check-label" for="new_battle_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="new_battle" id="new_battle_no"  value="0"  @if($permission->new_battle == 0) checked @endif>
									<label class="form-check-label" for="new_battle_no">
										No
									</label>
								</div>
							</div>
							<div class="col-sm-4" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold text-info">Running Battle</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="running_battle" id="running_battle_yes" value="1"  @if($permission->battle_running == 1) checked @endif>
									<label class="form-check-label" for="running_battle_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="running_battle" id="running_battle_no"  value="0"  @if($permission->battle_running == 0) checked @endif>
									<label class="form-check-label" for="running_battle_no">
										No
									</label>
								</div>
							</div>

							<div class="col-sm-4" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold text-info">Battle Result</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="battle_result" id="battle_result_yes" value="1"  @if($permission->battle_result == 1) checked @endif>
									<label class="form-check-label" for="battle_result_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="battle_result" id="battle_result_no"  value="0"  @if($permission->battle_result == 0) checked @endif>
									<label class="form-check-label" for="battle_result_no">
										No
									</label>
								</div>
							</div>

						</div>

					</div>


					<!--PAYMENTS options-->
					<div class="col-md-6">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Payments</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="payments" id="payments_yes" value="1"  @if($permission->payments == 1) checked @endif>
									<label class="form-check-label" for="payments_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="payments" id="payments_no"  value="0"  @if($permission->payments == 0) checked @endif>
									<label class="form-check-label" for="payments_no">
										No
									</label>
								</div>
							</div>

							<div class="col-sm-4" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold  text-info">Payment Received</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="payment_received" value="1"  id="payment_received_yes" @if($permission->payment_received == 1) checked @endif>
									<label class="form-check-label" for="payment_received_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="payment_received"  value="0"  id="payment_received_no" @if($permission->payment_received == 0) checked @endif>
									<label class="form-check-label" for="payment_received_no">
										No
									</label>
								</div>
							</div>

							<div class="col-sm-4" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold  text-info">Recharge To User</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="recharge_to_user"  value="1"   id="recharge_to_user_yes" @if($permission->recharge_to_user == 1) checked @endif>
									<label class="form-check-label" for="recharge_to_user_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="recharge_to_user"  value="0"  id="recharge_to_user_no" @if($permission->recharge_to_user == 0) checked @endif>
									<label class="form-check-label" for="recharge_to_user_no">
										No
									</label>
								</div>
							</div>


							<div class="col-sm-4" style="1px solid black">
								<label for="staticEmail" class="col-sm-12 col-form-label font-weight-bold  text-info">Payment Settings</label>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="payment_settings"  value="1"  id="payment_settings_yes" @if($permission->payment_settings == 1) checked @endif>
									<label class="form-check-label" for="payment_settings_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="payment_settings"  value="0"  id="payment_settings_no" @if($permission->payment_settings == 0) checked @endif>
									<label class="form-check-label" for="payment_settings_no">
										No
									</label>
								</div>
							</div>

						</div>

					</div>

					<!--Withdrawal request options-->
					<div class="col-md-4">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Withdrawal Request</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="withdrawal_requests" id="withdrawal_requests_yes"   value="1" @if($permission->withdraw_request == 1) checked @endif>
									<label class="form-check-label" for="withdrawal_requests_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="withdrawal_requests"  value="0"  id="withdrawal_requests_no" @if($permission->withdraw_request == 0) checked @endif>
									<label class="form-check-label" for="withdrawal_requests_no">
										No
									</label>
								</div>
							</div>
						</div>
					</div>


					<!--Withdrawal request options-->
					<div class="col-md-4">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Admin Settings</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="admin_settings" id="admin_settings_yes"  value="1"  @if($permission->admin_settings == 1) checked @endif>
									<label class="form-check-label" for="admin_settings_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="admin_settings" id="admin_settings_no"  value="0"  @if($permission->admin_settings == 0) checked @endif>
									<label class="form-check-label" for="admin_settings_no">
										No
									</label>
								</div>
							</div>
						</div>
					</div>

					<!--Withdrawal request options-->
					<div class="col-md-4">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Games</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="games" id="games_yes"   value="1"  @if($permission->games == 1) checked @endif>
									<label class="form-check-label" for="games_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="games" id="games_no"  value="0"  @if($permission->games == 0) checked @endif>
									<label class="form-check-label" for="games_no">
										No
									</label>
								</div>
							</div>
						</div>
					</div>

					<!--Withdrawal request options-->
					<div class="col-md-4">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Marquee Notification</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="marquee_notification" id="marquee_notification_yes"   value="1" @if($permission->marquee_notification == 1) checked @endif>
									<label class="form-check-label" for="marquee_notification_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="marquee_notification"  value="0"  id="marquee_notification_no" @if($permission->marquee_notification == 0) checked @endif>
									<label class="form-check-label" for="marquee_notification_no">
										No
									</label>
								</div>
							</div>
						</div>
					</div>


					<!--Withdrawal request options-->
					<div class="col-md-4">
						<div class="form-group row">
							<label for="staticEmail" class="col-12 col-form-label font-weight-bold text-primary">Support</label>
							<div class="col-12">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="support"  value="1"  id="support_yes" @if($permission->support == 1) checked @endif>
									<label class="form-check-label" for="support_yes">
										Yes
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio"  value="0"  name="support" id="support_no" @if($permission->support == 0) checked @endif>
									<label class="form-check-label" for="support_no">
										No
									</label>
								</div>
							</div>
						</div>
					</div>


				</div>
				<br><input type="submit" value="Save Permissions " class="btn btn-lg btn-primary">

			</form>


		</div>
	</div>

</div>
<!-- /.container-fluid -->


@endsection
