
  <nav class="sidebar">
      <div class="sidebar-header">
        <a href="{{ route ('user.dashboard') }}" class="sidebar-brand d-flex">
          <img class="airsense" src="{{ asset('../assets/images/airsense.png') }}" alt="">
          Air<span>Sense</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Menu</li>
          <li class="nav-item">
            <a href="{{ route ('user.dashboard') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>

          
          <li class="nav-item">
            <a href="{{ route ('user.location') }}" class="nav-link">
              <i class="link-icon" data-feather="map-pin"></i>
              <span class="link-title">Location</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('user.settings') }}" class="nav-link">
              <i class="link-icon" data-feather="settings"></i>
              <span class="link-title">Settings</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('user.logout')}}" class="nav-link">
              <i class="link-icon" data-feather="log-out"></i>
              <span class="link-title">Logout</span>
            </a>
          </li>

        
        </ul>
    </div>
    </nav>