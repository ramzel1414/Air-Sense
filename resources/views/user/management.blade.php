

@extends('user.user_dashboard')
@section('content')



<div class="page-content">

    <h3 class="mb-4">System Management</h3>
      
    <div class="row">
            
        <div class="grid-margin d-flex justify-content-evenly py-3 rounded-3 custom-background">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#addLocation">
                Add Location
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addLocation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add a Location</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding Location -->
                            <form>
                                @csrf
                                <div class="mb-3">
                                    <label for="locationId" class="form-label">Location ID:</label>
                                    <input type="text" class="form-control" id="locationId" name="locationId" placeholder="Enter Location ID" required>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Location:</label>
                                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location Name" required>
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


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#addDevice">
                Add Device
            </button>
            <!-- Modal -->
            <div class="modal fade" id="addDevice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a Sensor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                    </div>
                        <div class="modal-body">
                            <!-- Form for adding Location -->
                            <form>
                                @csrf
                                <div class="mb-3">
                                    <label for="locationId" class="form-label">Sensor ID:</label>
                                    <input type="text" class="form-control" id="locationId" name="locationId" placeholder="Enter Sensor ID" required>
                                </div>
                                <div class="mb-3">
                                    <label for="location" class="form-label">Sensor Name:</label>
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

    </div>

    <h5 class="mb-3">Recently Added!</h5>

    <!-- wrapper start -->
    <div class="row d-flex justify-content-evenly">
        <div class="col-12 col-sm-5 mb-4">
            <div class="card rounded mb-1">
                <div class="card-body">
                    <div class="mb-2 lh-3">
                        <p class="card-title mb-0">Location: <span>Gaisano Malaybalay</span></p>
                        <p class="card-title mb-0">Location ID: <span>126421</span></p>
                        <p class="card-title mb-0">Sensor Name: <span>Sensor 1</span></p>
                        <p class="card-title mb-0">Sensor ID: <span>8080</span></p>
                    </div>
                    <div class="mx-4">
                        <p>Particulate Matter 2.5: <span> 12 ug/m3</span></p>
                        <p>Particulate Matter 10: <span>12 ug/m</span></p>
                        <p>Carbon Monoxide: <span>30ppm</span></p>
                        <p>Ozone: <span>220 DU</span></p>
                        <p>Nitrogen Dioxide: <span>200 ug/m3</span></p>

                    </div>
                </div>
            </div>
            <div class="card rounded p-3">
                <a href="{{ route('user.pollutants') }}" class="btn btn-secondary col-6 mx-auto rounded-3">View Details</a>
            </div>
        </div>
        
        <div class="col-12 col-sm-5 mb-4">
            <div class="card rounded mb-1">
                <div class="card-body">
                    <div class="mb-2 lh-3">
                        <p class="card-title mb-0">Location: <span>Gaisano Malaybalay</span></p>
                        <p class="card-title mb-0">Location ID: <span>126421</span></p>
                        <p class="card-title mb-0">Sensor Name: <span>Sensor 1</span></p>
                        <p class="card-title mb-0">Sensor ID: <span>8080</span></p>
                    </div>
                    <div class="mx-4">
                        <p>Particulate Matter 2.5: <span> 12 ug/m3</span></p>
                        <p>Particulate Matter 10: <span>12 ug/m</span></p>
                        <p>Carbon Monoxide: <span>30ppm</span></p>
                        <p>Ozone: <span>220 DU</span></p>
                        <p>Nitrogen Dioxide: <span>200 ug/m3</span></p>

                    </div>
                </div>
            </div>
            <div class="card rounded p-3">
                <a href="#" class="btn btn-secondary col-6 mx-auto rounded-3">View Details</a>
            </div>
        </div>
        
        <div class="col-12 col-sm-5 mb-4">
            <div class="card rounded mb-1">
                <div class="card-body">
                    <div class="mb-2 lh-3">
                        <p class="card-title mb-0">Location: <span>Gaisano Malaybalay</span></p>
                        <p class="card-title mb-0">Location ID: <span>126421</span></p>
                        <p class="card-title mb-0">Sensor Name: <span>Sensor 1</span></p>
                        <p class="card-title mb-0">Sensor ID: <span>8080</span></p>
                    </div>
                    <div class="mx-4">
                        <p>Particulate Matter 2.5: <span> 12 ug/m3</span></p>
                        <p>Particulate Matter 10: <span>12 ug/m</span></p>
                        <p>Carbon Monoxide: <span>30ppm</span></p>
                        <p>Ozone: <span>220 DU</span></p>
                        <p>Nitrogen Dioxide: <span>200 ug/m3</span></p>

                    </div>
                </div>
            </div>
            <div class="card rounded p-3">
                <a href="#" class="btn btn-secondary col-6 mx-auto rounded-3">View Details</a>
            </div>
        </div>
        
        <div class="col-12 col-sm-5 mb-4">
            <div class="card rounded mb-1">
                <div class="card-body">
                    <div class="mb-2 lh-3">
                        <p class="card-title mb-0">Location: <span>Gaisano Malaybalay</span></p>
                        <p class="card-title mb-0">Location ID: <span>126421</span></p>
                        <p class="card-title mb-0">Sensor Name: <span>Sensor 1</span></p>
                        <p class="card-title mb-0">Sensor ID: <span>8080</span></p>
                    </div>
                    <div class="mx-4">
                        <p>Particulate Matter 2.5: <span> 12 ug/m3</span></p>
                        <p>Particulate Matter 10: <span>12 ug/m</span></p>
                        <p>Carbon Monoxide: <span>30ppm</span></p>
                        <p>Ozone: <span>220 DU</span></p>
                        <p>Nitrogen Dioxide: <span>200 ug/m3</span></p>

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