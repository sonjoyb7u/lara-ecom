
<header class="header-style-1">
    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                        <li><a href="{{ route('site.order.track') }}"><i class="icon fa fa-code"></i>Track Order</a></li>
                        @php
                            $customer_id = Session::get('cuStOmArId');
                            $customer_name = Session::get('cuStOmArNaMe');
                        @endphp
                        @if(!empty($customer_id && Cart::getTotalQuantity()))
                        <li><a href="{{ route('site.checkout.customer-shipping') }}"><i class="icon fa fa-check"></i>Checkout</a></li>
                        @endif
                        @if(Cart::getTotalQuantity() > 0)
                        <li class="dropdown dropdown-small">
                            <a href="{{ route('site.cart.show') }}"><i class="icon fa fa-shopping-cart"></i>My Cart</a>
{{--                            @if(!$customer_id)--}}
{{--                            <ul class="dropdown-menu">--}}
{{--                                <li><p class="text-center text-danger">Please Login!</p></li>--}}
{{--                            </ul>--}}
{{--                            @endif--}}
                        </li>
                        @endif
                        @if(!empty($customer_id))
                        <li class="dropdown dropdown-small">
                            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><span class="value"><i class="fa fa-user"></i>&nbsp; {{ $customer_name }} </span><b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('site.customer.account', base64_encode($customer_id)) }}" style="color: #000;"><i class="fa fa-user"></i>&nbsp; My Account</a></li>
                                <div class="divider"></div>
                                <li>
                                    <form id="customer-logout-form" action="{{ request()->is('/') ? route('site.customer.logout') : route('site.checkout.logout') }}" method="POST" style="display: none;">
                                        @csrf

                                    </form>
                                    <a href="{{ route('site.customer.logout') }}" onclick="event.preventDefault(); document.getElementById('customer-logout-form').submit();" style="color: #000;">
                                        <i class="fa fa-sign-out"></i>&nbsp;Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
{{--                        <li class="dropdown">--}}
{{--                            <a href="#" class="dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="icon fa fa-user"></i>{{ Session::get('customer_name') }}<span class="caret"></span>--}}
{{--                            </a>--}}
{{--                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="padding: 15px;">--}}
{{--                                <a href="#" style="color: #000; display: block; margin-bottom: 10px;"><i class="fa fa-user"></i>&nbsp;Profile--}}
{{--                                </a>--}}
{{--                                <div class="divider"></div>--}}
{{--                                <a href="{{ route('site.customer.logout') }}" onclick="event.preventDefault(); document.getElementById('customer-logout-form').submit();" style="color: #000;">--}}
{{--                                    <i class="fa fa-sign-out"></i>&nbsp;Logout--}}
{{--                                </a>--}}
{{--                                <form id="customer-logout-form" action="{{ route('site.customer.logout') }}" method="POST" style="display: none;">--}}
{{--                                    @csrf--}}

{{--                                </form>--}}

{{--                            </div>--}}
{{--                        </li>--}}

                        @else
                        <li><a href="{{ route('site.customer.login') }}"><i class="icon fa fa-lock"></i>Login</a></li>
                        <li><a href="{{ route('site.customer.register') }}"><i class="icon fa fa-registered"></i>Register</a></li>
                        @endif

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
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div><!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form action="{{ route('site.search.products') }}" method="get">
                            <div class="control-group">
                                <input class="search-field" name="search" id="search" onfocus="search_result_show();" onblur="search_result_hide();" placeholder="Search here..." />
                                <button type="submit" class="search-button" ></button>
                            </div>
                        </form>
                        <div id="search-result">
                            {{--Page Loder...--}}
                            <div id="search-overlay">
                                <div class="cv-spinner">
                                    <span class="spinner"></span>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div><!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart">
                        <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket">
                                    <i class="glyphicon glyphicon-shopping-cart"></i>
                                </div>
                                <div class="basket-item-count"><span class="count">{{ Cart::getTotalQuantity() }}</span></div>
                                <div class="total-price-basket">
                                    <span class="lbl">cart -</span>
                                    <span class="total-price">
						            <span class="sign">&#2547;&nbsp;</span><span class="value">{{ Cart::getTotal() }}</span>
					                </span>
                                </div>


                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                @if(!empty(Cart::getTotalQuantity() > 0))
                                    @php($cart_items = \Cart::getContent())
                                    @if(!$cart_items->isEmpty())
                                    @foreach($cart_items as $item)
                                    <div class="cart-item product-summary">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <div class="image">
                                                    <a href="{{ route('site.product-detail', $item->attributes->slug) }}"><img src="{{ asset('uploads/images/product/images/'.$item->attributes->image) }}" alt="{{ $item->attributes->image }}"></a>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">

                                                <h3 class="name"><a href="{{ route('site.product-detail', $item->attributes->slug) }}">{{ $item->name }}</a>&nbsp;&nbsp;<strong>({{ $item->quantity  }})</strong></h3>
                                                <div class="price">&#2547;&nbsp;{{ $item->price * $item->quantity }}</div>
                                            </div>
                                            <div class="col-xs-1 action">
                                                <form action="{{ route('site.cart.delete') }}" method="post" id="delete-form-cart-{{ $item->id }}">
                                                    @csrf

                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                </form>
                                                <a style="cursor: pointer;" type="submit" onclick="deleteCartItem({{ $item->id }});"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div><!-- /.cart-item -->
                                    @endforeach
                                    <div class="clearfix"></div>
                                    <hr>

                                    <div class="clearfix cart-total">
                                        <div class="pull-right">

                                            <span class="text">Sub Total :</span><span class='price'>&#2547;&nbsp;{{ Cart::getSubTotal() }}</span>

                                        </div>
                                        <div class="clearfix"></div>
                                        <a href="{{ route('site.cart.show') }}" class="btn btn-upper btn-primary btn-sm m-t-20 pull-left">View Cart</a>
                                        <a href="#" class="btn btn-upper btn-primary btn-sm m-t-20 pull-right">Checkout</a>
                                    </div><!-- /.cart-total-->

                                    @else
                                        <p class="text-center text-danger">Your Cart Item is Empty</p>
                                    @endif

                                @else
                                    <p class="text-center text-danger">Please Login!</p>
                                @endif

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
                                <li class="dropdown yamm-fw {{ request()->is('/') ? 'active' : '' }}">
                                    <a href="{{ route('site.index') }}">Home</a>
                                </li>
                                @foreach($brands as $brand)
                                <li class="yamm {{ request()->is('brand/'.$brand->brand_slug) ? 'active' : '' }}">
                                    <a href="{{ route('site.brand', $brand->brand_slug) }}" >{{ $brand->brand_name }}
{{--                                        <span class="menu-label hot-menu hidden-xs">--}}
{{--                                            {{ $brand->level === 'top' ? 'Hot' : 'New' }}--}}
{{--                                        </span>--}}
                                    </a>
                                </li>
                                @endforeach
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

<script>
    // DELETE CART ITEM FROM CART LIST using Sweetalert package js...
    function deleteCartItem(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You Want to be Delete this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById('delete-form-cart-'+id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your Cart Item is safe :)',
                    'error'
                )
            }
        })
    }
</script>
