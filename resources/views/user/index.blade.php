@extends('user.user_dashboard')
@section('user')

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

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card ">
            <div class="row flex-grow-1" >

              <div class="col-md-15 col-sm-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">

                    <div class="row">
                      <div class="d-flex justify-content-between w-100">
                        <h6 class="d-flex align-items-center">PM2.5</h6>
                        <p class="text-success">
                          <span>+2.8%</span>
                          <i data-feather="arrow-up" class="icon-sm"></i>
                        </p>
                      </div>
                        <div id="ordersChart1" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    
                  </div>
                </div>
              </div>

              <div class="col-md-15 col-sm-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                    </div>
                    <div class="row">
                      <div class="d-flex align-items-baseline justify-content-between">
                        <h6 class="d-flex align-items-center">PM2.10</h6>
                        <p class="text-success">
                          <span>+2.8%</span>
                          <i data-feather="arrow-up" class="icon-sm"></i>
                        </p>
                      </div>
                        <div id="ordersChart2" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    
                  </div>
                </div>
              </div>

              <div class="col-md-15 col-sm-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                    </div>
                    <div class="row">
                      <div class="d-flex align-items-baseline justify-content-between">
                        <h6 class="d-flex align-items-center">CO2</h6>
                        <p class="text-danger">
                          <span>-2.8%</span>
                          <i data-feather="arrow-down" class="icon-sm"></i>
                        </p>
                      </div>
                        <div id="ordersChart3" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    
                  </div>
                </div>
              </div>

              <div class="col-md-15 col-sm-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                    </div>
                    <div class="row">
                      <div class="d-flex align-items-baseline justify-content-between">
                        <h6 class="d-flex align-items-center">NO2</h6>
                        <p class="text-success">
                          <span>+2.8%</span>
                          <i data-feather="arrow-up" class="icon-sm"></i>
                        </p>
                      </div>
                        <div id="ordersChart4" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    
                  </div>
                </div>
              </div>

              <div class="col-md-15 col-sm-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                    </div>
                    <div class="row">
                      <div class="d-flex align-items-baseline justify-content-between">
                        <h6 class="d-flex align-items-center">O2</h6>
                        <p class="text-success">
                          <span>+2.8%</span>
                          <i data-feather="arrow-up" class="icon-sm"></i>
                        </p>
                      </div>
                        <div id="ordersChart5" class="mt-md-3 mt-xl-0"></div>
                    </div>
                    
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> 
        <!-- row -->

        <!-- row -->

        <h5 class="mb-2">Forecasting</h5>
        <!-- row -->
        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-0">PM2.5</h5>

                <div class="row align-items-start">
                  <div class="col-md-7">
                    <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its normal business activities, usually from the sale of goods and services to customers.</p>
                  </div>
                  <div class="col-md-5 d-flex justify-content-md-end">
                    <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-primary">PM2.5</button>
                      <button type="button" class="btn btn-outline-primary mx-2">PM10</button>
                    </div>
                  </div>
                </div>
                <div class="flot-chart-wrapper">
                  <div class="flot-chart" id="flotRealTime"></div>
                </div>
              </div>
            </div>
          </div>
        </div>



	</div>
@endsection