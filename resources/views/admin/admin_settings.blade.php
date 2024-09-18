@extends('admin.admin_dashboard')
@section('content')

@include('admin.modals.modal-settings')

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
                        <div class="col-12  mb-3 d-flex justify-content-start align-items-baseline">
                            <!-- Custom Toggle Switch -->
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
            <!-- left wrapper end -->

                <!-- Display Flash Messages -->


            <!-- right wrapper start -->
            <div class="col-sm-6 col-md-9">
                <div class="row flex-grow-1">
                    <div class="col-11 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="card-title">Report Logo</h6>
                                    <div class="row">
                                        <input id="inputLogo" type="file" class="form-control" autocomplete="off"
                                            name="photo" accept="image/*">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"></label>
                                    <img id="previewLogo" class="wd-80 rounded-circle"
                                        src="{{ url('/upload/airsense2.png') }}" alt="logo">
                                </div>
                                <button class="btn btn-primary">Update Logo</button>

                                {{-- CHANGED THIS <br> AND ADD SPACING --}}
                                <br><br>
                                <div class="mt-4">
                                    <h6 class="card-title mb-3">Report Signatory</h6>
                                    <div class="row">
                                        @foreach ($signatories as $signatory)
                                            <div class="col-md-6 mb-3">
                                                <h5 style="text-transform: uppercase;">{{ $signatory->profTitles }}
                                                    {{ $signatory->firstName }}
                                                    @if($signatory->middleName){{ strtoupper(substr($signatory->middleName, 0, 1)) }}.
                                                    @endif {{ $signatory->lastName }}</h5>
                                                <label class="form-label text-muted mt-2">{{ $signatory->position }}</label>
                                                <button type="button" class="btn btn-primary d-block"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#signatory{{ $signatory->id }}">Edit</button>

                                                <!-- Modal -->

                                            </div>
                                        @endforeach
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

        // //placeholder on signatory1's inputs
        // //Modal 1
        // document.getElementById('signatory1')
        //     .addEventListener('show.bs.modal', function (event) {

        //         // Populate the modal with existing data (static example)
        //         document.getElementById('professionalTitle1').value = 'Engr';
        //         document.getElementById('firstname1').value = 'Johara Jane';
        //         document.getElementById('middlename1').value = 'G';
        //         document.getElementById('lastname1').value = 'Pecson';
        //         document.getElementById('position1').value = 'Project Document Specialist';
        //     });
        // //Modal 2
        // document.getElementById('signatory2')
        //     .addEventListener('show.bs.modal', function (event) {

        //         document.getElementById('professionalTitle2').value = 'Engr';
        //         document.getElementById('firstname2').value = 'Jessie James';
        //         document.getElementById('middlename2').value = 'B';
        //         document.getElementById('lastname2').value = 'Osin';
        //         document.getElementById('position2').value = 'Senior Environmental Management Specialist';
        //     });
        // //Modal 3
        // document.getElementById('signatory3')
        //     .addEventListener('show.bs.modal', function (event) {

        //         document.getElementById('professionalTitle3').value = 'Engr';
        //         document.getElementById('firstname3').value = 'Divine Grace';
        //         document.getElementById('middlename3').value = '';
        //         document.getElementById('lastname3').value = 'Legion';
        //         document.getElementById('position3').value = 'Chief, Ambient Monitoiring and Forecasting Section Services';
        //     });
        // //Modal 4
        // document.getElementById('signatory4')
        //     .addEventListener('show.bs.modal', function (event) {

        //         document.getElementById('professionalTitle4').value = 'Engr';
        //         document.getElementById('firstname4').value = 'Dovee Cherry';
        //         document.getElementById('middlename4').value = 'I';
        //         document.getElementById('lastname4').value = 'Geollegue';
        //         document.getElementById('position4').value = 'Chief, Environmental Documentation Station Enforcement Division';
        //     });
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
        background-color: #0c1427;
        /* Default background color */
        border-radius: 15px;
        /* Rounded corners */
        cursor: pointer;
        transition: background-color 0.3s;
        /* Smooth color transition */
    }

    /* Change background color when the toggle switch is checked */
    .custom-toggle input:checked+label {
        background-color: blue;
        /* Blue color when checked */
    }

    /* Style for the sliding circle inside the toggle switch */
    .custom-toggle label:before {
        content: '';
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        background-color: #fff;
        /* Circle color */
        border-radius: 50%;
        /* Rounded shape */
        transition: transform 0.3s;
        /* Smooth sliding transition */
    }

    /* Move the circle to the right when the toggle switch is checked */
    .custom-toggle input:checked+label:before {
        transform: translate(15px, -50%);
    }
</style>
