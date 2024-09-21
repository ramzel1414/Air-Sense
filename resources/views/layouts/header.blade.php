  <!-- Styles for logo-->
  <style>
    .custom-radius {
      border-radius: 50%;
      width: 50px;
      height: 50px;
    }

</style>


{{-- fontawesome para sa darkmode--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


<div class="user-header d-flex justify-content-between align-items-center py-2 px-3">

    <div class="right d-flex align-items-center">
      <a href="{{route('welcome')}}" class="d-flex align-items-center text-gray-600 hover:text-gray-900 focus:outline-gray-500 p-1 focus:outline focus:outline-2 focus:rounded-sm">
        <img src="{{ asset('airsense2.png') }}" alt="Air Sense Logo" class="custom-radius">
      </a>
      <ul class="nav">
        <li class="nav-item">
          <a href="{{route('welcome')}}" class="p-1 mx-2 nav-link">
            Home
          </a>    
        </li>
        <li>
          <a href="{{route('about')}}" class="p-1 mx-2 nav-link">
            About
          </a>        
        </li>
        <li>
          <a href="{{route('location')}}" class="p-1 mx-2 nav-link">
            Location
          </a>        
        </li>
        <li class="nav-item"  style="color: #0c1427; hover: transparent;">
          <div id="toggle-btn" class="fas fa-sun mx-2"></div>
        </li>
      </ul>
    </div>


    <div class="left">

      @if (Route::has('login'))
      <div>
        @auth
          <a href="{{ route('admin.location')}}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-500">Back</a>
        @else
          <a href="{{ route('login') }}" class="p-1 nav-item">Login</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="p-1 m-l nav-item">Register</a>
          @endif
        @endauth
      </div>
      @endif
    </div>
      
  </div>

  

  <script>
    
    //darkmode part start=====>
    let body = document.body;           //html's body element
    let toggleBtn = document.querySelector('#toggle-btn');  //selecting the sun icon
    let darkMode = localStorage.getItem('dark-mode');

    const enableDarkMode = () => {
        toggleBtn.classList.replace('fa-sun', 'fa-moon');
        body.classList.add('dark');
        localStorage.setItem('dark-mode', 'enabled');
    }

    const disableDarkMode = () => {
        toggleBtn.classList.replace('fa-moon', 'fa-sun');
        body.classList.remove('dark');
        localStorage.setItem('dark-mode', 'disabled');
    }

    if(darkMode === 'enabled') {
        enableDarkMode();
    }

    toggleBtn.onclick = (e) => {
        let darkMode = localStorage.getItem('dark-mode');
        if(darkMode === 'disabled') {
            enableDarkMode();
        } else {
            disableDarkMode();
        }
    }
    //end of darkmode part=====>

</script>