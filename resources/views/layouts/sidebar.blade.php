<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('Reservation', 'Reservation') }} - @yield('title')</title>
    <!-- plugins:css -->
    
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    {{-- <!-- <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --> --}}
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
    <!-- endinject -->
    <link href={{ asset('images/logo-r.jpg') }} rel="icon">
    <link href={{ asset('assets/img/apple-touch-icon.png') }} rel="apple-touch-icon">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  </head>
  <body>
    @php
        $notifications = App\Models\Reservation::where('status','En cours de validation')->get();
    @endphp
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo mx-3 me-5 my-3" href="index.html"><img src="{{ asset('images/logo-r.jpg') }}" style="width: 140px;"  class="me-2" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
            </button>
            <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="icon-bell mx-0" style="color: #000;"></i>
                <span class="count" style="color: #FFC100; background:none !important;left:50% ! important;top:-35% !important">{{ $notifications->count() }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header"><span class="count" style="color: #FFC100">{{ $notifications->count() }}</span> Notifications</p>
                @foreach ($notifications as $notification)
                    <a href="/admin/reservations" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                        <div class="preview-icon " style="background: #FFC100">
                            <i class="ti-info-alt mx-0" ></i>
                        </div>
                        </div>
                        <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">{{ $notification->user->name }}</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">{{ $notification->created_at }}</p>
                        </div>
                    </a>
                @endforeach
                </div>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                <img src="{{ asset('dashboard/assets/images/faces/face28.jpg')}}" alt="profile" />
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="ti-settings text-primary"></i> Profile </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        this.closest('form').submit();">
                            <i class="ti-power-off text-primary" ></i> Se deconnecter </a>
                    </form>
                </div>
            </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reservations') }}">
                    <i class="icon-layout menu-icon mdi mdi-book"></i>
                    <span class="menu-title">Les Reservations</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.espaces') }}">
                    <i class="icon-layout menu-icon mdi mdi-domain"></i>
                    <span class="menu-title">Les Salles</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.options') }}">
                    <i class="icon-layout menu-icon mdi mdi-tune"></i>
                    <span class="menu-title">Les Options</span>
                </a>
                </li>
            </ul>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            {{ $header }}
        @endisset

        <!-- Page Content -->
        <main class=" main-panel content-wrapper">
                {{ $slot }}
        </main>
        
        <div id="preloader"></div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('dashboard/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('dashboard/assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{ asset('dashboard/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    {{-- <!-- <script src="{{ asset('dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script> --> --}}
    <script src="{{ asset('dashboard/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/dataTables.select.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('dashboard/assets/js/off-canvas.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/template.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/settings.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('dashboard/assets/js/jquery.cookie.js')}}" type="text/javascript"></script>
    <script src="{{ asset('dashboard/assets/js/dashboard.js')}}"></script>
    {{-- <!-- <script src="{{ asset('dashboard/js/Chart.roundedBarCharts.js')}}"></script> --> --}}
    <!-- End custom js for this page-->
  </body>
</html>

