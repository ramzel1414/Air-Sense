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

.block {
	display: block;
}

</style>
    	<div class="page-content">

        <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <h3 class="">Overview</h3>
        </div>

        <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap grid-margin">
          {{-- Tabs for Monitoring and Forecasting--}}
          <div>
            <ul class="nav nav-tabs nav-tabs-line" id="lineTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="monitoring-line-tab" data-bs-toggle="tab" href="#monitoring" role="tab" aria-controls="monitoring" aria-selected="true">Monitoring</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="forecasting-line-tab" data-bs-toggle="tab" href="#forecasting" role="tab" aria-controls="forecasting" aria-selected="false">Forecasting</a>
              </li>
            </ul>
          </div>

          {{-- 3 toggle buttons --}}
          <div>
            <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Pollutant Description</a>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Pollutant Classification</button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Toggle Both</button>
          </div>

        </div>
        {{-- toggle content --}}
        {{-- move this out to the div up there so that it won't affect the structure (space-between) --}}
        <div class="row mb-3">
          {{-- 1st collapse --}}
          <div class="col">
            <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="d-flex">
                  <div class="col-5 col-md-2 pe-0 grid-margin">
                          <div class="card-body">
                              <div class="nav nav-tabs nav-tabs-vertical" id="v-tab" role="tablist" aria-orientation="vertical">
                                  <a class="nav-link active" id="v-home-tab" data-bs-toggle="pill" href="#v-home" role="tab" aria-controls="v-home" aria-selected="true">PM2.5</a>
                                  <a class="nav-link" id="v-profile-tab" data-bs-toggle="pill" href="#v-profile" role="tab" aria-controls="v-profile" aria-selected="false">PM10</a>
                                  <a class="nav-link" id="v-messages-tab" data-bs-toggle="pill" href="#v-messages" role="tab" aria-controls="v-messages" aria-selected="false">CO</a>
                                  <a class="nav-link" id="v-no2-tab" data-bs-toggle="pill" href="#v-no2" role="tab" aria-controls="v-no2" aria-selected="false">NO2</a>
                                  <a class="nav-link" id="v-settings-tab" data-bs-toggle="pill" href="#v-settings" role="tab" aria-controls="v-settings" aria-selected="false">O3</a>
                              </div>
                          </div>
                  </div>
                  <div class="col-7 col-md-10 ps-0 grid-margin pol-desc">
                    <div class="tab-content tab-content-vertical border py-2 px-3" id="v-tabContent">
                      <div class="tab-pane fade show active" id="v-home" role="tabpanel" aria-labelledby="v-home-tab">
                        <h6 class="mb-2">PM2.5</h6>
                        <p>
                            PM2.5, or fine particulate matter, refers to tiny airborne particles with diameters of 2.5 micrometers or smaller. These particles, often from sources like vehicle emissions and industrial processes, can penetrate deep into the lungs and pose health risks, making monitoring essential for safeguarding air quality and public health.
                        </p>
      
      
                      </div>
                      <div class="tab-pane fade" id="v-profile" role="tabpanel" aria-labelledby="v-profile-tab">
                          <h6 class="mb-2">PM10</h6>
                          <p>
                              PM10, known as coarse particulate matter, encompasses airborne particles with diameters of 10 micrometers or smaller. These particles, originating from sources like road dust, construction activities, and agricultural practices, can irritate the respiratory system upon inhalation, posing health concerns and necessitating monitoring to safeguard public well-being.
                        </p>
      
                      </div>
                      <div class="tab-pane fade" id="v-messages" role="tabpanel" aria-labelledby="v-messages-tab">
                          <h6 class="mb-2">CO</h6>
                          <p>
                              CO, or carbon monoxide, is a colorless and odorless gas produced by incomplete combustion of fossil fuels in vehicles, industrial processes, and residential heating systems. Due to its high affinity for hemoglobin, CO can impair the blood's ability to carry oxygen, leading to symptoms such as headaches, dizziness, and even death in high concentrations.        </p>
                          </div>
                      <div class="tab-pane fade" id="v-no2" role="tabpanel" aria-labelledby="v-no2-tab">
                          <h6 class="mb-2">NO2</h6>
                          <p>
                              NO2, or nitrogen dioxide, is a reddish-brown gas primarily emitted from combustion processes in vehicles, power plants, and industrial facilities. Exposure to NO2 can exacerbate respiratory conditions such as asthma and increase susceptibility to respiratory infections. 
                          </p>
                        </div>
                      <div class="tab-pane fade" id="v-settings" role="tabpanel" aria-labelledby="v-settings-tab">
                          <h6 class="mb-2">03</h6>
                          <p>
                              O3, or ozone, is a reactive gas composed of three oxygen atoms formed through complex chemical reactions involving pollutants such as nitrogen oxides and volatile organic compounds in the presence of sunlight. While beneficial in the stratosphere for blocking harmful UV radiation, ground-level ozone can irritate the respiratory, trigger asthma, and cause lung inflammation. 
                          </p>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          {{-- 2nd collapse --}}
          <div class="col-md-6">
            <div class="collapse multi-collapse" id="multiCollapseExample2">
                <div class="card-body">
                  <div class="table-responsive">
                      <table class="table classification">
                          <thead>
                              <tr>
                                  <th>CATEGORY</th>
                                  <th>PM<sub>10</sub> (ug/m<sup>3</sup>)</th>
                                  <th>PM<sub>2.5</sub> (ug/m<sup>3</sup>)</th>
                                  <th>CO (ppm)</th>
                                  <th>NO2 (ppm)</th>
                                  <th>O3 (ppm)</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td style="color: #00B050; width:50%;">Good</td>
                                  <td>0 - 54</td>
                                  <td>0 - 25</td>
                                  <td>0 - 25</td>
                                  <td>0 - 0.05</td>
                                  <td>0 - 0.064</td>
                              </tr>
                              <tr>
                                  <td style="color: #B5B303;">Moderate</td>
                                  <td>55 - 154</td>
                                  <td>25.1 - 35.0</td>
                                  <td>25 - 50</td>
                                  <td>0.06 - 0.10</td>
                                  <td>0.065 - 0.084</td>
                              </tr>
                              <tr>
                                  <td style="color: #FF6600;">Unhealthy for Sensitive Groups</td>
                                  <td>155 - 254</td>
                                  <td>35.1 - 45.0</td>
                                  <td>51 - 69</td>
                                  <td>0.11 - 0.36</td>
                                  <td>0.085 - 0.104</td>
                              </tr>
                              <tr>
                                  <td style="color: #FF0000;">Unhealthy</td>
                                  <td>255 - 354</td>
                                  <td>45.1 - 55</td>
                                  <td>70 - 150</td>
                                  <td>0.37 - 0.65</td>
                                  <td>0.105 - 0.124</td>
                              </tr>
                              <tr>
                                  <td style="color: #7030A0;">Very Unhealthy</td>
                                  <td>355 - 424</td>
                                  <td>55.1 - 90</td>
                                  <td>151 - 400</td>
                                  <td>0.66 - 1.24</td>
                                  <td>0.125 - 0.374</td>
                              </tr>
                              <tr>
                                  <td style="color:#990033;">Hazardous</td>
                                  <td>425 - 504</td>
                                  <td>Above 91</td>
                                  <td>Above 401</td>
                                  <td>Above 1.24</td>
                                  <td>Above 0.374</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <div class="btn-group float-end">
          <div class="d-flex align-items-center flex-wrap text-nowrap">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
              Report
            </button>

              <div class="dropdown-menu">
                <!-- Nested dropleft 1-->
                <div class="block">
                  <div class="btn-group">
                    <a type="button" class="bg-secondary">
                      <a class="dropdown-item" href="{{ route('pdf.download') }}">Overall Report</a>
                    </a>
                  </div>
                </div>

                <!-- Nested dropleft 2-->
                <div class="block">
                  <div class="btn-group">
                    <div class="dropdown dropstart" role="group">
                      <button title="filter by year" title="filter by year" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropleft</span>
                      </button>
                      {{-- Year Dropdown --}}
                      <div class="dropdown-menu" style="min-width: 5rem;">
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm25/2024/4">Apr</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm25/2024/5">May</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm25/2024/11">Nov</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm25/2024/12">Dec</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm25/2024">2024</a>
                            </a>
                          </div>
                        </div>
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm25/2025/1">Jan</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm25/2025">2025</a>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a type="button" class="bg-secondary">
                      <a class="dropdown-item" href="{{ route('pdf.download.pm25') }}">PM 2.5 Report</a>
                    </a>
                  </div>
                </div>

                <!-- Nested dropleft 3-->
                <div class="block">
                  <div class="btn-group">
                    <div class="dropdown dropstart" role="group">
                      <button title="filter by year" title="filter by year" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="visually-hidden">Toggle Dropleft</span>
                      </button>
                      {{-- Year Dropdown --}}
                      <div class="dropdown-menu" style="min-width: 5rem;">
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm10/2024/4">Apr</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm10/2024/5">May</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm10/2024/11">Nov</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm10/2024/12">Dec</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm10/2024">2024</a>
                            </a>
                          </div>
                        </div>
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm10/2025/1">Jan</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/pm10/2025">2025</a>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a type="button" class="bg-secondary">
                      <a class="dropdown-item" href="{{ route('pdf.download.pm10') }}">PM 10 Report</a>
                    </a>
                  </div>
                </div>

                <!-- Nested dropleft 4-->
                <div class="block">
                  <div class="btn-group">
                    <div class="dropdown dropstart" role="group">
                      <button title="filter by year" title="filter by year" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="visually-hidden">Toggle Dropleft</span>
                      </button>
                      {{-- Year Dropdown --}}
                      <div class="dropdown-menu" style="min-width: 5rem;">
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/co/2024/4">Apr</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/co/2024/5">May</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/co/2024/11">Nov</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/co/2024/12">Dec</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/co/2024">2024</a>
                            </a>
                          </div>
                        </div>
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/co/2025/1">Jan</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/co/2025">2025</a>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a type="button" class="bg-secondary">
                      <a class="dropdown-item" href="{{ route('pdf.download.co') }}">CO Report</a>
                    </a>
                  </div>
                </div>

                <!-- Nested dropleft 5-->
                <div class="block">
                  <div class="btn-group">
                    <div class="dropdown dropstart" role="group">
                      <button title="filter by year" title="filter by year" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="visually-hidden">Toggle Dropleft</span>
                      </button>
                      {{-- Year Dropdown --}}
                      <div class="dropdown-menu" style="min-width: 5rem;">
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/no2/2024/4">Apr</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/no2/2024/5">May</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/no2/2024/11">Nov</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/no2/2024/12">Dec</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/no2/2024">2024</a>
                            </a>
                          </div>
                        </div>
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/no2/2025/1">Jan</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/no2/2025">2025</a>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a type="button" class="bg-secondary">
                      <a class="dropdown-item" href="{{ route('pdf.download.no2') }}">NO2 Report</a>
                    </a>
                  </div>
                </div>
              
                <!-- Nested dropleft 6-->
                <div class="block">
                  <div class="btn-group">
                    <div class="dropdown dropstart" role="group">
                      <button title="filter by year" title="filter by year" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="visually-hidden">Toggle Dropleft</span>
                      </button>
                      {{-- Year Dropdown --}}
                      <div class="dropdown-menu" style="min-width: 5rem;">
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/o3/2024/4">Apr</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/o3/2024/5">May</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/o3/2024/11">Nov</a>
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/o3/2024/12">Dec</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/o3/2024">2024</a>
                            </a>
                          </div>
                        </div>
                        <div class="block">
                          <div class="btn-group">
                            <div class="dropdown dropstart" role="group">
                              <button title="filter by month" title="filter by month" type="button" class="dropdown-item dropdown-toggle dropdown-toggle-split nested-dropdown test" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropleft</span>
                              </button>
                              {{-- Month Dropdown --}}
                              <div class="dropdown-menu" style="min-width: 4rem;">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/o3/2025/1">Jan</a>
                              </div>
                            </div>
                            <a type="button" class="bg-secondary">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/pdf/o3/2025">2025</a>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <a type="button" class="bg-secondary">
                      <a class="dropdown-item" href="{{ route('pdf.download.o3') }}">O3 Report</a>
                    </a>
                  </div>
                </div>
            </div>
          </div>
          {{-- <a href="{{ route('pdf.download') }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
          <i class="btn-icon-prepend" data-feather="download-cloud"></i>
            Report
          </a> --}}
        </div>
        {{-- End of Tabs --}}



        <br>
        {{-- Tab contents --}}
        <div class="tab-content" id="lineTabContent">

        {{-- Start of Monitoring content --}}
        <div class="tab-pane fade show active" id="monitoring" role="tabpanel" aria-labelledby="monitoring-line-tab">
          <h5 class="mb-2">REAL-TIME AIR QUALITY MONITORING </h5>
          <div class="p-3 for-light-mode-bg">
              <div class="mb-3 d-flex justify-content-between align-items-center">
                  <h5>Bukidnon State University</h5>
                  <div class="text-status d-flex gap-2 align-items-center">
                      <div>STATUS:</div>
                      <div id="device-status" class="device-status-offline">
                          <div class="status-circle"></div>
                          <div>OFFLINE</div>
                      </div>
                  </div>
              </div>
          {{-- Cards Container --}}
          <div class="row flex-grow-1">
              {{-- Card 1 --}}
                <div class="col-sm-15 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border-top: 1rem solid #6571ff;">
                            <div class="d-flex justify-content-center align-items-baseline">
                                <h6 data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Particulate Matter 2.5 <br><i>see Pollutant Description<br>for more information</i>"class="card-title mb-0 text-center">PM2.5 (ug/m3)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="pm25-value" class="my-2">
                                        <div class="spinner-grow text-primary" role="status">

                                        </div>
                                    </h3>
                                    <p id="pm25-classification" class="mb-2" style="font-weight: bold; letter-spacing: 1.25px;">

                                    </p>
                                    <p id="pm25-date" style="font-style: italic; font-size: 80%">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              {{-- Card 2 --}}
                <div class="col-sm-15 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border-top: 1rem solid #6571ff;">
                            <div class="d-flex justify-content-center align-items-baseline">
                                <h6 data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Particulate Matter 10 <br><i>see Pollutant Description<br>for more information</i>"class="card-title mb-0 text-center">PM10 (ug/m3)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="pm10-value" class="my-2">
                                        <div class="spinner-grow text-primary" role="status">

                                        </div>
                                    </h3>
                                    <p id="pm10-classification" class="mb-2" style="font-weight: bold; letter-spacing: 1.25px;">

                                    </p>
                                    <p id="pm10-date" style="font-style: italic; font-size: 80%">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              {{-- Card 3 --}}
              <div class="col-sm-15 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border-top: 1rem solid #6571ff;">
                            <div class="d-flex justify-content-center align-items-baseline">
                                <h6 data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Carbon Monoxide <br><i>see Pollutant Description<br>for more information</i>"class="card-title mb-0 text-center">CO (PPM)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="co-value" class="my-2">
                                        <div class="spinner-grow text-primary" role="status">

                                        </div>
                                    </h3>
                                    <p id="co-classification" class="mb-2" style="font-weight: bold; letter-spacing: 1.25px;">

                                    </p>
                                    <p id="co-date" style="font-style: italic; font-size: 80%">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              {{-- Card 4 --}}
              <div class="col-sm-15 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border-top: 1rem solid #6571ff;">
                          <div class="d-flex justify-content-center align-items-baseline">
                            <h6 data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Nitrogen Dioxide <br><i>see Pollutant Description<br>for more information</i>"class="card-title mb-0 text-center">NO2 (PPM)</h6>
                        </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="no2-value" class="my-2">
                                        <div class="spinner-grow text-primary" role="status">

                                        </div>
                                    </h3>
                                    <p id="no2-classification" class="mb-2" style="font-weight: bold; letter-spacing: 1.25px;">

                                    </p>
                                    <p id="no2-date" style="font-style: italic; font-size: 80%">

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              {{-- Card 5 --}}
              <div class="col-sm-15 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border-top: 1rem solid #6571ff;">
                            <div class="d-flex justify-content-center align-items-baseline">
                                <h6 data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Ozone <br><i>see Pollutant Description<br>for more information</i>"class="card-title mb-0 text-center">O3 (PPM)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="ozone-value" class="my-2">
                                        <div class="spinner-grow text-primary" role="status">
                                        </div>
                                    </h3>
                                    <p id="ozone-classification" class="mb-2" style="font-weight: bold; letter-spacing: 1.25px;">
                                    </p>
                                    <p id="ozone-date" style="font-style: italic; font-size: 80%">
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
        </div>
        {{-- End of Monitoring content --}}

        {{-- Start of Forecasting content --}}
        <div class="tab-pane" id="forecasting" role="tabpanel" aria-labelledby="forecasting-line-tab">
          <h5 class="mb-2">AIR QUALITY FORECASTING</h5>
          <div class="p-3 for-light-mode-bg">
              {{-- Forecasting Graphs --}}
              @include('charts.forecastingpm25')
              @include('charts.forecastingpm10')
          </div>
        </div>
        {{-- End of forecasting content --}}

	</div>

<script>
		// Prevent parent dropdown from closing when interacting with nested dropdown
		document.querySelectorAll('.nested-dropdown').forEach(function (dropdown) {
			dropdown.addEventListener('click', function (event) {
					event.stopPropagation();
			});
    });


    document.addEventListener('DOMContentLoaded', function() {
    startPolling('pm25');
    startPolling('pm10');
    startPolling('co');
    startPolling('no2');
    startPolling('ozone');
    });

    const lastFetchTime = {
        pm25: null,
        pm10: null,
        co: null,
        no2: null,
        ozone: null
    };

    function startPolling(pollutant) {
        fetchDataAndUpdate(pollutant); // Initial fetch

        setInterval(() => {
            fetchDataAndUpdate(pollutant);
        }, 1000); // Poll every second (adjust this interval based on your needs)
    }

    function fetchDataAndUpdate(pollutant) {
        fetch(`/${pollutant}-data`)
            .then(response => response.json())
            .then(data => {
                const latestData = data[data.length - 1];

                if (latestData) {
                    const currentTime = new Date();
                    const dataTime = new Date(latestData.dateTime);

                    // Update last fetched time for this pollutant
                    lastFetchTime[pollutant] = dataTime;

                    // Update status based on last fetched time
                    updateDeviceStatus(currentTime, dataTime);

                    // Update the UI with latest data
                    updateUI(pollutant, latestData);
                }
            })
            .catch(error => {
                console.error(`Error fetching ${pollutant} data:`, error);
            });
    }

    function updateDeviceStatus(currentTime, dataTime) {
    const thresholdMinutes = 1; // The time threshold for determining "ONLINE" status
    const thresholdTime = new Date(currentTime.getTime() - thresholdMinutes * 60000);
    const statusElement = document.getElementById('device-status');
        if (dataTime > thresholdTime) {
            // Device is ONLINE
            statusElement.textContent = 'ONLINE';
            statusElement.classList.remove('device-status-offline');
            statusElement.classList.add('device-status-online');

            if (!statusElement.querySelector('.status-circle')) {
                statusElement.innerHTML = '<div class="status-circle"></div>' + statusElement.textContent;
            }
        } else {
            // Device is OFFLINE
            const timeDifference = Math.floor((currentTime - dataTime) / 1000); // Time difference in seconds
            const formattedTime = formatTimeDifference(timeDifference); // Format the time difference
            statusElement.textContent = `OFFLINE: ${formattedTime}`; // Display formatted time delay
            statusElement.classList.remove('device-status-online');
            statusElement.classList.add('device-status-offline');

            if (!statusElement.querySelector('.status-circle')) {
                statusElement.innerHTML = '<div class="status-circle"></div>' + statusElement.textContent;
            }
        }
    }

    // Function to format time difference into human-readable format
    function formatTimeDifference(seconds) {
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);
        const weeks = Math.floor(days / 7);
        const months = Math.floor(days / 30);
        const years = Math.floor(days / 365);

        if (seconds < 60) return `${seconds} second${seconds !== 1 ? 's' : ''} ago`;
        if (minutes < 60) return `${minutes} minute${minutes !== 1 ? 's' : ''} ago`;
        if (hours < 24) return `${hours} hour${hours !== 1 ? 's' : ''} ago`;
        if (days < 30) return `${days} day${days !== 1 ? 's' : ''} ago`;
        if (weeks < 4) return `${weeks} week${weeks !== 1 ? 's' : ''} ago`;
        if (months < 12) return `${months} month${months !== 1 ? 's' : ''} ago`;
        return `${years} year${years !== 1 ? 's' : ''} ago`;
    }

    // function updateDeviceStatus(currentTime, dataTime) {
    // const thresholdMinutes = 1;
    // const thresholdTime = new Date(currentTime.getTime() - thresholdMinutes * 60000);

    // const statusElement = document.getElementById('device-status');
    //     if (dataTime > thresholdTime) {
    //         // Device is ONLINE
    //         statusElement.textContent = 'ONLINE';
    //         statusElement.classList.remove('device-status-offline');
    //         statusElement.classList.add('device-status-online');

    //         if (!statusElement.querySelector('.status-circle')) {
    //             statusElement.innerHTML = '<div class="status-circle"></div>' + statusElement.textContent;
    //         }
    //     } else {
    //         // Device is OFFLINE
    //         statusElement.textContent = 'OFFLINE: 30mins';
    //         statusElement.classList.remove('device-status-online');
    //         statusElement.classList.add('device-status-offline');

    //         if (!statusElement.querySelector('.status-circle')) {
    //             statusElement.innerHTML = '<div class="status-circle"></div>' + statusElement.textContent;
    //         }
    //     }
    // }

    function updateUI(pollutant, data) {
        const valueElement = document.getElementById(`${pollutant}-value`);
        const classificationElement = document.getElementById(`${pollutant}-classification`);
        const dateElement = document.getElementById(`${pollutant}-date`);

        if (data) {
            let value = data[pollutant];

            // Format ozone value to three decimal places
            if (pollutant === 'ozone') {
                value = parseFloat(value).toFixed(3);
            }

            valueElement.textContent = value;

            const classification = getClassification(value, pollutant);
            classificationElement.textContent = classification;
            classificationElement.style.color = getColorForClassification(classification);

            const formattedDate = formatDate(data.dateTime);
            dateElement.textContent = formattedDate;
        }
    }

    function formatDate(dateTime) {
        const date = new Date(dateTime);
        return date.toLocaleString('en-US', { month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true });
    }

    function getClassification(value, pollutant) {
        switch (pollutant) {
            case 'pm25':
                if (value >= 0 && value <= 25) {
                    return "Good";
                } else if (value > 25 && value <= 35) {
                    return "Moderate";
                } else if (value > 35 && value <= 45) {
                    return "Unhealthy for Sensitive Groups";
                } else if (value > 45 && value <= 55) {
                    return "Unhealthy";
                } else if (value > 55 && value <= 90) {
                    return "Very Unhealthy";
                } else if (value > 90) {
                    return "Hazardous";
                } else {
                    return "Unknown Classification";
                }

            case 'pm10':
                if (value >= 0 && value <= 54) {
                    return "Good";
                } else if (value > 54 && value <= 154) {
                    return "Moderate";
                } else if (value > 154 && value <= 254) {
                    return "Unhealthy for Sensitive Groups";
                } else if (value > 254 && value <= 354) {
                    return "Unhealthy";
                } else if (value > 354 && value <= 424) {
                    return "Very Unhealthy";
                } else if (value > 424) {
                    return "Hazardous";
                } else {
                    return "Unknown Classification";
                }

            case 'co':
                if (value >= 0 && value <= 25) {
                    return "Good";
                } else if (value > 25 && value <= 50) {
                    return "Moderate";
                } else if (value > 50 && value <= 69) {
                    return "Unhealthy for Sensitive Groups";
                } else if (value > 69 && value <= 150) {
                    return "Unhealthy";
                } else if (value > 150 && value <= 400) {
                    return "Very Unhealthy";
                } else if (value > 400) {
                    return "Hazardous";
                } else {
                    return "Unknown Classification";
                }

            case 'no2':
                if (value >= 0 && value <= 0.05 + Number.EPSILON) {
                    return "Good";
                } else if (value > 0.05 + Number.EPSILON && value <= 0.10 + Number.EPSILON) {
                    return "Moderate";
                } else if (value > 0.10 + Number.EPSILON && value <= 0.36 + Number.EPSILON) {
                    return "Unhealthy for Sensitive Groups";
                } else if (value > 0.36 + Number.EPSILON && value <= 0.65 + Number.EPSILON) {
                    return "Unhealthy";
                } else if (value > 0.65 + Number.EPSILON && value <= 1.24 + Number.EPSILON) {
                    return "Very Unhealthy";
                } else if (value > 1.24 + Number.EPSILON) {
                    return "Hazardous";
                } else {
                    return "Unknown Classification";
                }

            case 'ozone':
                if (value >= 0 && value <= 0.064) {
                    return "Good";
                } else if (value > 0.064 && value <= 0.084) {
                    return "Moderate";
                } else if (value > 0.084 && value <= 0.104) {
                    return "Unhealthy for Sensitive Groups";
                } else if (value > 0.104 && value <= 0.124) {
                    return "Unhealthy";
                } else if (value > 0.124 && value <= 0.374) {
                    return "Very Unhealthy";
                } else if (value > 0.374 ) {
                    return "Hazardous";
                } else {
                    return "Over values";
                }

            default:
                return "Unknown Classification";
        }
    }


    function getColorForClassification(classification) {
        // Define color mappings for each classification
        // Modify this function to return appropriate colors based on classification
        switch (classification) {
            case "Good":
                return "#00B050"; // Green
            case "Moderate":
                return "#B5B303"; // Yellow
            case "Unhealthy for Sensitive Groups":
                return "#FF6600"; // Orange
            case "Unhealthy":
                return "#FF0000"; // Red
            case "Very Unhealthy":
                return "#7030A0"; // Purple
            case "Hazardous":
                return "#990033"; // Maroon
            default:
                return "#000000"; // Default color
        }
    }

    function formatDate(dateTime) {
        const date = new Date(dateTime);
        return date.toLocaleString('en-US', { month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true });
    }
</script>

@endsection
