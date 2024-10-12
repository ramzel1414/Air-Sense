<!-- Settings Modals -->

{{-- Modal for editing a signatory --}}
@foreach ($signatories as $signatory)
    <div class="modal fade" id="signatory{{ $signatory->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Signatory Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.signatoriesUpdate', $signatory->id) }}" method="POST">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Professional Title -->
                        <div class="mb-3">
                            <label for="professionalTitle{{ $signatory->id }}" class="form-label">Professional Title</label>
                            <select id="professionalTitle{{ $signatory->id }}" name="profTitles" class="form-select">
                                <option value="" {{ $signatory->profTitles === '' ? 'selected' : '' }}>N/A</option>
                                <option value="ENGR." {{ $signatory->profTitles === 'ENGR.' ? 'selected' : '' }}>ENGR.</option>
                                <option value="DOC." {{ $signatory->profTitles === 'DOC.' ? 'selected' : '' }}>DOC.</option>
                                <option value="PROF." {{ $signatory->profTitles === 'PROF.' ? 'selected' : '' }}>PROF.</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="firstname{{ $signatory->id }}" class="form-label">Firstname</label>
                            <input type="text" id="firstname{{ $signatory->id }}" name="firstName" class="form-control"
                                value="{{ $signatory->firstName }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="middlename{{ $signatory->id }}" class="form-label">Middlename</label>
                            <input type="text" id="middlename{{ $signatory->id }}" name="middleName"
                                class="form-control" value="{{ $signatory->middleName }}">
                        </div>
                        <div class="mb-3">
                            <label for="lastname{{ $signatory->id }}" class="form-label">Lastname</label>
                            <input type="text" id="lastname{{ $signatory->id }}" name="lastName" class="form-control"
                                value="{{ $signatory->lastName }}" required>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="position{{ $signatory->id }}" class="form-label">Position</label>
                            <input type="text" id="position{{ $signatory->id }}" name="position" class="form-control"
                                value="{{ $signatory->position }}" required>
                        </div> --}}
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endforeach

