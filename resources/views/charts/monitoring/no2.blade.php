<div class="col-md-6 col-sm-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
        <h5 class="d-flex align-items-center">Bukidnon State University</h5>
          <div class="col-2 d-flex justify-content-between w-100">
            <h6 class="d-flex align-items-center">NO2</h6>
            <div class="btns">

              @auth
              <a href="{{route('admin.location')}}" class="btn btn-outline-secondary btn-icon-text me-2 mb-2 mb-md-0">View Location</a>
              @else
              <a href="{{route('location')}}" class="btn btn-outline-secondary btn-icon-text me-2 mb-2 mb-md-0">View Location</a>
              @endauth

              <button id="expNO2" class="btn btn-outline-secondary btn-icon-text me-2 mb-2 mb-md-0">Download CSV</button>
            </div>
          </div>
        <div id="no2" class="mt-md-3 mt-xl-0 order-last"></div>
      </div>
    </div>
  </div>
</div>
