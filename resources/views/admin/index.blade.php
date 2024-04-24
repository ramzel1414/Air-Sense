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
                        <div class="device-status">
                            <div class="active-circle"></div>
                            <div class="">ACTIVE</div>
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

	</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    startPolling('pm25');
    startPolling('pm10');
    startPolling('co');
    startPolling('no2');
    startPolling('ozone');
    });

    function startPolling(pollutant) {
        setInterval(() => {
            fetchDataAndUpdate(pollutant);
        }, 1000);
    }

    function fetchDataAndUpdate(pollutant) {
        fetch(`/${pollutant}-data`)
            .then(response => response.json())
            .then(data => {
                const latestData = data[data.length - 1];
                const valueElement = document.getElementById(`${pollutant}-value`);
                const classificationElement = document.getElementById(`${pollutant}-classification`);
                const dateElement = document.getElementById(`${pollutant}-date`);

                if (latestData) {
                    let value = latestData[pollutant];

                    // Format ozone value to three decimal places
                    if (pollutant === 'ozone') {
                        value = parseFloat(value).toFixed(3);
                    }

                    valueElement.textContent = value;

                    const classification = getClassification(value, pollutant);
                    classificationElement.textContent = classification;
                    classificationElement.style.color = getColorForClassification(classification);

                    const formattedDate = formatDate(latestData.dateTime);
                    dateElement.textContent = formattedDate;
                }
            })
            .catch(error => {
                console.error(`Error fetching ${pollutant} data:`, error);
            });
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

@endsection
