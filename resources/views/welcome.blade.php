<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>AirSense - Dashboard</title>

      <!-- Change the href attribute to the path of your icon file -->
      <link rel="icon" href="{{ asset('airsense.png') }}" type="image/png">

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
      <link rel="stylesheet" href="{{ asset('../assets/css/demo1/style.css') }}">
      <!-- End layout styles -->

      {{-- toaster for update notif --}}
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

  </head>

<body class="user-body">



  @include('layouts.header');

    <div class="page-content mx-4">

    <h3 class="mb-2">AirSense</h3>

        {{-- Tab --}}
        <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist" style="width: max-content; border-radius: 1rem;">
          <li class="nav-item">
            <a class="nav-link active" id="pm25-line-tab" data-bs-toggle="tab" href="#pm25tab" role="tab" aria-controls="pm25tab" aria-selected="true">PM2.5</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pm10-line-tab" data-bs-toggle="tab" href="#pm10tab" role="tab" aria-controls="pm10tab" aria-selected="false">PM10</a>
          </li>
        </ul>
        
        {{-- Tab Content --}}
        <div class="tab-content mt-3" id="lineTabContent">
          {{-- PM2.5 --}}
          @include('charts.forecastingpm25')
          {{-- PM10 --}}
          @include('charts.forecastingpm10')
        </div>




    <div class="row">
      <h5 class="mt-4 mb-2">Monitoring</h5>
      <div class="col-12 col-xl-12 stretch-card ">
        <div class="row flex-grow-1" >

          @include('charts.monitoring.pm25')

          @include('charts.monitoring.pm10')

          @include('charts.monitoring.co')

          @include('charts.monitoring.no2')

          @include('charts.monitoring.o3')


        </div>
      </div>
    </div>
  </div>

  @include('layouts.footer');


	<!-- core:js -->
	<script src="{{ asset('../assets/vendors/core/core.js')}}"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="{{ asset('../assets/vendors/flatpickr/flatpickr.min.js')}}"></script>
  <script src="{{ asset('../assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('../assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
  <script src="{{ asset('../assets/js/jquery.flot-dark.js')}}"></script>
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="{{ asset('../assets/vendors/feather-icons/feather.min.js')}}"></script>
	<script src="{{ asset('../assets/js/template.js')}}"></script>
	<!-- endinject -->

        {{-- PM2.5 Chart--}}
  	<script src="{{ asset('../assets/pm25.js')}}"></script>
    {{-- PM10 Chart--}}
  	<script src="{{ asset('../assets/pm10.js')}}"></script>
    {{-- CO Chart--}}
  	<script src="{{ asset('../assets/co.js')}}"></script>
    {{-- NO2 Chart--}}
  	<script src="{{ asset('../assets/no2.js')}}"></script>
    {{-- O3 Chart--}}
  	<script src="{{ asset('../assets/o3.js')}}"></script>

    {{-- PM2.5 Forecasting Chart--}}
  	<script src="{{ asset('../assets/pm25f.js')}}"></script>

    {{-- PM10 Forecasting Chart--}}
  	<script src="{{ asset('../assets/pm10f.js')}}"></script>

    

    </body>
</html>
