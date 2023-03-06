<!DOCTYPE html>
<html>
<head>
    @include('partial.head')
    @include('partial.style')
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">

    <!-- Navbar -->
    @include('partial.navbar')

    <!-- Main Sidebar Container -->
    @include('sidebar.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
            @yield ('contentheader')
        <!-- /.content-header -->

        <!-- Main content -->
            @yield ('content')
        <!-- /.content -->
    </div>


    <!-- Footer-->
    @include('partial.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('partial.scripts')
</body>
</html>
