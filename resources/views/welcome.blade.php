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


        <h2>AirSense</h2>

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
                    <div id="device-status" class="device-status-online">
                        <div class="status-circle"></div>
                        <div>ONLINE</div>
                    </div>
                </div>
            </div>
            {{-- Cards Container --}}
            <div class="row flex-grow-1">
              {{-- Card 1 --}}
                <div class="col-sm-15 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" style="border-top: 1rem solid #6571ff;">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">PM2.5 (ug/m3)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="pm25-value" class="mb-2">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </h3>
                                    <p id="pm25-classification" class="mb-2">
                                        <span class="visually-hidden">Loading...</span>
                                    </p>
                                    <p id="pm25-date" style="font-style: italic; font-size: 80%">
                                        <span class="visually-hidden">Loading...</span>
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
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">PM10 (ug/m3)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="pm10-value" class="mb-2">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </h3>
                                    <p id="pm10-classification" class="mb-2">
                                        <span class="visually-hidden">Loading...</span>
                                    </p>
                                    <p id="pm10-date" style="font-style: italic; font-size: 80%">
                                        <span class="visually-hidden">Loading...</span>
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
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">CO (ppm)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="co-value" class="mb-2">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </h3>
                                    <p id="co-classification" class="mb-2">
                                        <span class="visually-hidden">Loading...</span>
                                    </p>
                                    <p id="co-date" style="font-style: italic; font-size: 80%">
                                        <span class="visually-hidden">Loading...</span>
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
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">NO2 (ppm)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="no2-value" class="mb-2">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </h3>
                                    <p id="no2-classification" class="mb-2">
                                        <span class="visually-hidden">Loading...</span>
                                    </p>
                                    <p id="no2-date" style="font-style: italic; font-size: 80%">
                                        <span class="visually-hidden">Loading...</span>
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
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">O3 (ppm)</h6>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 text-center">
                                    <h3 id="ozone-value" class="mb-2">
                                        <div class="spinner-grow text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </h3>
                                    <p id="ozone-classification" class="mb-2">
                                        <span class="visually-hidden">Loading...</span>
                                    </p>
                                    <p id="ozone-date" style="font-style: italic; font-size: 80%">
                                        <span class="visually-hidden">Loading...</span>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
    startPolling('pm25');
    startPolling('pm10');
    startPolling('co');
    startPolling('no2');
    startPolling('ozone');
});

// Track the last fetched time for each pollutant
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
    const thresholdMinutes = 2;
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
            statusElement.textContent = 'OFFLINE';
            statusElement.classList.remove('device-status-online');
            statusElement.classList.add('device-status-offline');

            if (!statusElement.querySelector('.status-circle')) {
                statusElement.innerHTML = '<div class="status-circle"></div>' + statusElement.textContent;
            }
        }
    }

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
                } else if (value > 0.085 && value <= 0.104) {
                    return "Unhealthy for Sensitive Groups";
                } else if (value > 0.105 && value <= 0.124) {
                    return "Unhealthy";
                } else if (value > 0.125 && value <= 0.374) {
                    return "Very Unhealthy";
                } else if (value > 0.375 ) {
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
                return "#FFFF00"; // Yellow
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
    </body>
</html>
