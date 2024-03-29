<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>AirSense</title>

	{{-- fontawesome --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('../assets/vendors/core/core.css') }}">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<link rel="stylesheet" href="{{ asset('../assets/vendors/flatpickr/flatpickr.min.css') }}">
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('../assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('../assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<!-- endinject -->

	<!-- Layout styles -->
	{{-- <link rel="stylesheet" href="../assets/css/demo2/style.css"> --}}
	<link rel="stylesheet" href="../assets/css/demo1/style.css">
	<!-- End layout styles -->

	<!-- Plugin css for page that has data tables -->
	<link rel="stylesheet" href="../../../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">

	{{-- toaster for update notif --}}
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
		
	<link rel="shortcut icon" href="{{ asset('../assets/images/airsense.png') }}" />
</head>
<body>
	<div class="main-wrapper">
        @include('user.body.header')
        @include('user.body.sidebar')
		<div class="page-wrapper">
            @yield('content')
            @include('user.body.footer')
		</div>
	</div>
	

	<!-- core:js -->
	<script src="{{ asset('../assets/vendors/core/core.js')}}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="{{ asset('../assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
  <script src="{{ asset('../assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('../assets/vendors/jquery.flot/jquery.flot.js')}}"></script>	{{--  NAA DIRI ANG DATA SA FORECASTING GRAPH --}}
<script src="{{ asset('../assets/js/jquery.flot-dark.js')}}"></script>	  				{{--  NAA DIRI ANG DATA SA FORECASTING GRAPH --}}
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('../assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{ asset('../assets/js/template.js')}}"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
  	<script src="{{ asset('../assets/js/dashboard-light.js')}}"></script>			{{-- NAA DIRI NGA JAVASCRIPT ANG DATA SA MGA MONITORING GRAPH --}}
	<!-- End custom js for this page -->

	<!-- Plugin js for pages that has data tables -->
	<script src="../../../assets/vendors/datatables.net/jquery.dataTables.js"></script>
	<script src="../../../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
	<!-- Custom js for pages that has data tables -->
	<script src="../../../assets/js/data-table.js"></script>

{{-- toaster for update notif --}}
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>
{{-- end of toaster for update notif --}}





</body>
</html>    