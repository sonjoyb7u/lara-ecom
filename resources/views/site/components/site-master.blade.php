<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Lara-Ecom | Home')</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap.min.css') }}">
    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap-select.min.css') }}">
    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/font-awesome.css') }}">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    @stack('css')

</head>
<body class="cnt-home">

@includeIf('site.components.partials.header')

<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">

        <div class="row {{ request()->is('product-detail/*') ? 'single-product' : '' }}">
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">

                @yield('left-sidebar')

                <div class="home-banner">
                    <img src="{{ asset('assets/site/images/banners/LHS-banner.jpg') }}" alt="Image">
                </div>
            </div>
            <!-- /.sidemenu-holder -->


            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                @yield('content')
            </div>
            <!-- /.homebanner-holder -->

        </div><!-- /.row -->

            @includeIf('site.components.partials.brands')
            <!-- /.logo-slider -->

    </div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->


@includeIf('site.components.partials.footer')


    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('assets/site/js/jquery-1.11.1.min.js') }}"></script>

    <script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/site/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/site/js/echo.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/site/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/scripts.js') }}"></script>

    @stack('js')

</body>
</html>




