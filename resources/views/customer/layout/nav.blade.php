<div class="navbar-bg" style="background-color: #363636;"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fa fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right btn-block justify-content-end">
    <li class="nav-link" style="margin-right: 20px;">
        <a href="{{ route('home') }}" class="btn btn-warning">Home Page</a>
    </li>
    <li class="dropdown position-relative" style="position: relative;">
        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="position: relative; padding-right: 20px;">
            <div class="d-sm-none d-lg-inline-block">{{ Auth::guard('customer')->user()->name }}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right" 
             style="right: 15px; left: auto; min-width: 150px; max-width: 220px; overflow-wrap: break-word; overflow: hidden; z-index: 1050; position: absolute; top: 100%; transform: translateX(-10%);">
            <a href="{{ route('customer_profile') }}" class="dropdown-item has-icon" style="white-space: nowrap; padding: 10px;">
                <i class="fa fa-user"></i> Edit Profile
            </a>
            <a href="{{ route('customer_logout') }}" class="dropdown-item has-icon text-danger" style="white-space: nowrap; padding: 10px;">
                <i class="fa fa-sign-out"></i> Logout
            </a>
        </div>
    </li>
</ul>

        </nav>
