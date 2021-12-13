<?php
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('/') }}/admintheme/plugins/summernote/summernote-bs4.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('web/home')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{url('logout')}}" class="nav-link">Logout</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" id="myInput">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
      <!--   <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> -->
       <!--  <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside style="background: #11304e" class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{ url('/') }}/admintheme/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            
          </div>
          <div class="info">
            <a href="#" class="d-block">name</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" style="background-color: #121c44;" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button style="background-color:#121c44;" class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2" id="myTable">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

           <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          @if(Auth::user()->role_id ==1)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
     

              <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Roles</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
           
              <li class="nav-item">
                <a href="{{ url('blacklist/index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>BlackList</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->role_id == 1 )
          <li class="nav-item">
            <a href="{{ route('cities.index') }}" class="nav-link">
              <i class="nav-icon fas fa-globe-americas"></i>
              <p>
                Cities
              </p>
            </a>
          </li>
          @endif

          @if(Auth::user()->role_id == 1 )
          <li class="nav-item">
            <a href="{{ url('notification') }}" class="nav-link">
              {{-- <i class="nav-icon fas fa-globe-americas"></i> --}}
              <i class="nav-icon fas fa-bell"></i>
              <p>
                notification
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role_id == 1 )
          <li class="nav-item">
            <a href="{{ route('districts.index') }}" class="nav-link">
              <i class="nav-icon fa fa-map-marker"></i>
              <p>
                Districts
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role_id == 1  ||  Auth::user()->role_id ==3)
          <li class="nav-item">
            <a href="{{ route('orders.index') }}" class="nav-link">
              <i class="nav-icon fas fa-box-open"></i>
              <p>
                Orders
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role_id == 1 ||  Auth::user()->role_id == 2)
           <li class="nav-item">
            <a href="{{ route('reservations.index') }}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Reservationes
              </p>
            </a>
          </li>

          @endif
          @if(Auth::user()->role_id == 1 ||  Auth::user()->role_id ==2)
          <li class="nav-item">
            <a href="{{ route('Appointments.index') }}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Appointments
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role_id == 1 ||  Auth::user()->role_id ==3)
           <li class="nav-item">
            <a href="{{ route('medicines.index') }}" class="nav-link">
              <i class="nav-icon fa fa-medkit"></i>
              <p>
                Medicines
              </p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role_id == 1 ||  Auth::user()->role_id ==2)
          <li class="nav-item">
            <a href="{{ route('clicks.index') }}" class="nav-link">
              <i class="nav-icon fa fa-eye"></i>
              <p>
                Clicks
              </p>
            </a>
          </li>
          @endif
          
          
          

        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('body')

  <footer class="main-footer">
    <strong>Project</strong> footer
    <div class="float-right d-none d-sm-inline-block">

    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('/') }}/admintheme/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('/') }}/admintheme/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('/') }}/admintheme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{ url('/') }}/admintheme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/jszip/jszip.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="{{ url('/') }}/admintheme/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ url('/') }}/admintheme/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ url('/') }}/admintheme/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('/') }}/admintheme/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ url('/') }}/admintheme/plugins/moment/moment.min.js"></script>
<script src="{{ url('/') }}/admintheme/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('/') }}/admintheme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ url('/') }}/admintheme/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('/') }}/admintheme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/admintheme/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/admintheme/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('/') }}/admintheme/dist/js/pages/dashboard.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
