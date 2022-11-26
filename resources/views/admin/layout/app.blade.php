<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
      .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter input[type="search"], .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
          color: white;
      }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('sb-admin')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('sb-admin')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('sb-admin')}}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
    
      <!-- Preloader -->
      {{-- <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('sb-admin')}}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div>
     --}}
      <!-- Navbar -->
      @include('admin.layout.navbar')
      <!-- /.navbar -->
    
      <!-- Main Sidebar Container -->
      @include('admin.layout.sidebar')
    
      <!-- Content Wrapper. Contains page content -->
      @yield('content')
      <!-- /.content-wrapper -->
    
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    
      <!-- Main Footer -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer>
    </div>
    <!-- ./wrapper -->
    
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('sb-admin')}}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('sb-admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('sb-admin')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('sb-admin')}}/dist/js/adminlte.js"></script>
    
    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('sb-admin')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="{{ asset('sb-admin')}}/plugins/raphael/raphael.min.js"></script>
    <script src="{{ asset('sb-admin')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="{{ asset('sb-admin')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('sb-admin')}}/plugins/chart.js/Chart.min.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      });
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      @if($message = Session::get('success'))
        Swal.fire({
          icon: 'success',
          title: 'App Said : ',
          text: '{{$message}}',
        })
      @endif
      @if($message = Session::get('update'))
        Swal.fire({
          icon: 'warning',
          title: 'App Said : ',
          text: '{{$message}}',
        })
      @endif
      @if($message = Session::get('delete'))
        Swal.fire({
          icon: 'error',
          title: 'App Said : ',
          text: '{{$message}}',
        })
      @endif
    </script>
    
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('sb-admin')}}/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('sb-admin')}}/dist/js/pages/dashboard2.js"></script> --}}
</body>
</html>