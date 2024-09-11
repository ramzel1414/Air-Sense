
@extends('admin.admin_dashboard')
@section('content')

<div class="page-content">

    <div class="row">

        <!-- left wrapper start -->
        <div class="col-sm-6 col-md-4 col-xl-3 left-wrapper">
                    <div class="card">
                        <div class="card-body ">

                            <div class="col-12 mx-auto mb-3 d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Language</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="flag-icon flag-icon-us"></i> <span class="mx-1"> Kano</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="flag-icon flag-icon-ae"></i> <span class="mx-1">Mokols</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="flag-icon flag-icon-af"></i> <span class="mx-1">Ilongo</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i class="flag-icon flag-icon-ag"></i> <span class="mx-1">Waray</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mx-auto mb-3 d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Theme</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mx-auto mb-3 d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Date and Time</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mx-auto mb-3 d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Security</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>

        </div>
        <!-- left wrapper end -->

        <!-- right wrapper start -->
        <div class="col-sm-6 col-md-8 mx-auto">
            <div class="row flex-grow-1">
                <div class="col-5 mx-auto">
                    <div class="card">

                        <div class="card-body">
                            <h6 class="mb-3 d-flex justify-content-center">Notifications</h6>
                            


                            {{-- each toggle container --}}
                            {{-- <div class="col-12 mx-auto mb-3 d-flex justify-content-start align-items-baseline">
                                <!-- Custom Toggle Switch -->
                                <div class="custom-toggle my-auto">

                                    <input type="checkbox" class="custom-control-input" id="toggleSwitch1">
                                    <label class="custom-control-label" for="toggleSwitch1"></label>
                                </div>
                                <!-- custom Toggle Description -->
                                <p id="description">Data Interval Update</p>

                            </div> --}}

                            {{-- each toggle container --}}
                            <div class="col-12 mx-auto mb-3 d-flex justify-content-start align-items-baseline">
                                <!-- Custom Toggle Switch -->
                                <div class="custom-toggle my-auto">

                                    <input type="checkbox" class="custom-control-input" id="toggleSwitch2">
                                    <label class="custom-control-label" for="toggleSwitch2"></label>
                                </div>
                                <!-- custom Toggle Description -->
                                <p>Device Update Notification</p>

                            </div>

                            {{-- each toggle container --}}
                            <div class="col-12  mb-3 d-flex justify-content-start align-items-baseline">                            <!-- Custom Toggle Switch -->
                                <div class="custom-toggle my-auto">
                                    
                                    <input type="checkbox" class="custom-control-input" id="toggleSwitch3">
                                    <label class="custom-control-label" for="toggleSwitch3"></label>
                                </div>
                                <!-- custom Toggle Description -->
                                <p>Reminder Notification</p>

                            </div>
                        
                        </div>
                    </div>
                </div>

                <div class="col-5 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="d-flex mb-3 d-flex justify-content-center">About</h6>
                            <p class="text-center">Lorem ipsum  adipisci exercitationem harum tempora eveniet repellat rem blanditiis officiis rerum quisquam molestiae omnis quasi quibusdam voluptates qui corporis amet?</p>
                        </div>
                    </div>
                </div>


                <div class="col-11 mx-auto mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <h6 class="card-title">Update PDF Report Logo</h6>
                                <div class="row">
                                    <input id="inputLogo" type="file" class="form-control" autocomplete="off" name="photo" accept="image/*">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"></label>
                                <img id="previewLogo" class="wd-80 rounded-circle" src="{{ url('/upload/airsense2.png')}}" alt="logo">
                            </div>
                            <button class="btn btn-primary">Update Logo</button>

                            <div class="mt-4">
                                <h6 class="card-title mb-3">Update PDF Report Signatory</h6>
                                <div class="row">
                                    <!-- Signatory 1 -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">ENGR. JOHARA JANE G. PECSON</label>
                                        <input id="signatory1" type="file" class="form-control" autocomplete="off" name="photo">
                                        <img id="previewSignatory1" class="mt-2 wd-70 rounded-5" src="https://via.placeholder.com/80?text=Signatory" alt="logo">
                                    </div>
                                    <!-- Signatory 2 -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">JESSIE JAMES B. OSIN</label>
                                        <input id="signatory2" type="file" class="form-control" autocomplete="off" name="photo">
                                        <img id="previewSignatory2" class="mt-2 wd-70 rounded-5" src="https://via.placeholder.com/80?text=Signatory" alt="logo">
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Signatory 3 -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">ENGR. ROSALINDA L. ILOGON</label>
                                        <input id="signatory3" type="file" class="form-control" autocomplete="off" name="photo">
                                        <img id="previewSignatory3" class="mt-2 wd-70 rounded-5" src="https://via.placeholder.com/80?text=Signatory" alt="logo">
                                    </div>
                                    <!-- Signatory 4 -->
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">ENGR. DOVEE CHERRY I. GEOLLEGUE</label>
                                        <input id="signatory4" type="file" class="form-control" autocomplete="off" name="photo">
                                        <img id="previewSignatory4" class="mt-2 wd-70 rounded-5" src="https://via.placeholder.com/80?text=Signatory" alt="logo">
                                    </div>
                                </div>
                                <button class="btn btn-primary">Update Signatory</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- right wrapper end -->


    </div>

</div>


@endsection

{{-- settings page preview images --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
    
        document.getElementById('inputLogo').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewLogo').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Preview for Signatory 1
        document.getElementById('signatory1').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewSignatory1').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });


        // Preview for Signatory 2
        document.getElementById('signatory2').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewSignatory2').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });


</script>


<style>
    /* Custom styles for the toggle switch */
   .custom-toggle {
       position: relative;
       width: 30px;
       height: 15px;
       margin-right: .5rem;
   }
   
   /* Hide the default checkbox */
   .custom-toggle input {
       opacity: 0;
       width: 0;
       height: 0;
   }
   
   /* Style for the track/background of the toggle switch */
   .custom-toggle label {
       position: absolute;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       outline: 1px solid white;
       background-color: #0c1427; /* Default background color */
       border-radius: 15px; /* Rounded corners */
       cursor: pointer;
       transition: background-color 0.3s; /* Smooth color transition */
   }
   
   /* Change background color when the toggle switch is checked */
   .custom-toggle input:checked + label {
       background-color: blue; /* Blue color when checked */
   }
   
   /* Style for the sliding circle inside the toggle switch */
   .custom-toggle label:before {
       content: '';
       position: absolute;
       top: 50%;
       transform: translateY(-50%);
       width: 15px;
       height: 15px;
       background-color: #fff; /* Circle color */
       border-radius: 50%; /* Rounded shape */
       transition: transform 0.3s; /* Smooth sliding transition */
   }
   
   /* Move the circle to the right when the toggle switch is checked */
   .custom-toggle input:checked + label:before {
       transform: translate(15px, -50%);
   }


   </style>

