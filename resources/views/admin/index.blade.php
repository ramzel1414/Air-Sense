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
              <div class="btn-group">
          <div class="d-flex align-items-center flex-wrap text-nowrap">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="btn-icon-prepend" data-feather="download-cloud"></i>
              Report
            </a></button>

                <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('pdf.download') }}">All Pollutants Report</a>
                <a class="dropdown-item" href="{{ route('pdf.download.pm25') }}">PM 2.5 Report</a>
                <a class="dropdown-item" href="{{ route('pdf.download.pm10') }}">PM 10 Report</a>
                <a class="dropdown-item" href="{{ route('pdf.download.co') }}">CO Report</a>
                <a class="dropdown-item" href="{{ route('pdf.download.no2') }}">NO2 Report</a>
                <a class="dropdown-item" href="{{ route('pdf.download.o3') }}">O3 Report</a>
                </div>
            </div>


            {{-- <a href="{{ route('pdf.download') }}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
            <i class="btn-icon-prepend" data-feather="download-cloud"></i>
              Report
            </a> --}}
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
                              <div class="d-flex justify-content-between align-items-baseline">
                                  <h6 class="card-title mb-0">PM2.5 (ug/m3)</h6>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-md-12 text-center">
                                      <h3 id="pm25-value" class="mb-2">
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
                              <div class="d-flex justify-content-between align-items-baseline">
                                  <h6 class="card-title mb-0">PM10 (ug/m3)</h6>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-md-12 text-center">
                                      <h3 id="pm10-value" class="mb-2">
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
                              <div class="d-flex justify-content-between align-items-baseline">
                                  <h6 class="card-title mb-0">CO (ppm)</h6>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-md-12 text-center">
                                      <h3 id="co-value" class="mb-2">
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
                              <div class="d-flex justify-content-between align-items-baseline">
                                  <h6 class="card-title mb-0">NO2 (ppm)</h6>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-md-12 text-center">
                                      <h3 id="no2-value" class="mb-2">
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
                              <div class="d-flex justify-content-between align-items-baseline">
                                  <h6 class="card-title mb-0">O3 (ppm)</h6>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-md-12 text-center">
                                      <h3 id="ozone-value" class="mb-2">
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

<script>
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
