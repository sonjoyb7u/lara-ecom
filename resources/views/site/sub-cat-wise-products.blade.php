@extends('site.components.site-master')

@section('title', 'Sub Category Wise Products | Lara-Ecomm')

@section('left-sidebar')
        <div class="breadcrumb">
            <div class="container">
                <div class="breadcrumb-inner">
                    <ul class="list-inline list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li class='{{ request()->is('category/*') ? 'active' : '' }}'><a href="{{ route('site.category', $sub_category->category->category_slug) }}">{{ $sub_category->category->category_name }}</a></li>
                        <li class='{{ request()->is('sub-category/*') ? 'active' : '' }}'><a href="{{ route('site.sub-category', $sub_category->sub_category_slug) }}">{{ $sub_category->sub_category_name }}</a></li>
                    </ul>
                </div>
                <!-- /.breadcrumb-inner -->
            </div>
            <!-- /.container -->
        </div>

    <!-- ==================== SIDEBAR ======================= -->

    <!-- =================== TOP NAVIGATION =================== -->
    @includeIf('site.components.partials.leftside-category-list')
    <!-- =================== TOP NAVIGATION : END ================== -->

    <!-- ===================== HOT DEALS ========================= -->
    <div class="sidebar-module-container">
        <div class="sidebar-filter">
            <!-- ====================== PRICE SILDER===================== -->
            <div class="sidebar-widget wow fadeInUp">
                <div class="widget-header">
                    <h4 class="widget-title">Price Slider</h4>
                </div>
                <div class="sidebar-widget-body m-t-10">
                    <div class="price-range-holder">
            <span class="min-max">
                 <span class="pull-left">$200.00</span>
                 <span class="pull-right">$800.00</span>
            </span>
                        <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">

                        <input type="text" class="price-slider" value="" >

                    </div><!-- /.price-range-holder -->
                    <a href="#" class="lnk btn btn-primary">Show Now</a>
                </div><!-- /.sidebar-widget-body -->
            </div><!-- /.sidebar-widget -->
            <!-- ===================== PRICE SILDER : END ======================= -->

            <!-- =================== COLOR ==================== -->
            <div class="sidebar-widget wow fadeInUp">
                <div class="widget-header">
                    <h4 class="widget-title">Colors</h4>
                </div>
                <div class="sidebar-widget-body">
                    <ul class="list">
                        <li><a href="#">Red</a></li>
                        <li><a href="#">Blue</a></li>
                        <li><a href="#">Yellow</a></li>
                        <li><a href="#">Pink</a></li>
                        <li><a href="#">Brown</a></li>
                        <li><a href="#">Teal</a></li>
                    </ul>
                </div><!-- /.sidebar-widget-body -->
            </div><!-- /.sidebar-widget -->
            <!-- ======================= COLOR: END ======================= -->

        </div><!-- /.sidebar-filter -->
    </div><!-- /.sidebar-module-container -->

    <!-- ===================== HOT DEALS: END ===================== -->

    <!-- ======================== PRODUCT TAGS ====================== -->
    @includeIf('site.components.partials.leftside-product-tag')
    <!-- ====================== PRODUCT TAGS: END ====================== -->

    <!-- ====================== Testimonials ===================== -->
    {{--        @includeIf('site.components.partials.leftside-newsletter')--}}
    <!-- ============== Testimonials: END ==================== -->

    <!-- ================ SIDEBAR : END ====================== -->
@endsection

@section('content')

    <!-- ====================== SECTION – HERO BANNER =================== -->
    <div id="category" class="category-carousel hidden-xs">
{{--        @if(count($products) > 0)--}}
{{--            @foreach($products as $product)--}}
                <div class="item">
                    <div class="image"> <img src="{{ asset('uploads/images/sub-category/'.$sub_category->banner) }}" alt="{{ $sub_category->banner }}" class="img-responsive"> </div>
                    <div class="container-fluid">
                        <div class="caption vertical-top text-left">
                            <div class="big-text" style="color: #59B210; font-size: 50px;"> {{ ucwords($sub_category->sub_category_name) }} </div>
{{--                        <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>--}}
{{--                        <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>--}}
                        </div>
                        <!-- /.caption -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
{{--            @endforeach--}}

{{--        @else--}}
{{--            @foreach($sub_category as $sub_cat)--}}
{{--                <div class="item">--}}
{{--                    <div class="image"> <img src="{{ asset('uploads/images/sub-category/'.$sub_cat->banner) }}" alt="{{ $sub_cat->banner }}" class="img-responsive"> </div>--}}
{{--                    <div class="container-fluid">--}}
{{--                        <div class="caption vertical-top text-left">--}}
{{--                            <div class="big-text" style="color: #59B210; font-size: 50px;"> {{ ucwords($sub_cat->sub_category_name) }} </div>--}}
{{--                            <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>--}}
{{--                            <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>--}}
{{--                        </div>--}}
{{--                        <!-- /.caption -->--}}
{{--                    </div>--}}
{{--                    <!-- /.container-fluid -->--}}
{{--                </div>--}}
{{--            @endforeach--}}

{{--        @endif--}}



    </div>


    <div class="clearfix filters-container m-t-10">
        <div class="row">
            <div class="col col-sm-6 col-md-2">
                <div class="filter-tabs">
                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                    </ul>
                </div>
                <!-- /.filter-tabs -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <div class="search-result-container ">
        <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
                <div class="category-product">
                    <div class="row">
                        @if(!$products->isEmpty())
                            @foreach($products as $product)
                            <div class="col-sm-6 col-md-3 col-lg-3 wow fadeInUp">
                                <div class="products">
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image"> <a href="{{ route('site.product-detail', $product->slug) }}"><img  src="{{ asset('uploads/images/product/images/'. $product->image) }}" alt="{{ $product->image }}"></a> </div>
                                            <!-- /.image -->
                                            <div class="tag new"><span>new</span></div>
                                        </div>
                                        <!-- /.product-image -->

                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ route('site.product-detail', $product->slug) }}">{{ substr($product->title, 0, 19) }}</a></h3>
{{--                                                <div class="rating rateit-small"></div>--}}

                                            <div class="description"></div>

{{--                                            <div class="product-price">--}}
{{--                                                @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))--}}
{{--                                                <span class="price">--}}
{{--                                                    &#2547;{{ $product->special_price }}--}}
{{--                                                </span>--}}
{{--                                                <span class="special-price-percent">10.50% off</span>--}}
{{--                                                <span class="price-before-discount pull-right">--}}
{{--                                                    {{ $product->sales_price }}--}}
{{--                                                </span>--}}
{{--                                                @else--}}
{{--                                                <span class="price">--}}
{{--                                                    &#2547;{{ $product->sales_price }}--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
                                            <!-- /.product-price -->

                                            <div class="product-price" style="padding: 8px;">
                                            @php($special_price = false)
                                            @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))
                                                @php($special_price = true)
                                            @endif
                                                <span class="price">
                                                    &#2547;{{ $special_price ? $product->special_price : $product->sales_price }}
                                                </span>
                                                @if($special_price)
                                                <span class="special-price-percent">
                                                    {{ sprintf('%.2f', (($product->sales_price - $product->special_price) / $product->sales_price) * 100) }}% off
                                                </span>
                                                <span class="price-before-discount pull-right">
                                                    &#2547;{{ $product->sales_price }}
                                                </span>
                                                @endif
                                            </div>
                                            <!-- /.product-price -->

                                        </div>
                                        <!-- /.product-info -->
                                        <div class="cart clearfix animate-effect">
                                            <div class="action">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                    </li>
                                                    <li class="lnk wishlist"> <a class="add-to-cart" href="{{ route('site.product-detail', $product->slug) }}" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                    <li class="lnk"> <a class="add-to-cart" href="{{ route('site.product-detail', $product->slug) }}" title="Compare"> <i class="fa fa-eye"></i> </a> </li>
                                                </ul>
                                            </div>
                                            <!-- /.action -->
                                        </div>
                                        <!-- /.cart -->
                                    </div>
                                    <!-- /.product -->

                                </div>
                                <!-- /.products -->
                            </div>
                            @endforeach
                            @else
                            <h2 class="text-center">No Product Found under this <span style="color: #59B210;">{{ 'Category - ( ' . $sub_category->category->category_name . ' ) wise Sub Category - ( ' . $sub_category->sub_category_name . ' )' }}</span> !</h2>
                        @endif
                        <!-- /.item -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.category-product -->
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane"  id="list-container">
                <div class="category-product">
                    @if(count($products) > 0)
                        @foreach($products as $product)
                        <div class="category-product-inner wow fadeInUp">
                            <div class="products">
                                <div class="product-list product">
                                    <div class="row product-list-row">
                                        <div class="col col-sm-4 col-lg-4">
                                            <div class="product-image">
                                                <div class="image"> <img src="{{ asset('uploads/images/product/images/'.$product->image) }}" alt=""> </div>
                                            </div>
                                            <!-- /.product-image -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col col-sm-8 col-lg-8">
                                            <div class="product-info">
                                                <h3 class="name"><a href="">{{ $product->title }}</a></h3>
    {{--                                                    <div class="rating rateit-small"></div>--}}
                                            <div class="product-price">
                                                @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))
                                                <span class="price">
                                                    &#2547;{{ $product->special_price }}
                                                </span>
                                                <span class="special-price-percent">
                                                    {{ sprintf('%.2f', (($product->sales_price - $product->special_price) / $product->sales_price) * 100) }}% off
                                                </span>
                                                <span class="price-before-discount pull-right">
                                                    &#2547;{{ $product->sales_price }}
                                                </span>
                                                @else
                                                <span class="price">
                                                    &#2547;{{ $product->sales_price }}
                                                </span>
                                                @endif
                                            </div>
                                                <!-- /.product-price -->
                                                <div class="description m-t-10">{!! $product->desc  !!}</div>
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                            </li>
                                                            <li class="lnk wishlist"> <a class="add-to-cart" href="{{ route('site.product-detail', $product->slug) }}" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> </li>
                                                            <li class="lnk"> <a class="add-to-cart" href="{{ route('site.product-detail', $product->slug) }}" title="Compare"> <i class="fa fa-eye"></i> </a> </li>
                                                        </ul>
                                                    </div>
                                                    <!-- /.action -->
                                                </div>
                                                <!-- /.cart -->
                                            </div>
                                            <!-- /.product-info -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.product-list-row -->
                                    <div class="tag new"><span>new</span></div>
                                </div>
                                <!-- /.product-list -->
                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.category-product-inner -->
                        @endforeach
                    @else
                        @foreach($sub_category as $sub_cat)
                            <h2 class="text-center">No Product Found under the <span style="color: #59B210;">{{ 'Category - ( ' . $sub_category->category->ategory_name . ' ) wise Sub Category - ( ' . $sub_category->sub_category_name . ' )' }}</span></h2>
                        @endforeach
                    @endif
                </div>
                <!-- /.category-product -->
            </div>
            <!-- /.tab-pane #list-container -->
        </div>
        <!-- /.tab-content -->
        <div class="clearfix filters-container">
            <div class="text-right">
                <div class="pagination-container">
                    <ul class="list-inline list-unstyled">
                        <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <!-- /.list-inline -->
                </div>
                <!-- /.pagination-container --> </div>
            <!-- /.text-right -->

        </div>
        <!-- /.filters-container -->

    </div>
    <!-- /.search-result-container -->

@endsection
