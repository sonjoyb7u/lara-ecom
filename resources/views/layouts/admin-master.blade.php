<!doctype html>
<html lang="en" class="fixed left-sidebar-top">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title', 'Lara-Ecom | Admin Dashboard ')</title>
    <!--load progress bar-->
    <script src="{{ asset('assets/admin/vendor/pace/pace.min.js') }}"></script>
    <link href="{{ asset('assets/admin/vendor/pace/pace-theme-minimal.css') }}" rel="stylesheet" />

    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/animate.css/animate.css') }}">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--Notification msj-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/toastr/toastr.min.css') }}">
    <!--Magnific popup-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/magnific-popup/magnific-popup.css') }}">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('assets/admin/stylesheets/css/style.css') }}">


</head>

<body>

<div class="wrap">
    <!-- page HEADER -->
    <!-- ========================================================= -->
    @includeIf('admin.components.partials.header')
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body">
        <!-- LEFT SIDEBAR -->
        <!-- ========================================================= -->
        @includeIf('admin.components.partials.left-sidebar')
        <!-- CONTENT -->
        <!-- ========================================================= -->
        @yield('content')
        <!-- RIGHT SIDEBAR -->
        <!-- ========================================================= -->

        <!--scroll to top-->
        <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="{{ asset('assets/admin/vendor/jquery/jquery-1.12.3.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/nano-scroller/nano-scroller.js') }}"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="{{ asset('assets/admin/javascripts/template-script.min.js') }}"></script>
<script src="{{ asset('assets/admin/javascripts/template-init.min.js') }}"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
<!--Notification msj-->
<script src="{{ asset('assets/admin/vendor/toastr/toastr.min.js') }}"></script>
<!--morris chart-->
<script src="{{ asset('assets/admin/vendor/chart-js/chart.min.js') }}"></script>
<!--Gallery with Magnific popup-->
<script src="{{ asset('assets/admin/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<!--Examples-->
<script src="{{ asset('assets/admin/javascripts/examples/dashboard.js') }}"></script>

</body>
</html>

