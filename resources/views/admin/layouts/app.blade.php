<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Houserenovation</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/admin/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/admin/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/admin/assets/css/core.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/admin/assets/css/components.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('assets/admin/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
	<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"> -->

	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/loaders/pace.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/core/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/core/libraries/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/visualization/d3/d3.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/visualization/d3/d3_tooltip.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/forms/styling/switchery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/forms/selects/bootstrap_multiselect.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/ui/moment/moment.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/pickers/daterangepicker.js')}}"></script>

	<script type="text/javascript" src="{{asset('assets/admin/assets/js/core/app.js')}}"></script>
	<script type="text/javascript" src="{{asset('assets/admin/assets/js/pages/dashboard.js')}}"></script>

	<script type="text/javascript" src="{{asset('assets/admin/assets/js/plugins/ui/ripple.min.js')}}"></script>
	<!-- /theme JS files -->

</head>

<body>
	<div id="app">
		<!-- Main navbar -->
		@include('admin.layouts.header')
		<!-- /main navbar -->


		<!-- Page container -->
		<div class="page-container">

			<!-- Page content -->
			<div class="page-content">

				<!-- Main sidebar -->
				@include('admin.layouts.sidebar')
				<!-- /main sidebar -->


				<!-- Main content -->
				<div class="content-wrapper">

					<!-- Page header -->
					<div class="page-header page-header-default">
						<!-- <div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
						</div>

						<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
								<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
							</div>
						</div>
					</div> -->

						<div class="breadcrumb-line">
							<ul class="breadcrumb">
								<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
								<li class="active">Dashboard</li>
							</ul>

							<ul class="breadcrumb-elements">
								<!-- <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li> -->
								<!-- <li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-gear position-left"></i>
										Settings
										<span class="caret"></span>
									</a>

									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
										<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
										<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
										<li class="divider"></li>
										<li><a href="#"><i class="icon-gear"></i> All settings</a></li>
									</ul>
								</li> -->
							</ul>
						</div>
					</div>
					<!-- /page header -->


					<!-- Content area -->
					<div class="content">

						@yield('content')


						<!-- Footer -->
						<div class="footer text-muted">
							&copy; 2022. <a href="#">Houserenovation Company</a>
						</div>
						<!-- /footer -->

					</div>
					<!-- /content area -->

				</div>
				<!-- /main content -->

			</div>
			<!-- /page content -->

		</div>
		<!-- /page container -->
	</div>
	<script src="{{mix('/js/app.js')}}"></script>
	@yield('scripts')
</body>

</html>