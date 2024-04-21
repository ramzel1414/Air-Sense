

@extends('admin.admin_dashboard')
@section('content')



<div class="page-content">

    <h3 class="mb-4">Location</h3>
      
    <!-- wrapper start -->
    <div class="d-flex justify-content-evenly">
      

        <div class="col-12 mb-4 card p-2 rounded-2">
            <div class="d-flex justify-content-center">
                {{-- <p class="mb-3" id="locationTitle">Device Locations</p> --}}
            </div>
            <div id="map" class="rounded-3" style="height: 700px"></div>
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
                            const { deviceName, latitude, longitude } = location;
    
                            // Create a new marker for each device
                            const marker = new google.maps.Marker({
                                position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
                                map: map,
                                title: deviceName,
                            });
    
                            // Create an info window to display deviceName on marker click
                            const infoWindow = new google.maps.InfoWindow({
                                content: deviceName,
                            });
    
                            // Show deviceName in info window when marker is clicked
                            marker.addListener("click", () => {
                                infoWindow.open(map, marker);
                            });
    
                            // Draw a circle around the marker to represent the sensor range (30 meters)
                            const circle = new google.maps.Circle({
                                strokeColor: "#FF0000",
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                fillColor: "#FF0000",
                                fillOpacity: 0.35,
                                map: map,
                                center: marker.getPosition(),
                                radius: 20, // 30 meters radius
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
    
            // Initialize the map
            window.initMap = initMap;
        </script>
    </div>
    <!-- wrapper end -->
</div>
@endsection




