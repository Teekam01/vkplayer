
<?php
$all_rules = App\Permission::where('user_type', 3)->first();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	@yield('head')
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="">
	<!-- Custom fonts for this template-->
	<link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
	<!--font awesome  ICONS-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom styles for this page -->
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">
    @if(Auth::user()->user_type == 1)
    	<!-- Owner Dashboard -->
	    <div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #000">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-laugh-wink"></i>
				</div>
				<div class="sidebar-brand-text mx-3">VK Ludo Player Owner <sup></sup></div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="{{url('admin/dashboard')}}">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>



			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePlayers" aria-expanded="true" aria-controls="collapsePlayers">
					<i class="fa-solid fa-user"></i>
					<span>Players</span>
				</a>
				<div id="collapsePlayers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">All Players:</h6>
						<a class="collapse-item" href="{{ url('/admin/players') }}">All Players</a>
						<a class="collapse-item" href="{{ url('/admin/players-blocked') }}">Blocked Players</a>
					</div>
				</div>
			</li>


			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<i class="fa-solid fa-dice"></i>
					<span>Battle</span>
				</a>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">All Battle Show:</h6>
						<a class="collapse-item" href="{{ url('/admin/new-battles') }}">New Battle</a>
						<!-----<a class="collapse-item" href="{{ url('/admin/running-battles') }}">Running Battle</a>---->
						<a class="collapse-item" href="{{ url('/admin/battles-result') }}">Battle Result</a>
					</div>
				</div>
			</li>

			<!-- Nav Item - Pages Collapse Menu -->

				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
						<i class="fa-solid fa-file"></i>
						<span>KYC</span>
					</a>
					<div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">All KYC Show:</h6>
							<a class="collapse-item" href="{{ url('/admin/kyc-pending') }}">Pending KYC</a>
							<a class="collapse-item" href="{{ url('/admin/kyc-approved') }}">Approved KYC</a>
						</div>
					</div>
				</li>


			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayments" aria-expanded="true" aria-controls="collapsePayments">
					<i class="fa-solid fa fa-credit-card-alt"></i>
					<span>Payments</span>
				</a>
				<div id="collapsePayments" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">All Payments:</h6>
						<a class="collapse-item" href="{{ url('/admin/payments') }}">Payment Received</a>
						<a class="collapse-item" href="{{ url('/admin/recharge-user') }}">Recharge&Penalty to User</a>
						<a class="collapse-item" href="{{ url('/admin/payments-settings') }}">Payment Settings</a>
					</div>
				</div>
			</li>

		       <!-- Nav Item - Dashboard -->
			<li class="nav-item">
				<a class="nav-link" href="{{url('admin/withdraw-request')}}">

					<i class="fa-solid fa-inr"></i>

					<span>Withdraw Request</span></a>
			</li>

		    <!-- Nav Item - Dashboard -->
			<!-----<li class="nav-item">
				<a class="nav-link" href="{{url('admin/admin-settings')}}">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Admin Settings</span></a>
			</li>---->



		    <!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ url('admin/games') }}">
					<i class="fa-solid fa-gamepad"></i>
					<span>Games</span></a>
			</li>


			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ url('admin/marquee-notification') }}">
					<i class="fa-solid fa-bell"></i>
					<span>Marquee Notification</span></a>
			</li>
            @if(Auth::user()->user_type == '1')
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapsePayments">
					<i class="fa-solid fa-dice"></i>
					<span>Admin Management</span>
				</a>
				<div id="collapseEmployee" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Employees options:</h6>
						<a class="collapse-item" href="{{ url('/admin/employees') }}">All Admins</a>
						<a class="collapse-item" href="{{ url('admin/permission-employee') }}">Permissions </a>
					</div>
				</div>
			</li>

		    <li class="nav-item">
				<a class="nav-link" href="{{ url('admin/permission-employee') }}">
					<i class="fa-solid fa-user"></i>
					<span>Permisions for Employee</span></a>
			</li>
			@endif


			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ url('admin/livechat') }}">
					<i class="fa-solid fa-comment"></i>
					<span>Live Chat</span></a>
			</li>

			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
					<i class="fa fa-sign-out"></i>
					<span>LogOut</span></a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>




		</ul>
		<!-- End of Sidebar -->



		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>


					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!--<div class="topbar-divider d-none d-sm-block"></div>-->

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}} </span>
								<img class="img-profile rounded-circle" src="{{asset('backend/img/undraw_profile.svg')}}">
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>

								<a class="dropdown-item" href="{{ url('/admin/admin-settings') }}">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Settings
								</a>
    								<a class="dropdown-item" href="{{ url('admin/deleteAllData') }}" onclick="return confirm('Do you want to delete all data for set new gaming plateform ?')">
    									<i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
    									Delete All Data
    								</a>
    								<a class="dropdown-item" href="{{ url('admin/deleteAllScreenshots') }}" onclick="return confirm('Do you want to delete all screenshots of battles ?')">
    									<i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
    									Delete All Screenshots
    								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"> <!--data-toggle="modal" data-target="#logoutModal"-->
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->



				@yield('content')



			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; vkludopalyer.com</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->




	</div>

	@elseif(Auth::user()->user_type == 3)
	    <!-- Owner Dashboard -->
	    <div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-laugh-wink"></i>
				</div>
				<div class="sidebar-brand-text mx-3">ADMIN <sup></sup></div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="{{url('admin/dashboard')}}">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>



			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePlayers" aria-expanded="true" aria-controls="collapsePlayers">
					<i class="fa-solid fa-user"></i>
					<span>Players</span>
				</a>
				<div id="collapsePlayers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">All Players:</h6>
						<a class="collapse-item" href="{{ url('/admin/players') }}">All Players</a>
						<a class="collapse-item" href="{{ url('/admin/players-blocked') }}">Blocked Players</a>
					</div>
				</div>
			</li>


			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
					<i class="fa-solid fa-dice"></i>
					<span>Battle</span>
				</a>
				<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">All Battle Show:</h6>
						<a class="collapse-item" href="{{ url('/admin/new-battles') }}">New Battle</a>
						<!-----<a class="collapse-item" href="{{ url('/admin/running-battles') }}">Running Battle</a>---->
						<a class="collapse-item" href="{{ url('/admin/battles-result') }}">Battle Result</a>
					</div>
				</div>
			</li>

			<!-- Nav Item - Pages Collapse Menu -->

				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
						<i class="fa-solid fa-file"></i>
						<span>KYC</span>
					</a>
					<div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<h6 class="collapse-header">All KYC Show:</h6>
							<a class="collapse-item" href="{{ url('/admin/kyc-pending') }}">Pending KYC</a>
							<a class="collapse-item" href="{{ url('/admin/kyc-approved') }}">Approved KYC</a>
						</div>
					</div>
				</li>


			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePayments" aria-expanded="true" aria-controls="collapsePayments">
					<i class="fa-solid fa fa-credit-card-alt"></i>
					<span>Payments</span>
				</a>
				<div id="collapsePayments" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">All Payments:</h6>
						<a class="collapse-item" href="{{ url('/admin/payments') }}">Payment Received</a>
						<a class="collapse-item" href="{{ url('/admin/recharge-user') }}">Recharge&Penalty to User</a>
						<a class="collapse-item" href="{{ url('/admin/payments-settings') }}">Payment Settings</a>
					</div>
				</div>
			</li>

		       <!-- Nav Item - Dashboard -->
			<li class="nav-item">
				<a class="nav-link" href="{{url('admin/withdraw-request')}}">

					<i class="fa-solid fa-inr"></i>

					<span>Withdraw Request</span></a>
			</li>

		    <!-- Nav Item - Dashboard -->
			<!-----<li class="nav-item">
				<a class="nav-link" href="{{url('admin/admin-settings')}}">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Admin Settings</span></a>
			</li>---->



		    <!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ url('admin/games') }}">
					<i class="fa-solid fa-gamepad"></i>
					<span>Games</span></a>
			</li>


			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ url('admin/marquee-notification') }}">
					<i class="fa-solid fa-bell"></i>
					<span>Marquee Notification</span></a>
			</li>



			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ url('admin/livechat') }}">
					<i class="fa-solid fa-comment"></i>
					<span>Live Chat</span></a>
			</li>

			<!-- Nav Item - Charts -->
			<li class="nav-item">
				<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
					<i class="fa fa-sign-out"></i>
					<span>LogOut</span></a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>




		</ul>
		<!-- End of Sidebar -->



		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>


					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!--<div class="topbar-divider d-none d-sm-block"></div>-->

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}} </span>
								<img class="img-profile rounded-circle" src="{{asset('backend/img/undraw_profile.svg')}}">
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>
								<a class="dropdown-item" href="{{ url('/admin/admin-settings') }}">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Settings
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();"> <!--data-toggle="modal" data-target="#logoutModal"-->
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->



				@yield('content')



			</div>
			<!-- End of Main Content -->

			<!-- Footer -->
			<footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; vkludopalyer.com</span>
					</div>
				</div>
			</footer>
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->




	</div>


	@endif




	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>


				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

	<!-- Core plugin JavaScript-->
	<script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

	<!-- Custom scripts for all pages-->
	<script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

	<!-- Page level plugins -->
	<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

	<!-- Page level custom scripts -->
	<script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script>
	<script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script>

	 <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>

  @include('sweetalert::alert')
</body>

</html>
