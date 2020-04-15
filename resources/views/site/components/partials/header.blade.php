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

</head>
<body class="cnt-home">


<header class="header-style-1">
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="icon fa fa-user"></i>My Account</a></li>
                        <li><a href="#"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                        <li><a href="#"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                        <li><a href="#"><i class="icon fa fa-check"></i>Checkout</a></li>
                        <li><a href="#"><i class="icon fa fa-lock"></i>Login</a></li>
                    </ul>
                </div><!-- /.cnt-account -->

                <div class="cnt-block">
                    <ul class="list-unstyled list-inline">
                        <li class="dropdown dropdown-small">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">USD </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">INR</a></li>
                                <li><a href="#">GBP</a></li>
                            </ul>
                        </li>

                        <li class="dropdown dropdown-small">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value">English </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">German</a></li>
                            </ul>
                        </li>
                    </ul><!-- /.list-unstyled -->
                </div><!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div><!-- /.header-top-inner -->
        </div><!-- /.container -->
    </div><!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo">
                        <a href="{{ route('site.index') }}">
                            <img src="{{ asset('assets/site/images/logo-2.png') }}" alt="">

                        </a>
                    </div><!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->				</div><!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form>
                            <div class="control-group">
                                <input class="search-field" placeholder="Search here..." />

                                <a class="search-button" href="#" ></a>

                            </div>
                        </form>
                    </div><!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->				</div><!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count"><span class="count">2</span></div>
                                <div class="total-price-basket">
                                    <span class="lbl">cart -</span>
                                    <span class="total-price">
						<span class="sign">$</span><span class="value">600.00</span>
					</span>
                                </div>


                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <div class="cart-item product-summary">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="image">
                                                <a href="detail.html"><img src="{{ asset('assets/site/images/cart.jpg') }}" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">

                                            <h3 class="name"><a href="index8a95.html?page-detail">Simple Product</a></h3>
                                            <div class="price">$600.00</div>
                                        </div>
                                        <div class="col-xs-1 action">
                                            <a href="#"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div><!-- /.cart-item -->
                                <div class="clearfix"></div>
                                <hr>

                                <div class="clearfix cart-total">
                                    <div class="pull-right">

                                        <span class="text">Sub Total :</span><span class='price'>$600.00</span>

                                    </div>
                                    <div class="clearfix"></div>

                                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a>
                                </div><!-- /.cart-total-->


                            </li>
                        </ul><!-- /.dropdown-menu-->
                    </div><!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->				</div><!-- /.top-cart-row -->
            </div><!-- /.row -->

        </div><!-- /.container -->

    </div><!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw">
                                    <a href="{{ route('site.index') }}">Home</a>

                                </li>

                                <li class="dropdown yamm mega-menu">
                                    <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">Clothing
                                        <span class="menu-label hot-menu hidden-xs">hot</span>
                                    </a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">

                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                        <h2 class="title">Men</h2>
                                                        <ul class="links">
                                                            <li><a href="#">Dresses</a></li>

                                                        </ul>
                                                    </div><!-- /.col -->

                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image">
                                                        <img class="img-responsive" src="{{ asset('assets/site/images/banners/top-menu-banner.jpg') }}" alt="">






                                                    </div><!-- /.yamm-content -->
                                                </div>
                                            </div>

                                        </li>
                                    </ul>

                                </li>

                                <li class="dropdown  navbar-right special-menu">
                                    <a href="#">Todays offer</a>
                                </li>


                            </ul><!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div><!-- /.nav-outer -->
                    </div><!-- /.navbar-collapse -->


                </div><!-- /.nav-bg-class -->
            </div><!-- /.navbar-default -->
        </div><!-- /.container-class -->

    </div><!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

</header>
