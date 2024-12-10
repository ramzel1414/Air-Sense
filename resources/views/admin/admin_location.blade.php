@extends('admin.admin_dashboard')
@section('content')

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
                            const marker = new google.maps.marker.AdvancedMarkerElement({
                                position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
                                map: map,
                                title: deviceName,  // Use the device name directly as a string
                            });

                            const infoWindowContent = `
                                <div style="color:#0B1215; text-align:center;">
                                    <h5>${deviceName}</h5>
                                    <h6 style="margin-top: 10px;">Device Serial: ${deviceSerial}</h6>
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


@endsection




