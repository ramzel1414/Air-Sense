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

    <div class="page-content">

    <h3 class="mb-4">Location</h3>
    <!-- wrapper start -->
    <div class="d-flex justify-content-evenly p-3 for-light-mode-bg">

        <div class="col-12 mb-4 card p-3 rounded-2">
            <div class="d-flex justify-content-center">
                <h5 class="mb-3" id="locationTitle">Device Locations</h5>
            </div>
            <div id="map" class="rounded-3" style="height: 700px"></div>
        </div>

        <script type="text/javascript">
            function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 18,
                    center: { lat: 8.157408, lng: 125.124856 },
                    mapId: "{{ env('GOOGLE_MAP_ID') }}",
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
                                title: deviceName,  // Use the device name directly as a string
                            });

                            // Create a circle with a radius of 12 meters
                            const circle = new google.maps.Circle({
                                map: map,
                                center: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
                                radius: 8,  // Radius in meters
                                strokeColor: "#FF0000",
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                fillColor: "#FF0000",
                                fillOpacity: 0.35,
                            });

                            const infoWindowContent = `
                                <div style="color:#0B1215; text-align:center;">
                                    <h5>${deviceName}</h5>
                                    <h6 style="margin-top: 5px;">Device Serial: ${deviceSerial}</h6>
                                    <h6 style="margin-top: 10px;">Placement</h6>
                                    <h7>12 Meters (Detection Radius)</h7>
                                    <h7>6 Meters (Vertical Coverage)</h7>
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
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching device locations:', error);
                    });

                // Update the title to reflect the location information
                const locationTitle = document.getElementById('locationTitle');
                locationTitle.textContent = 'Device Locations';
            }
            window.initMap = initMap;
        </script>
    </div>
</div>

<!-- Include the Google Maps API script with the callback to initialize the maps -->
{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&callback=initMap"></script> --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_API') }}&callback=initMap&v=weekly&libraries=marker" ></script>


</body>
</html>
