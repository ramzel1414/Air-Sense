<!-- Management Modal -->
{{-- Modal for adding a device --}}
<div class="modal fade" id="addDevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a Device</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding Device -->
                <form action="{{ route('data.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="addName" class="form-label">Device Name:</label>
                        <input type="text" class="form-control" id="addName" name="deviceName" placeholder="Bukidnon State University - Main Campus" required>
                    </div>
                    <div class="mb-3">
                        <label for="addCom" class="form-label">Device COM:</label>
                        <input type="number" class="form-control" id="addCom" name="devicePort" placeholder="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="addSim" class="form-label">Device Sim#:</label>
                        <input type="number" class="form-control" id="addSim" name="deviceSim" placeholder="639537399626" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for adding a location -->
<div class="modal fade" id="addLocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="deviceId" class="form-label">Device ID:</label>
                        <select class="form-select" id="deviceId" name="deviceId" required>
                            <option value="">Select Device ID</option>
                            @foreach ($devices as $device)
                                <option value="{{ $device->id }}">{{ $device->id }} - {{ $device->deviceName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude:</label>
                        <input type="number" class="form-control" id="latitude" name="latitude" placeholder="Enter Latitude (e.g., 37.7749)"  step="any" required>
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude:</label>
                        <input type="number" class="form-control" id="longitude" name="longitude" placeholder="Enter Longitude (e.g., -122.4194)"  step="any" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>