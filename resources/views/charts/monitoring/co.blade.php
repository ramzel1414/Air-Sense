<div class="col-md-6 col-sm-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-2 d-flex justify-content-between w-100">
            <h5 class="d-flex align-items-center">CO</h5>
            <div class="btns">

              {{-- <button id="expCO" class="btn btn-outline-secondary btn-icon-text me-2 mb-2 mb-md-0">Download CSV</button> --}}
              <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Download CSV</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" id="expCO">Hourly</a>
                  <a class="dropdown-item" id="expCODaily">Daily</a>
                  <a class="dropdown-item" id="expCOMonthly">Monthly</a>
                </div>
              </div>

            </div>
          </div>
          <div id="co" class="mt-md-3 mt-xl-0 order-last"></div>
        </div>
      </div>
    </div>
  </div>
