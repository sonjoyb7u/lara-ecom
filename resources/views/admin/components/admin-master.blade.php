<!doctype html>
<html lang="en" class="fixed accounts sign-in left-sidebar-top">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Lara-Ecomm | Admin Panel ')</title>

    <link rel="icon" sizes="250x250" href="{{ asset('assets/site/images/logo-2.png') }}">
    <!--load progress bar-->
    <script src="{{ asset('assets/admin/vendor/pace/pace.min.js') }}"></script>
    <link href="{{ asset('assets/admin/vendor/pace/pace-theme-minimal.css') }}" rel="stylesheet" />
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/animate.css/animate.css') }}">
    <!--DATA table-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/data-table/media/css/dataTables.bootstrap.min.css') }}">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--Notification msj-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/toastr/toastr.min.css') }}">
    <!--Magnific popup-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/magnific-popup/magnific-popup.css') }}">
    <!-- Select with searching & tagging -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/select2/css/select2-bootstrap.min.css') }}">
    <!--Date picker-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap_date-picker/css/bootstrap-datepicker3.min.css') }}">
    <!--Time picker-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap_time-picker/css/timepicker.css') }}">
    <!--Color picker-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap_color-picker/css/bootstrap-colorpicker.min.css') }}">
    <!--STATUS-LOADER css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('assets/admin/stylesheets/css/status-loader.css') }}">
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('assets/admin/stylesheets/css/style.css') }}">
    <!--DATETIME-PICKER css-->
    <link rel='stylesheet' href='{{ asset('assets/admin/vendor/date_time-picker/css/bootstrap-datetimepicker.min.css') }}'>
    <!--TOGGLE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') }}">
    <!--SWEETALERT css-->
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/sweetalert/sweetalert.css') }}">
    <!--SLIDER-POPUP IMAGE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="{{ asset('assets/admin/stylesheets/css/slider-popup.css') }}">

    @stack('css')

</head>

<body>

<div class="wrap">
        <!-- page HEADER -->
        <!-- ========================================================= -->
        @yield('header')

        <!-- page BODY -->
        <div class="page-body">
            <!-- LEFT SIDEBAR -->
            @yield('left-sidebar')
            <!-- ========================================================= -->

            <!-- CONTENT -->
            @yield('content')

            <!-- SPINNER 13   -->
            <div class="loader-overlay">
                <div class="status-loader">
                    <div class="ml-loader">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>

            <!--scroll to top-->
            <a href="#" class="scroll-to-top"><i class="fa fa-angle-double-up"></i></a>

            <div class="animated slideInDown">

            <!-- LOGIN FORM -->
            @yield('login-form')

            @yield('register-form')

            </div>

            <!-- ========================================================= -->

            <!-- RIGHT SIDEBAR -->
            {{--If Right Sidebar is required to include here ...--}}
            {{-- @yield('right-sidebar') --}}
            <!-- ========================================================= -->

        </div>
        <!-- ========================================================= -->

</div>

    {{--<div class="wrap">--}}
        {{--<!-- page BODY -->--}}
        {{--<!-- ========================================================= -->--}}

    {{--</div>--}}



<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="{{ asset('assets/admin/vendor/jquery/jquery-1.12.3.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/nano-scroller/nano-scroller.js') }}"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="{{ asset('assets/admin/javascripts/template-script.min.js') }}"></script>
<script src="{{ asset('assets/admin/javascripts/template-init.min.js') }}"></script>
<!--TOGGLE js-->
<script src="{{ asset('assets/admin/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
<!--DATA table-->
<script src="{{ asset('assets/admin/vendor/data-table/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/data-table/media/js/dataTables.bootstrap.min.js') }}"></script>
<!--DATA Table Examples-->
<script src="{{ asset('assets/admin/javascripts/examples/tables/data-tables.js') }}"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
<!--Notification msj-->
<script src="{{ asset('assets/admin/vendor/toastr/toastr.min.js') }}"></script>
<!--morris chart-->
<script src="{{ asset('assets/admin/vendor/chart-js/chart.min.js') }}"></script>
<!--Gallery with Magnific popup-->
<script src="{{ asset('assets/admin/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<!--Examples-->
{{-- <script src="{{ asset('assets/admin/javascripts/examples/ui-elements/lightbox.js') }}"></script> --}}
<script src="{{ asset('assets/admin/javascripts/examples/dashboard.js') }}"></script>
<script src="{{ asset('assets/admin/javascripts/custom/main.js') }}"></script>
<!--DATETIME-PICKER scripts-->
<script src='{{ asset('assets/admin/vendor/date_time-picker/js/moment-with-locales.min.js') }}'></script>
<script src='{{ asset('assets/admin/vendor/date_time-picker/js/bootstrap-datetimepicker.min.js') }}'></script>
<!--Select with searching & tagging-->
<script src="{{ asset('assets/admin/vendor/select2/js/select2.min.js') }}"></script>
<!--Date picker-->
<script src="{{ asset('assets/admin/vendor/bootstrap_date-picker/js/bootstrap-datepicker.min.js') }}"></script>
<!--Time picker-->
<script src="{{ asset('assets/admin/vendor/bootstrap_time-picker/js/bootstrap-timepicker.js') }}"></script>
<!--Color picker-->
<script src="{{ asset('assets/admin/vendor/bootstrap_color-picker/js/bootstrap-colorpicker.min.js') }}"></script>
<!--sweetalert-->
<script src="{{ asset('assets/admin/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/admin/javascripts/examples/ui-elements/alerts.js') }}"></script>

{{-- <script src="{{ asset('assets/admin/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/ckeditor/samples/js/sample.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/admin/vendor/ckeditor/samples/css/samples.css') }}"> --}}
{{-- <script>
    // CK-EDITOR js...
    initSample();
</script> --}}

@stack('js')

</body>
</html>

