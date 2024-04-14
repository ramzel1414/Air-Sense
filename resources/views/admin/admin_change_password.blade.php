@extends('admin.admin_dashboard')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<div class="page-content">

    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
        <div class="card rounded">
          <div class="card-body">

            <div class="mb-2">
              <!-- Image row -->
              <div class="d-flex align-items-center justify-content-center">
                <img class="wd-100 rounded-circle" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('/upload/no_image.png')}}" alt="profile">
              </div>
            </div>
            
            <div class="mb-2">
              <!-- Name row -->
              <div class="d-flex align-items-center justify-content-center">
                <span class="h4 text-light capitalize-first text-center">{{ $profileData->name }}</span>
              </div>
            </div>
            
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
              <p class="text-muted capitalize-first">{{ $profileData->name }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
              <p class="text-muted">{{ $profileData->phone }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
              <p class="text-muted">{{ $profileData->email }}</p>
            </div>
            <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
              <p class="text-muted">{{ $profileData->address }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- right wrapper end -->
      <div class="col-md-8 col-xl-8 right-wrapper">
        <div class="card rounded">
          <div class="card-body">
            <h6 class="card-title">Admin Change Password</h6>
            <form class="forms-sample" method="POST" action="{{ route('admin.update.password')}}">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputUsername1" class="form-label">Old Password</label>
                    <input type="password" class="form-control @error('old_password') is-invalid @enderror" autocomplete="off" name="old_password" id="old_password">
                    @error('old_password')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputUsername1" class="form-label">New Password</label>
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" autocomplete="off" name="new_password" id="new_password">
                    @error('new_password')
                        <span class="text-danger">{{ $message }} </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputUsername1" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" autocomplete="off" name="new_password_confirmation" id="new_password_confirmation">
                </div>

                <button type="submit" class="btn btn-primary me-2">Save Password</button>
            </form>

          </div>
        </div>
      </div>
    </div>
</div>


@endsection