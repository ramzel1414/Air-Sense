
@extends('admin.admin_dashboard')
@section('content')

<div class="page-content">

    <h3 class="mb-4">General Settings</h3>


    <div class="row">

        <!-- left wrapper start -->
        <div class="col-sm-6 col-md-4 col-xl-3 left-wrapper">

            <div class="card">
                
                <div class="card-body">
                    <h6 class="mb-3 d-flex justify-content-center">Notifications</h6>

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

            {{-- <div class="card">
                <div class="card-body">
                    <h6 class="d-flex mb-3 d-flex justify-content-center">About</h6>
                    <p class="text-center">Lorem ipsum  adipisci exercitationem harum tempora eveniet repellat rem blanditiis officiis rerum quisquam molestiae omnis quasi quibusdam voluptates qui corporis amet?</p>
                </div>
            </div> --}}

        </div>
        <!-- left wrapper end -->

        <!-- right wrapper start -->
        <div class="col-sm-6 col-md-9">
            <div class="row flex-grow-1">

                <div class="col-11 mx-auto">
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
                                        <p class="">ENGR. JOHARA JANE G. PECSON</p>
                                        <label class="form-label text-muted mt-2">Project Document Specialist</label>
                                        <button type="button" class="btn btn-primary d-block" data-bs-toggle="modal" data-bs-target="#signatory1">
                                            Edit
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="signatory1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Signatory Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="signatoryForm1">
                                                            <!-- Professional Title -->
                                                            <div class="mb-3">
                                                                <label for="professionalTitle1" class="form-label">Professional Title</label>
                                                                <select id="professionalTitle1" class="form-select">
                                                                    <option value="Engr">Engr</option>
                                                                    <option value="Doc">Doc</option>
                                                                    <option value="Prof">Prof</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="firstname1" class="form-label">Firstname</label>
                                                                <input type="text" id="firstname1" class="form-control" placeholder="John" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="middlename1" class="form-label">Middlename</label>
                                                                <input type="text" id="middlename1" class="form-control" placeholder="A." >
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="lastname1" class="form-label">Lastname</label>
                                                                <input type="text" id="lastname1" class="form-control" placeholder="Doe" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="position1" class="form-label">Position</label>
                                                                <input type="text" id="position1" class="form-control" placeholder="Project Document Specialist" required>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" id="saveChangesButton">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Signatory 2 -->
                                    <div class="col-md-6 mb-3">
                                        <p class="">DR. MARK ELWOOD</p>
                                        <label class="form-label text-muted mt-2">Senior Research Scientist</label>
                                        <button type="button" class="btn btn-primary d-block" data-bs-toggle="modal" data-bs-target="#signatory2">
                                            Edit
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="signatory2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel2">Edit Signatory Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="signatoryForm2">
                                                            <!-- Professional Title -->
                                                            <div class="mb-3">
                                                                <label for="professionalTitle2" class="form-label">Professional Title</label>
                                                                <select id="professionalTitle2" class="form-select">
                                                                    <option value="Engr">Engr</option>
                                                                    <option value="Doc">Doc</option>
                                                                    <option value="Prof">Prof</option>
                                                                </select>
                                                            </div>
                                                            <!-- Firstname -->
                                                            <div class="mb-3">
                                                                <label for="firstname2" class="form-label">Firstname</label>
                                                                <input type="text" id="firstname2" class="form-control" placeholder="Mark" required>
                                                            </div>
                                                            <!-- Middlename -->
                                                            <div class="mb-3">
                                                                <label for="middlename2" class="form-label">Middlename</label>
                                                                <input type="text" id="middlename2" class="form-control" placeholder="Elwood">
                                                            </div>
                                                            <!-- Lastname -->
                                                            <div class="mb-3">
                                                                <label for="lastname2" class="form-label">Lastname</label>
                                                                <input type="text" id="lastname2" class="form-control" placeholder="Elwood" required>
                                                            </div>
                                                            <!-- Position -->
                                                            <div class="mb-3">
                                                                <label for="position2" class="form-label">Position</label>
                                                                <input type="text" id="position2" class="form-control" placeholder="Senior Research Scientist" required>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" id="saveChangesButton2">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <!-- Signatory 3 -->
                                    <div class="col-md-6 mb-3">
                                        <p for="" class="">ENGR. DIVINE GRACE LEGION</p>
                                        <label class="form-label text-muted mt-2">Chief, Ambient Monitoiring and Forecasting Section Services</label>
                                        <button type="button" class="btn btn-primary d-block" data-bs-toggle="modal" data-bs-target="#signatory3">
                                            Edit
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="signatory3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Signatory Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label for="professionalTitle" class="form-label">Professional Title</label>
                                                                <select id="" class="form-select">
                                                                    <option value="Engr">Engr</option>
                                                                    <option value="Doc">Doc</option>
                                                                    <option value="Prof">Prof</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="firstname" class="form-label">Firstname</label>
                                                                <input type="text" id="" class="form-control" required placeholder="hello3">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="middlename" class="form-label">Middlename</label>
                                                                <input type="text" id="" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="lastname" class="form-label">Lastname</label>
                                                                <input type="text" id="" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="position" class="form-label">Position</label>
                                                                <input type="text" id="" class="form-control" required>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Signatory 4 -->
                                    <div class="col-md-6 mb-3">
                                        <p for="" class="">ENGR. DOVEE CHERRY I. GEOLLEGUE</p>
                                        <label class="form-label text-muted mt-2">Chief, Environmental Documentation Station Enforcement Division</label>
                                        <button type="button" class="btn btn-primary d-block" data-bs-toggle="modal" data-bs-target="#signatory4">
                                            Edit
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="signatory4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Signatory Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label for="professionalTitle" class="form-label">Professional Title</label>
                                                                <select id="" class="form-select">
                                                                    <option value="Engr">Engr</option>
                                                                    <option value="Doc">Doc</option>
                                                                    <option value="Prof">Prof</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="firstname" class="form-label">Firstname</label>
                                                                <input type="text" id="" class="form-control" required placeholder="hello4">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="middlename" class="form-label">Middlename</label>
                                                                <input type="text" id="" class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="lastname" class="form-label">Lastname</label>
                                                                <input type="text" id="" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="position" class="form-label">Position</label>
                                                                <input type="text" id="" class="form-control" required>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

<script>

    document.addEventListener('DOMContentLoaded', () => {
        
        //settings page preview images 
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

        //place a placeholder on signatory's inputs
        // First Modal
        document.getElementById('signatory1')
            .addEventListener('show.bs.modal', function (event) {  

                // Populate the modal with existing data 
                document.getElementById('professionalTitle1').value = 'Engr'; 
                document.getElementById('firstname1').value = 'Johara'; 
                document.getElementById('middlename1').value = 'Jane'; 
                document.getElementById('lastname1').value = 'Pecson'; 
                document.getElementById('position1').value = 'Project Document Specialist'; 
            });
        // Second Modal
        document.getElementById('signatory2')
            .addEventListener('show.bs.modal', function (event) {
                
                document.getElementById('professionalTitle2').value = 'Doc'; 
                document.getElementById('firstname2').value = 'Mark'; 
                document.getElementById('middlename2').value = 'Elwood'; 
                document.getElementById('lastname2').value = 'Elwood'; 
                document.getElementById('position2').value = 'Senior Research Scientist'; 
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

