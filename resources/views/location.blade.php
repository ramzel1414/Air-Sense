<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  	<meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>AirSense - Location</title>

	{{-- fontawesome --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<!-- End fonts -->

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
    <link rel="icon" href="{{ !empty($logo) && !empty($logo->logo) ? asset('upload/logo/' . $logo->logo) : asset('upload/logo/no_image.png') }}" alt="Air Sense Logo" type="image/png">

</head>
<body class="user-body">
	@include('layouts.header');

    <div class="page-content mx-4">
        <h3 class="mb-2">Device Location</h3>
        <div class="p-3 for-light-mode-bg rounded-1">
            <div class="card rounded-1">
                <div class="card-body rounded-2">
                    <div class="col-12 rounded-3">
                        <div class="d-flex justify-content-center">
                            {{-- <p class="mb-3" id="locationTitle">Device Locations</p> --}}
                        </div>
                        <div id="map" class="rounded-3" style="height: 700px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function initMap() {
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 19,
                center: { lat: 8.157408, lng: 125.124856 },
            });

            // Retrieve device locations from the server
            fetch('/device-locations')
                .then(response => response.json())
                .then(deviceLocations => {
                    deviceLocations.forEach(location => {
                        const { deviceName, deviceSerial, latitude, longitude } = location;

                        // Create a new marker for each device
                        const marker = new google.maps.Marker({
                            position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
                            map: map,
                            title: deviceName, deviceSerial
                        });

                        const infoWindowContent = `
                                <div style="color:#0B1215; text-align:center;">
                                    <h5 >${deviceName}</h5>
                                    <h6 style="margin-top: 3px;">${deviceSerial}</h6>
                                </div>
                            `;

                        // Create an info window to display deviceName on marker click
                        const infoWindow = new google.maps.InfoWindow({
                            content: infoWindowContent,
                        });

                        // Show deviceName in info window when marker is clicked
                        marker.addListener("click", () => {
                            infoWindow.open(map, marker);
                        });

                        // Draw a circle around the marker to represent the sensor range (30 meters)
                        // const circle = new google.maps.Circle({
                        //     strokeColor: "#FF0000",
                        //     strokeOpacity: 0.8,
                        //     strokeWeight: 2,
                        //     fillColor: "#FF0000",
                        //     fillOpacity: 0.35,
                        //     map: map,
                        //     center: marker.getPosition(),
                        //     radius: 20, // 20 meters radius
                        // });
                    });
                })
                .catch(error => {
                    console.error('Error fetching device locations:', error);
                });

            // Update the title to reflect the location information
            const locationTitle = document.getElementById('locationTitle');
            locationTitle.textContent = 'Device Locations';
        }

        // Initialize the map
        window.initMap = initMap;
    </script>

<!-- Include the Google Maps API script with the callback to initialize the maps -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&callback=initMap"></script>

</body>
</html>
