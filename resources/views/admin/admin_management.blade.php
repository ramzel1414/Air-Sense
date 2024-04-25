@extends('admin.admin_dashboard')
@section('content')

@include('admin.modals.modal-management')


<div class="page-content">

    <div class="row grid-margin">

        <div class="d-flex justify-content-between rounded-3 mb-4">
            <h3 class="">System Management</h3>
                <!-- Button trigger modal -->
            <button type="button" class="btn btn-success col-3" data-bs-toggle="modal" data-bs-target="#addDevice">
                Add Device
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
    <div class="d-flex justify-content-evenly p-3 for-light-mode-bg">
        @foreach ($devices as $device)
        <div class="col-12 col-sm-5 mb-4">
            <div class="card rounded mb-2">
                <div class="card-body">
                    <div class="mb-2">

                    @if ($device->deviceStatus === 'ACTIVE')
                        <form action="{{ route('admin.toggleStatus', $device->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success w-100 card-title">Active</button>
                        </form>
                    @else
                        <form action="{{ route('admin.toggleStatus', $device->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-secondary w-100 card-title">Inactive</button>
                        </form>
                    @endif


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
                    <div class="row">
                        <div class="col-12 rounded mb-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success w-100 rounded-3" data-bs-toggle="modal" data-bs-target="#addLocation">
                                Add Location
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Update Device Button -->
                        <div class="col-6 rounded">
                            <button type="button" class="btn btn-primary rounded-3 w-100" data-bs-toggle="modal" data-bs-target="#updateDevice{{ $device->id }}">
                                Update
                            </button>
                        </div>
                        <!-- Delete Form -->
                        <form action="{{ route('admin.delete', $device->id) }}" method="POST" class="col-6 rounded">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary rounded-3 w-100">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
