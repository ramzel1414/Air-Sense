<!-- Management Modals -->

{{-- Modal for adding a device --}}
<div class="modal fade modal-lg" id="addDevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a Device</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding Device -->
                <form action="{{ route('admin.data.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="addName" class="form-label">Device Name:</label>
                            <input type="text" class="form-control" id="addName" name="deviceName" placeholder="Bukidnon State University - Main Campus" required>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                        <label for="addSerial" class="form-label">Device Serial:</label>
                        <input type="text" class="form-control" id="addSerial" name="deviceSerial" placeholder="Se51G23" required>
                        </div>
                        <div class="col-md-4">
                            <label for="addCom" class="form-label">Device COM:</label>
                            <input type="number" class="form-control" id="addCom" name="devicePort" placeholder="1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="addSim" class="form-label">Device Sim#:</label>
                            <input type="number" class="form-control" id="addSim" name="deviceSim" placeholder="639537399626" required>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Update Device Modals (inside the loop) -->
@foreach ($devices as $device)
<div class="modal fade modal-lg" id="updateDevice{{ $device->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Device</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for updating Device -->
                <form action="{{ route('admin.update', $device->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8">
                            <label for="updateName" class="form-label">Device Name:</label>
                            <input type="text" class="form-control" id="updateName" name="deviceName" value="{{ $device->deviceName }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="deviceInterval">Device Data Interval:</label>
                            <select class="form-control" id="deviceInterval" style="cursor:pointer;">
                                <option value="30">30 seconds</option>
                                <option value="20">20 seconds</option>
                                <option value="10">10 seconds</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="updateSerial" class="form-label">Device Serial:</label>
                            <input type="text" class="form-control" id="updateSerial" name="deviceSerial" placeholder="{{ $device->deviceSerial }}" value="{{ $device->deviceSerial }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="updateCom" class="form-label">Device COM:</label>
                            <input type="number" class="form-control" id="updateCom" name="devicePort" placeholder="{{ $device->devicePort }}" value="{{ $device->devicePort }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="updateSim" class="form-label">Device Sim#:</label>
                            <input type="number" class="form-control" id="updateSim" name="deviceSim"  placeholder="{{ $device->deviceSim }}" value="{{ $device->deviceSim }}" required>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($devices as $device)
<!-- Modal for adding a location -->
<div class="modal fade modal-lg" id="addLocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding Location -->
                <form method="POST" action="{{ route('admin.location.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="deviceId" class="form-label">Device Serial:</label>
                        <select class="form-select" id="deviceId" name="deviceId" required>
                            <option value="">Select Device Serial</option>
                            @foreach ($devices as $device)
                                <option value="{{ $device->id }}">{{ $device->deviceSerial }} - {{ $device->deviceName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="map" style="height: 500px;"></div>
                    <br>
                    <div class="mb-3">
                        <input hidden type="number" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude (e.g., 37.7749)"  step="any" required>
                    </div>
                    <div class="mb-3">
                        <input hidden type="number" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude (e.g., -122.4194)"  step="any" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($devices as $device)
<!-- Modal for deleting a device -->
<div class="modal fade" id="deleteDeviceModal{{ $device->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h5 class="modal-title text-center my-4"  id="exampleModalLabel">Are you sure you want to delete this device?</h5>
            <div class="modal-footer" style="justify-content: space-evenly;">
                @csrf
                <button type="button" class="btn btn-primary rounded-3 " data-bs-dismiss="modal">No, I'm not</button>
                                        <!-- Delete Form -->
                <form action="{{ route('admin.delete', $device->id) }}" method="POST" class="rounded">
                @method('DELETE')
                <button type="submit" class="btn btn-secondary rounded-3">Yes, I'm sure</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endforeach

<script>
    let map;
    let markers = [];
    let marker;

    function initMap() {
        // Initialize map centered at a specific location
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 8.156804915195472, lng: 125.12483062095382},
            zoom: 17,
        });

        // Fetch device locations via AJAX request and display markers
        fetchDeviceLocations();

        // Add click event listener to the map to set a marker on click
        map.addListener("click", (event) => {
            const lat = event.latLng.lat();
            const lng = event.latLng.lng();
            addMarker({ lat, lng });
        });
    }

    function fetchDeviceLocations() {
        fetch('{{ route("device.locations") }}')
            .then(response => response.json())
            .then(data => {
                data.forEach(device => {
                    const { deviceName, latitude, longitude } = device;
                    if (latitude && longitude) {
                        // Create marker for device location
                        const deviceMarker = new google.maps.Marker({
                            position: { lat: parseFloat(latitude), lng: parseFloat(longitude) },
                            map: map,
                            title: deviceName,
                            icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png' // Blue marker icon for device
                        });
                        markers.push(deviceMarker);
                    }
                });

                // Adjust map bounds to fit all markers
                fitMapBounds();
            })
            .catch(error => {
                console.error('Error fetching device locations:', error);
            });
    }

    function addMarker(position) {
        // Remove previous marker if it exists
        if (marker) {
            marker.setMap(null); // Remove marker from map
        }

        // Create a new marker at the clicked location
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: `Custom Marker: ${position.lat}, ${position.lng}`,
        });

        // Add the marker to the markers array
        markers.push(marker);

        // Fit map bounds to include all markers
        fitMapBounds();

        // Update form fields with the selected location's coordinates
        document.getElementById("latitude").value = position.lat;
        document.getElementById("longitude").value = position.lng;
    }

    function fitMapBounds() {
        // Adjust map bounds to fit all markers
        const bounds = new google.maps.LatLngBounds();
        markers.forEach(marker => {
            bounds.extend(marker.getPosition());
        });
        map.fitBounds(bounds);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=GOOGLE_MAP_API&callback=initMap" async defer></script>

