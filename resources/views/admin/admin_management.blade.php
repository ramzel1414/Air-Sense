@extends('admin.admin_dashboard')
@section('content')



<div class="page-content">

    <div class="d-flex justify-content-between rounded-3 ">
        
        <h3 class="mb-4">System Management</h3>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary col-2 mx-3 mb-3" data-bs-toggle="modal" data-bs-target="#addDevice">
            Add Device
        </button>



            <!-- Modal -->
            <div class="modal fade" id="addDevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a Device</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                        <div class="modal-body">
                            <!-- Form for adding Location -->
                            <form>
                                @csrf
                                <div class="mb-3">
                                    <label for="locationId" class="form-label">Device Location:</label>
                                    <input type="text" class="form-control" id="locationId" name="locationId" placeholder="Enter Sensor ID" required>
                                </div>
                                <div class="mb-3">
                                    <label for="locationId" class="form-label">Device Name:</label>
                                    <input type="text" class="form-control" id="locationId" name="locationId" placeholder="Enter Sensor ID" required>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Device Sim #:</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Sensor Name" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    <h5 class="mb-3">Recently Added!</h5>

    <!-- wrapper start -->
    <div class="row d-flex justify-content-evenly">
        <div class="col-12 col-sm-5 mb-4">
            <div class="card rounded mb-1">
                <div class="card-body">
                    <div class="mb-2 lh-3">
                        <p class="card-title mb-0">Location: <span>Bukidnon State Uniersity</span></p>
                        <p class="card-title mb-0">Device Name: <span>Sensor 1</span></p>
                        <p class="card-title mb-0">Device Sim #: <span>09123456879</span></p>
                        <p class="card-title mb-0">Pollutant Data: </p>
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
            <div class="card rounded p-3">
                <a href="#" class="btn btn-secondary col-6 mx-auto rounded-3">View Details</a>
            </div>
        </div>



    </div>

    <!-- wrapper end -->

</div>

@endsection