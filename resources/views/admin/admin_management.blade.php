@extends('admin.admin_dashboard')
@section('content')

<div class="page-content">

    <h3 class="mb-4">System Management</h3>

    <!-- Display Flash Messages -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="row">
        <div class="grid-margin d-flex justify-content-evenly py-3 rounded-3 custom-background">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#addLocation">
                Add Location
            </button>
            <!-- Modal -->
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



            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#addDevice">
                Add Device
            </button>
            <!-- Modal -->
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


            <!-- Update Device Modals (inside the loop) -->
            @foreach ($devices as $device)
            <div class="modal fade" id="updateDevice{{ $device->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <div class="mb-3">
                                    <label for="updateName" class="form-label">Device Name:</label>
                                    <input type="text" class="form-control" id="updateName" name="deviceName" value="{{ $device->deviceName }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="updateCom" class="form-label">Device COM:</label>
                                    <input type="number" class="form-control" id="updateCom" name="devicePort" value="{{ $device->devicePort }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="updateSim" class="form-label">Device Sim#:</label>
                                    <input type="number" class="form-control" id="updateSim" name="deviceSim" value="{{ $device->deviceSim }}" required>
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
            @endforeach



        </div>
    </div>

    <!-- Display Devices -->
    <div class="row d-flex justify-content-evenly">
        @foreach ($devices as $device)
        <div class="col-12 col-sm-5 mb-4">
            <div class="card rounded mb-2">
                <div class="card-body">
                    <div class="mb-2 lh-3">
                        <p class="card-title mb-0">Device ID: <span>{{ $device->id }}</span></p>
                        <p class="card-title mb-0">Device Name: <span>{{ $device->deviceName }}</span></p>
                        <p class="card-title mb-0">Device COM: <span>{{ $device->devicePort }}</span></p>
                        <p class="card-title mb-0">Device Sim #: <span>{{ $device->deviceSim }}</span></p>
                        <p class="card-title mb-0">Device Latitude: <span>{{ $device->latitude }}</span></p>
                        <p class="card-title mb-0">Device Longitude: <span>{{ $device->longitude }}</span></p>
                        <p class="card-title mb-0">Pollutant Data:</p>
                    </div>
                    <div class="mx-4">
                        <p>Particulate Matter 2.5</p>
                        <p>Particulate Matter 10</p>
                        <p>Carbon Monoxide</p>
                        <p>Ozone</p>
                        <p>Nitrogen Dioxide</p>
                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-between">
                

                <!-- Update Device Button -->
                <div class="col-6 card rounded p-3">
                    <button type="button" class="btn btn-secondary rounded-3" data-bs-toggle="modal" data-bs-target="#updateDevice{{ $device->id }}">
                        Update
                    </button>
                </div>

                <!-- Delete Form -->
                <form action="{{ route('admin.delete', $device->id) }}" method="POST" class="col-6 card rounded p-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary rounded-3">Delete</button>
                </form>

            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
