@extends('admin.admin_dashboard')
@section('content')

{{-- custom bootstrap for 5 cards. LOL --}}
{{-- <style>
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
</style> --}}
    	<div class="page-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">

          <h3 class="mb-3">Overview</h3>

          <div class="d-flex align-items-center flex-wrap text-nowrap">
            <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
              <i class="btn-icon-prepend" data-feather="printer"></i>
              Print
            </button>
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
              <i class="btn-icon-prepend" data-feather="download-cloud"></i>
              Download Report
            </button>
          </div>
        </div>

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


        <!-- row -->
        <div class="row">
          <h5 class="mb-2 mt-5">Monitoring</h5>
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
@endsection
