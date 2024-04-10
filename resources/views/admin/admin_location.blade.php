

@extends('admin.admin_dashboard')
@section('content')



<div class="page-content">

    <h3 class="mb-4">Location</h3>
      
    <!-- wrapper start -->
    <div class="row d-flex justify-content-evenly">
      
        {{-- naa sa resources/views/location.blade.php --}}
        @include('location')

        
    </div>


    <!-- wrapper end -->

</div>

@endsection




