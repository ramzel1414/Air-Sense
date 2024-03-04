

@extends('user.user_dashboard')
@section('content')



<div class="page-content">

    <h3 class="mb-4">Location</h3>
      
    <!-- wrapper start -->
    <div class="row d-flex justify-content-evenly">
      
        <div class="col-12 col-sm-5 mb-4 text-center card p-2 rounded-2">
            <p class="mb-2">Let</p>
            <img class="img-fluid rounded-3" src="{{ asset('../assets/images/location.png') }}" alt="">
        </div>
        
        <div class="col-12 col-sm-5 mb-4 text-center card p-2 rounded-2">
            <p class="mb-2">The</p>
            <img class="img-fluid rounded-3" src="{{ asset('../assets/images/location.png') }}" alt="">
        </div>
        
        <div class="col-12 col-sm-5 mb-4 text-center card p-2 rounded-2">
            <p class="mb-2">Guy</p>
            <img class="img-fluid rounded-3" src="{{ asset('../assets/images/location.png') }}" alt="">
        </div>
        
        <div class="col-12 col-sm-5 mb-4 text-center card p-2 rounded-2">
            <p class="mb-2 ">Cook</p>
            <img class="img-fluid rounded-3" src="{{ asset('../assets/images/location.png') }}" alt="">
        </div>
        
    </div>


    <!-- wrapper end -->

</div>

@endsection




