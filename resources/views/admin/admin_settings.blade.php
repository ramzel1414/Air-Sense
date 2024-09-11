
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
                                        <input id="signatory1" type="text" class="form-control" autocomplete="off" placeholder="input name here...">
                                        <label class="form-label mt-2">Project Document Specialist</label>
                                    </div>
                                    <!-- Signatory 2 -->
                                    <div class="col-md-6 mb-3">
                                        <input id="signatory2" type="text" class="form-control" autocomplete="off" placeholder="input name here...">
                                        <label class="form-label mt-2">Senior Environmental Management Specialist</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Signatory 3 -->
                                    <div class="col-md-6 mb-3">
                                        <input id="signatory3" type="text" class="form-control" autocomplete="off" placeholder="input name here...">
                                        <label class="form-label mt-2">Chief, Ambient Monitoring and Forcasting Section
                                            Services Section</label>
                                    </div>
                                    <!-- Signatory 4 -->
                                    <div class="col-md-6 mb-3">
                                        <input id="signatory4" type="text" class="form-control" autocomplete="off" placeholder="input name here...">
                                        <label class="form-label mt-2">Chief, Environmental Documentation Station
                                            Enforcement Division</label>
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

