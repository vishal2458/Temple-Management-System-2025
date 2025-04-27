<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
          <a href="{{ route('home') }}">Ram</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
          <a href="{{ route('home') }}">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="dropdown {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
              <a href="{{ route('user.dashboard') }}" class="nav-link">
                  <i class="fas fa-fire"></i><span>Dashboard</span>
              </a>
          </li>

          <li class="menu-header">Temples</li>
          <li class="dropdown {{ request()->routeIs('user.temples') ? 'active' : '' }}">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                  <i class="fas fa-gopuram"></i> <span>Temples</span>
              </a>
              <ul class="dropdown-menu">
                  <li class="{{ request()->routeIs('user.temples') ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('user.temples') }}">Temples List</a>
                  </li>
              </ul>
          </li>

          <li class="menu-header">My Darshans</li>
          <li class="dropdown {{ request()->routeIs('user.bookings') ? 'active' : '' }}">
              <a href="{{ route('user.bookings') }}" class="nav-link">
                  <i class="fas fa-om"></i><span>My Darshans</span>
              </a>
          </li>

          <li class="menu-header">My Donations</li>
          <li class="dropdown {{ request()->routeIs('user.donations') ? 'active' : '' }}">
              <a href="{{ route('user.donations') }}" class="nav-link">
                  <i class="fas fa-hand-holding-usd"></i><span>My Donations</span>
              </a>
          </li>
      </ul>
  </aside>
</div>
