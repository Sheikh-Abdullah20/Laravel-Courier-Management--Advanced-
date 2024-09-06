<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <link rel="shortcut icon" href="{{ asset('assets/imgs/guest-imgs/final-logo.png') }}" type="image/x-icon">
        @yield('css')
        <link href="{{ asset('assets/css/main.css?v=6.0') }}" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <div class="screen-overlay"></div>
        <aside class="navbar-aside" id="offcanvas_aside">
            <div class="aside-top justify-content-between">
                <div>
                 <a href="{{ route('dashboard') }}"> <x-application-logo/></a>
                </div>
                <div>
                    <button class="btn btn-icon btn-aside-minimize"><i class="text-muted material-icons md-menu_open"></i></button>
                </div>
            </div>
            <nav>
                <ul class="menu-aside">
                    @can('view dashboard')
                    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : ''  }}">
                        <a class="menu-link" href="{{ route('dashboard') }}">
                            <i class="icon material-icons md-home"></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    @endcan
                    @can('view agents')
                    <li class="menu-item {{ request()->routeIs('agent.index') ? 'active' : ''  }}">
                        <a class="menu-link" href="{{ route('agent.index') }}">
                            <i class="icon material-icons md-store"></i>
                            <span class="text">Agents</span>
                        </a>
                    </li>
                    @endcan
                   
                    @can('view users')
                    <li class="menu-item {{ request()->routeIs('user.index') ? 'active' : ''  }}">
                        <a class="menu-link" href="{{ route('user.index') }}">
                            <i class="icon material-icons md-person"></i>
                            <span class="text">Users</span>
                        </a>
                    </li>  
                    @endcan

                    @can('view shipments')
                    <li class="menu-item {{ request()->routeIs('shipment.index') ? 'active' : ''  }}">
                        <a class="menu-link" href="{{ route('shipment.index') }}">
                            <i class="icon material-icons md-local_shipping"></i>
                            <span class="text">Shipment</span>
                        </a>
                    </li>
                    @endcan


                    <li class="menu-item {{ request()->routeIs('tracking.index') ? 'active' : ''  }}">
                        <a class="menu-link" href="{{ route('tracking.index') }}">
                            <i class="icon material-icons md-location_searching"></i>
                            <span class="text">Shipment Tracking</span>
                        </a>
                    </li>  
                    @can('view riders')
                    <li class="menu-item {{ request()->routeIs('rider.index') ? 'active' : ''  }}">
                        <a class="menu-link" href="{{ route('rider.index') }}">
                            <i class="icon material-icons md-directions_bike"></i>
                            <span class="text">Riders</span>
                        </a>
                    </li>  
                    @endcan
                </ul>
                <hr>
                <ul class="menu-aside mt-4">
                    @can('view reports')
                    <li class="menu-item {{ request()->routeIs('report.index') ? 'active' : ''  }}">
                        <a class="menu-link" href="{{ route('report.index') }}">
                            <i class="icon material-icons md-bar_chart"></i>
                            <span class="text">Reports</span>
                        </a>
                    </li>  
                    @endcan

                    <li class="menu-item has-submenu">
                        <a class="menu-link" href="#">
                            <i class="icon material-icons md-settings"></i>
                            <span class="text">Settings</span>
                        </a>
                        <div class="submenu">
                            @can('view permissions')
                            <a href="{{ route('permission.index') }}" class="d-flex">
                                <i class="icon material-icons md-lock"></i>
                                <span class="text">Permissions</span>
                            </a>
                            @endcan
                            @can('view roles')
                            <a href="{{ route('role.index') }}" class="d-flex">  <i class="icon material-icons md-vpn_key"></i>
                                <span class="text">Roles</span>
                            </a>
                            @endcan
                            @can('view status')
                            <a href="{{ route('status.index') }}" class="d-flex">
                                <i class="icon material-icons md-check_circle"></i>
                                <span class="text"> Status Creation </span>
                            </a>
                            @endcan
                            
                            <a href="{{ route('profile.edit') }}" class="d-flex">
                                <i class="icon material-icons md-person"></i>
                                <span class="text"> Profile Settings </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="main-wrap">
            <header class="main-header navbar justify-content-end">
                <div class="col-nav">
                    <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>
                    <ul class="nav">           
                        <li class="nav-item">
                            <a class="nav-link btn-icon darkmode" href="javascript::void()"> <i class="material-icons md-nights_stay"></i> </a>
                        </li>           
                        <li class="dropdown nav-item">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> {{ Auth::user()->name }}  ( {{ Auth::user()->roles->pluck('name')->implode('') }} ) </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="material-icons md-perm_identity"></i>Account Settings</a>
                               
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="material-icons md-exit_to_app"></i>Logout</button>
                                </form>
                       
                            </div>
                        </li>
                    </ul>
                    <hr>
                   
                </div>
            </header>
            
          @yield('content')
            <!-- content-main end// -->
        </main>

        
        <script src="{{ asset('assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/select2.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/chart.js') }}"></script>
        <script src="{{ asset('assets/js/main.js?v=6.0') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/vendors/alert.js') }}"></script>
        <script src="{{ asset('assets/js/vendors/color-modes.js') }}"></script>
        @yield('scripts')
    </body>
</html>
