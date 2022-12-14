<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter input[type="search"], .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
            color: white;
        }
      </style>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('sb-admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('sb-admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('sb-admin') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
</head>
<body class="dark-mode">
    @yield('content')
    
    <script src="{{ asset('sb-admin')}}/plugins/jquery/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
          $('#myTable').DataTable();
      });
    </script>
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
      @if($message = Session::get('error'))
        Swal.fire({
          icon: 'error',
          title: 'App Said : ',
          text: '{{$message}}',
        })
      @endif
    </script>
    
</body>
</html>