@extends('admin.admin_dashboard')
@section('content')
@include('admin.modals.modal-settings')

    <div class="page-content">

        <h3 class="mb-4">General Settings</h3>

        <div class="row">

            <!-- Display Flash Messages -->
            <div class="col-2"></div>
           
            <div class="col-8">
                <div class="row flex-grow-1">
                    <div class="col-11 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                @foreach ($updateLogos as $updateLogo)
                                <div class="mb-3">
                                    <h6 class="card-title">{{ $updateLogo->id == 1 ? 'Website Logo' : 'Department Logo' }}</h6>
                                    <form class="forms-sample" method="POST" action="{{ route('admin.update.logo', $updateLogo->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $updateLogo->id }}">
                                        <input id="inputLogo{{ $updateLogo->id }}" type="file" class="form-control" autocomplete="off" name="photo" accept="image/*">
                                        <div class="mb-3">
                                        <br>
                                         <img id="previewLogo{{ $updateLogo->id }}" class="wd-80 rounded-circle" src="{{ (!empty($updateLogo->logo)) ? url('upload/logo/' . $updateLogo->logo) : url('/upload/logo/no_image.png') }}" alt="profile">

                                        {{-- <img id="previewLogo" class="wd-80 rounded-circle" src="{{ (!empty($logo->logo)) ? url('upload/logo/'.$logo->logo) : url('/upload/logo/no_image.png')}}" alt="profile"> --}}
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Logo</button>
                                    </form>
                                </div>
                                @endforeach
                                <hr>
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
            <div class="col-2"></div>

            <!-- right wrapper end -->
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {

        //settings page preview images
        document.getElementById('inputLogo1').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewLogo1').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        //settings page preview images
        document.getElementById('inputLogo2').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewLogo2').src = e.target.result;
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
