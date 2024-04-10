
  <nav class="sidebar">
      <div class="sidebar-header">
        <a href="{{ route ('admin.dashboard') }}" class="sidebar-brand d-flex">
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
            <a href="{{ route ('admin.dashboard') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route ('admin.location') }}" class="nav-link">
              <i class="link-icon" data-feather="map-pin"></i>
              <span class="link-title">Location</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('admin.about') }}" class="nav-link">
              <i class="link-icon" data-feather="help-circle"></i>
              <span class="link-title">About</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route ('admin.logout')}}" class="nav-link">
              <i class="link-icon" data-feather="log-out"></i>
              <span class="link-title">Logout</span>
            </a>
          </li>

        
        </ul>
    </div>
    </nav>