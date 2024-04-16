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
      
      {{-- custom bootstrap for 5 cards. --}}
      <style>        
        .col-xs-15,
        .col-sm-15,
        .col-md-15,
        .col-lg-15 {
          position: relative;
          min-height: 1px;
          padding-right: 10px;
          padding-left: 10px;
      }

        .col-xs-15 {
          width: 20%;
          float: left;
      }
      @media (min-width: 768px) {
          .col-sm-15 {
              width: 20%;
              float: left;
          }
      }
      @media (min-width: 992px) {
          .col-md-15 {
              width: 20%;
              float: left;
          }
      }
      @media (min-width: 1200px) {
          .col-lg-15 {
              width: 20%;
              float: left;
          }
      }
      </style>
  </head>

<body class="user-body">
  @include('layouts.header');

    <div class="page-content mx-4">

    <h3 class="mb-2">AirSense</h3>

    {{-- Tabs for Monitoring and Forecasting--}}
    <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="monitoring-line-tab" data-bs-toggle="tab" href="#monitoring" role="tab" aria-controls="monitoring" aria-selected="true">Monitoring</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="forecasting-line-tab" data-bs-toggle="tab" href="#forecasting" role="tab" aria-controls="forecasting" aria-selected="false">Forecasting</a>
      </li>
    </ul>
    {{-- End of Tabs --}}

    {{-- Tab contents --}}
    <div class="tab-content" id="lineTabContent">

      {{-- Start of Monitoring content --}}
      <div class="tab-pane fade show active p-3 for-light-mode-bg" id="monitoring" role="tabpanel" aria-labelledby="monitoring-line-tab">
        <div class="mb-3">
          <h5>REAL-TIME AIR QUALITY MONITORING</h5">
        </div>
        {{-- Cards Container --}}
        <div class="row flex-grow-1">
          {{-- Card 1 --}}
          <div class="col-sm-15 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"  style="border-top: 1rem solid #6571ff;">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">PM2.5</h6>
                </div>
                <div class="row">
                  <div class="col-12 col-md-12 text-center">
                    <h3 class="mb-2">14.14</h3>
                    <p class="text-success mb-2">
                      <span>Good</span>
                    </p>
                    <p style="font-style:italic;">
                      April 15, 2024 - 7:45 PM
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Card 2 --}}
          <div class="col-sm-15 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"  style="border-top: 1rem solid #6571ff;">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">PM10</h6>
                </div>
                <div class="row">
                  <div class="col-12 col-md-12 text-center">
                    <h3 class="mb-2">14.14</h3>
                    <p class="text-success mb-2">
                      <span>Good</span>
                    </p>
                    <p style="font-style:italic;">
                      April 15, 2024 - 7:45 PM
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Card 3 --}}
          <div class="col-sm-15 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"  style="border-top: 1rem solid #6571ff;">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">CO</h6>
                </div>
                <div class="row">
                  <div class="col-12 col-md-12 text-center">
                    <h3 class="mb-2">14.14</h3>
                    <p class="text-danger mb-2">
                      <span>Unhealthy</span>
                    </p>
                    <p style="font-style:italic;">
                      April 15, 2024 - 7:45 PM
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Card 4 --}}
          <div class="col-sm-15 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"  style="border-top: 1rem solid #6571ff;">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">NO2</h6>
                </div>
                <div class="row">
                  <div class="col-12 col-md-12 text-center">
                    <h3 class="mb-2">14.14</h3>
                    <p class="text-warning mb-2">
                      <span>Fair</span>
                    </p>
                    <p style="font-style:italic;">
                      April 15, 2024 - 7:45 PM
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          {{-- Card 5 --}}
          <div class="col-sm-15 grid-margin stretch-card">
            <div class="card">
              <div class="card-body"  style="border-top: 1rem solid #6571ff;">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">O3</h6>
                </div>
                <div class="row">
                  <div class="col-12 col-md-12 text-center">
                    <h3 class="mb-2">14.14</h3>
                    <p class="text-info mb-2">
                      <span>Nice</span>
                    </p>
                    <p style="font-style:italic;">
                      April 15, 2024 - 7:45 PM
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Monitoring Graphs --}}
        <div class="row">
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
      {{-- End of Monitoring content --}}

      {{-- Start of Forecasting content --}}
      <div class="tab-pane fade p-3 for-light-mode-bg" id="forecasting" role="tabpanel" aria-labelledby="forecasting-line-tab">
        <div class="mb-3">
          <h5>AIR QUALITY FORECASTING</h5">
        </div>
          {{-- Forecasting Graphs --}}
          @include('charts.forecastingpm25')
          @include('charts.forecastingpm10')
      </div>
      {{-- End of forecasting content --}}
    </div>

    @include('layouts.footer');

</div>

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
