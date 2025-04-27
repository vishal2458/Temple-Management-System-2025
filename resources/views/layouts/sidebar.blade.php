{{-- <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Ram</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>

        <li class="menu-header">Temples</li>
        <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-gopuram"></i> <span>Temples</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('admin.temples') }}">Temples List</a></li>
                <li><a class="nav-link" href="{{ route('admin.addtemple') }}">Add Temple</a></li>
            </ul>
        </li>

        <li class="menu-header">Bookings</li>
        <li class="dropdown">
          <a href="{{ route('admin.bookings.index') }}" class="nav-link"><i class="fas fa-om"></i><span>Darshans</span></a>
        </li>
        <li class="menu-header">Donations</li>
        <li class="dropdown">
          <a href="{{ route('admin.donations.index') }}" class="nav-link"><i class="fas fa-hand-holding-usd"></i><span>Donations</span></a>
        </li>



        <li class="menu-header">Festivals</li>
        <li class="dropdown">
          <a href="{{ route('admin.festivals.index') }}" class="nav-link"><i class="fas fa-people-carry"></i><span>Festivals</span></a>
        </li>
        <li class="menu-header">Users</li>
        <li class="dropdown">
          <a href="{{ route('admin.users.index') }}" class="nav-link"><i class="fas fa-people-carry"></i><span>View users</span></a>
        </li>














      </ul>

  </div> --}}
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
            <li class="dropdown {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Temples</li>
            <li class="dropdown {{ Request::routeIs('admin.temples', 'admin.addtemple') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-gopuram"></i> <span>Temples</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::routeIs('admin.temples') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.temples') }}">Temples List</a>
                    </li>
                    <li class="{{ Request::routeIs('admin.addtemple') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.addtemple') }}">Add Temple</a>
                    </li>
                </ul>
            </li>

            <li class="menu-header">Bookings</li>
            <li class="dropdown {{ Request::routeIs('admin.bookings.index') ? 'active' : '' }}">
                <a href="{{ route('admin.bookings.index') }}" class="nav-link">
                    <i class="fas fa-om"></i><span>Darshans</span>
                </a>
            </li>

            <li class="menu-header">Donations</li>
            <li class="dropdown {{ Request::routeIs('admin.donations.index') ? 'active' : '' }}">
                <a href="{{ route('admin.donations.index') }}" class="nav-link">
                    <i class="fas fa-hand-holding-usd"></i><span>Donations</span>
                </a>
            </li>

            <li class="menu-header">Festivals</li>
            <li class="dropdown {{ Request::routeIs('admin.festivals.index') ? 'active' : '' }}">
                <a href="{{ route('admin.festivals.index') }}" class="nav-link">
                    <i class="fas fa-people-carry"></i><span>Festivals</span>
                </a>
            </li>

            <li class="menu-header">Users</li>
            <li class="dropdown {{ Request::routeIs('admin.users.index') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}" class="nav-link">
                    <i class="fas fa-people-carry"></i><span>View users</span>
                </a>
            </li>
            <li class="menu-header">Inquiries</li>
            <li class="dropdown {{ Request::routeIs('admin.inquiries') ? 'active' : '' }}">
                <a href="{{ route('admin.inquiries') }}" class="nav-link">
                    <i class="fas fa-envelope-open-text"></i><span>Inquiries</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
