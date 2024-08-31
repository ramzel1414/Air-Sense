<div class="col-md-6 col-sm-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-2 d-flex justify-content-between w-100">
            <h5 class="d-flex align-items-center">PM10</h5>
            <div class="btns">

              {{-- <button id="expPM10" class="btn btn-outline-secondary btn-icon-text me-2 mb-2 mb-md-0">Download CSV</button> --}}
              <div class="btn-group">

                <div id="processing-pm10" class="css-processing" class="css-processing"><span>P</span><span>r</span><span>o</span><span>c</span><span>e</span><span>s</span><span>s</span><span>i</span><span>n</span><span>g</span><span>.</span><span>.</span><span>.</span></div>
                <button id="download-csv-pm10" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true"    aria-expanded="false">Download CSV</button>
                <div class="dropdown-menu">
                  <a class="dropdown-item pointer" id="expPM10">Hourly</a>
                  <a class="dropdown-item pointer" id="expPM10Daily">Daily</a>
                  <a class="dropdown-item pointer" id="expPM10Monthly">Monthly</a>
                </div>
              </div>

            </div>
          </div>
        <div id="pm10" class="mt-md-3 mt-xl-0 order-last"></div>
      </div>
    </div>
  </div>
</div>
