@extends('admin.admin_dashboard')
@section('content')

{{-- custom bootstrap for 5 cards. LOL --}}
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
    	<div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

          <h3 class="mb-3">Overview</h3>

          <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('pdf.download') }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
              Report
            </a>
          </div>
        </div>

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
                        <p style="font-style:italic; font-size: 80%">
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
                        <p style="font-style:italic; font-size: 80%">
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
                        <p style="font-style:italic; font-size: 80%">
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
                        <p style="font-style:italic; font-size: 80%">
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
                        <p style="font-style:italic; font-size: 80%">
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



	</div>
@endsection
