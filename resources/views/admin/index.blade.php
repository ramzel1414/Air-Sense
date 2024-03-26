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


        <!-- row -->
        <div class="row">
          <h5 class="mb-2">Monitoring</h5>
          <div class="col-12 col-xl-12 stretch-card ">
            <div class="row flex-grow-1" >
    
              @include('charts.monitoring.pm25')
    
              @include('charts.monitoring.pm10')
    
              @include('charts.monitoring.co')
    
              @include('charts.monitoring.no2')
    
              @include('charts.monitoring.o2')
    
              @include('charts.monitoring.avg')
    
            </div>
          </div>
        </div> 


        <!-- row -->
        @include('charts.forecasting')



	</div>
@endsection