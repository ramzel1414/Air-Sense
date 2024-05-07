//admin management


@extends('admin.admin_dashboard')
@section('content')

@include('admin.modals.modal-management')


<div class="page-content">

    <div class="row grid-margin">
        <div class="d-flex justify-content-start rounded-3 mb-4">
            <h3>System Management</h3>

        </div>
        <div class="grid-margin d-flex justify-content-evenly py-3 rounded-3 custom-background gap-5">
                <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-3" data-bs-toggle="modal" data-bs-target="#addDevice">
                Add Device
            </button>
            <button type="button" class="btn btn-primary col-3" data-bs-toggle="modal" data-bs-target="#addLocation">
                Add Location
            </button>
        </div>
    </div>

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



    <!-- Display Devices -->
    <div class="d-flex flex-wrap justify-content-evenly p-3 for-light-mode-bg">
        @foreach ($devices as $device)
        <div class="col-12 col-sm-5 my-5">
            <div class="card rounded mb-2">
                <div class="card-body">

                    <div id="#" class="management-status-active">
                        <div class="status-circle"></div>
                        <div>ACTIVE</div>
                    </div>

                    <div class="mb-2">
                        <p class="card-title mb-0">Device Name: <span>{{ $device->deviceName }}</span></p>
                        <p class="card-title mb-0">Device Serial: <span>{{ $device->deviceSerial }}</span></p>
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

            <div class="card">
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="col-12 rounded mb-3">
                            @if ($device->deviceStatus === 'ACTIVE')
                                <form action="{{ route('admin.toggleStatus', $device->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-secondary w-100">Active</button>
                                </form>
                            @else
                                <form action="{{ route('admin.toggleStatus', $device->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success w-100">Inactive</button>
                                </form>
                            @endif
                        </div>
                    </div> --}}
                    <div class="row">
                        <!-- Update Device Button -->
                        <div class="col-6 rounded">
                            <button type="button" class="btn btn-primary rounded-3 w-100" data-bs-toggle="modal" data-bs-target="#updateDevice{{ $device->id }}">
                                Update
                            </button>
                        </div>
                        <!-- Delete Button trigger modal -->
                        <div class="col-6 rounded">

                            <button type="button" class="btn btn-secondary rounded-3 w-100" data-bs-toggle="modal" data-bs-target="#deleteDeviceModal{{ $device->id }}">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
