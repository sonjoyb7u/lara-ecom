@extends('site.components.site-master')

@section('title', 'Product Detail | Lara-Ecomm')

@section('left-sidebar')

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
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    @if($product_detail->sub_category_id != null)
                    <li><a href="#">Home</a></li>
                    <li class='{{ request()->is('category/*') ? 'active' : '' }}'><a href="{{ route('site.category', $product_detail->category->category_slug) }}">{{ $product_detail->category->category_slug }}</a></li>
                    <li class='{{ request()->is('sub-category/*') ? 'active' : '' }}'>
                        <a href="{{ route('site.sub-category', $product_detail->subCategory->sub_category_slug) }}" >
                            {{ $product_detail->subCategory->sub_category_slug }}
                        </a>
                    </li>
                    <li class='{{ request()->is('product-detail/*') ? 'active' : '' }}'><a href="{{ route('site.product-detail', $product_detail->slug) }}">{{ $product_detail->slug }}</a></li>
                    @else
                        <li><a href="#">Home</a></li>
                        <li class='{{ request()->is('category/*') ? 'active' : '' }}'><a href="{{ route('site.category', $product_detail->category->category_slug) }}">{{ $product_detail->category->category_slug }}</a></li>
                        <li class='{{ request()->is('product-detail/*') ? 'active' : '' }}'><a href="{{ route('site.product-detail', $product_detail->slug) }}">{{ $product_detail->slug }}</a></li>
                    @endif
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>

    <!-- /.Product Detail... -->
    <div class="detail-block">
        <div class="row  wow fadeInUp">

            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                <div class="product-item-holder size-big single-product-gallery small-gallery">

                    <div id="owl-single-product">

                        <div class="single-product-gallery-item" id="slide1">
                            <a data-lightbox="image-1" data-title="Gallery" href="{{ route('site.product-detail', $product_detail->slug) }}">
                                <img class="img-responsive" alt="" src="{{ asset('uploads/images/product/images/'.$product_detail->image) }}" data-echo="{{ asset('uploads/images/product/images/'.$product_detail->image) }}" />
                            </a>
                        </div>
                        <!-- /.single-product-gallery-item -->
                    </div><!-- /.single-product-slider -->


                    <div class="single-product-gallery-thumbs gallery-thumbs">

                        <div id="owl-single-product-thumbnails">
                            @php
                                $galleries = json_decode($product_detail->gallery);
                            @endphp
                            @if($galleries > 0)
                                @foreach($galleries as $gallery)
                                    <div class="item">
                                        <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
                                            <img class="img-responsive" width="85" alt="" src="{{ asset('uploads/images/product/gallery-images/'.$gallery) }}" />
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div><!-- /#owl-single-product-thumbnails -->



                    </div><!-- /.gallery-thumbs -->

                </div><!-- /.single-product-gallery -->
            </div><!-- /.gallery-holder -->
            <div class='col-sm-6 col-md-7 product-info-block'>
                <div class="product-info">
                    <h1 class="name">{{ $product_detail->title }}</h1>

                    <div class="rating-reviews m-t-20">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="rating rateit-small"></div>
                            </div>
                            <div class="col-sm-8">
                                <div class="reviews">
                                    <a href="#" class="lnk">(13 Reviews)</a>
                                </div>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.rating-reviews -->

                    <div class="stock-container info-container m-t-10">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="stock-box">
                                    <span class="label">Availability :</span>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="stock-box">
                                    <span class="value">{{ ucwords($product_detail->available) }}</span>
                                </div>
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.stock-container -->

                    <div class="description-container m-t-20">
                        {!! $product_detail->desc !!}
                    </div><!-- /.description-container -->

                    <div class="price-container info-container m-t-20">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="price-box">
                                    @php($special_price = false)
                                    @if($product_detail->special_start <= date('Y-m-d') && $product_detail->special_end >= date('Y-m-d'))
                                        @php($special_price = true)
                                    @endif
                                    <span class="price">
                                        &#2547;{{ $special_price ? sprintf('%.2f', $product_detail->special_price) : sprintf('%.2f', $product_detail->sales_price) }}
                                    </span>
                                    @if($special_price)
                                        <span class="price-strike pull-right">
                                            &#2547;{{ sprintf('%.2f', $product_detail->sales_price) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="favorite-button m-t-10">
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="{{ route('site.product-detail', $product_detail->slug) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </div>
                            </div>

                        </div><!-- /.row -->
                    </div><!-- /.price-container -->

                    <div class="quantity-container info-container">
                        <div class="row">

                            <div class="col-sm-2">
                                <span class="label">Qty :</span>
                            </div>

                            <div class="col-sm-2">
                                <div class="cart-quantity">
                                    <div class="quant-input">
                                        <div class="arrows">
                                            <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
                                            <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
                                        </div>
                                        <input type="text" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <a href="#" class="btn btn-primary"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>
                            </div>


                        </div><!-- /.row -->
                    </div><!-- /.quantity-container -->






                </div><!-- /.product-info -->
            </div><!-- /.col-sm-7 -->
        </div><!-- /.row -->
    </div>

    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
        <div class="row">
            <div class="col-sm-3">
                <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                    <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                    <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                </ul><!-- /.nav-tabs #product-tabs -->
            </div>
            <div class="col-sm-9">

                <div class="tab-content">

                    <div id="description" class="tab-pane in active">
                        <div class="product-tab">
                            <p class="text">{!! $product_detail->long_desc !!}</p>
                        </div>
                    </div><!-- /.tab-pane -->

                    <div id="review" class="tab-pane">
                        <div class="product-tab">

                            <div class="product-reviews">
                                <h4 class="title">Customer Reviews</h4>

                                <div class="reviews">
                                    <div class="review">
                                        <div class="review-title"><span class="summary">We love this product</span><span class="date"><i class="fa fa-calendar"></i><span>1 days ago</span></span></div>
                                        <div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit.Aliquam suscipit."</div>
                                    </div>

                                </div><!-- /.reviews -->
                            </div><!-- /.product-reviews -->



                            <div class="product-add-review">
                                <h4 class="title">Write your own review</h4>
                                <div class="review-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="cell-label">&nbsp;</th>
                                                <th>1 star</th>
                                                <th>2 stars</th>
                                                <th>3 stars</th>
                                                <th>4 stars</th>
                                                <th>5 stars</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="cell-label">Quality</td>
                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                            </tr>
                                            <tr>
                                                <td class="cell-label">Price</td>
                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                            </tr>
                                            <tr>
                                                <td class="cell-label">Value</td>
                                                <td><input type="radio" name="quality" class="radio" value="1"></td>
                                                <td><input type="radio" name="quality" class="radio" value="2"></td>
                                                <td><input type="radio" name="quality" class="radio" value="3"></td>
                                                <td><input type="radio" name="quality" class="radio" value="4"></td>
                                                <td><input type="radio" name="quality" class="radio" value="5"></td>
                                            </tr>
                                            </tbody>
                                        </table><!-- /.table .table-bordered -->
                                    </div><!-- /.table-responsive -->
                                </div><!-- /.review-table -->

                                <div class="review-form">
                                    <div class="form-container">
                                        <form role="form" class="cnt-form">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputName">Your Name <span class="astk">*</span></label>
                                                        <input type="text" class="form-control txt" id="exampleInputName" placeholder="">
                                                    </div><!-- /.form-group -->
                                                    <div class="form-group">
                                                        <label for="exampleInputSummary">Summary <span class="astk">*</span></label>
                                                        <input type="text" class="form-control txt" id="exampleInputSummary" placeholder="">
                                                    </div><!-- /.form-group -->
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputReview">Review <span class="astk">*</span></label>
                                                        <textarea class="form-control txt txt-review" id="exampleInputReview" rows="4" placeholder=""></textarea>
                                                    </div><!-- /.form-group -->
                                                </div>
                                            </div><!-- /.row -->

                                            <div class="action text-right">
                                                <button class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                            </div><!-- /.action -->

                                        </form><!-- /.cnt-form -->
                                    </div><!-- /.form-container -->
                                </div><!-- /.review-form -->

                            </div><!-- /.product-add-review -->

                        </div><!-- /.product-tab -->
                    </div><!-- /.tab-pane -->

                    <div id="tags" class="tab-pane">
                        <div class="product-tag">

                            <h4 class="title">Product Tags</h4>
                            <form role="form" class="form-inline form-cnt">
                                <div class="form-container">

                                    <div class="form-group">
                                        <label for="exampleInputTag">Add Your Tags: </label>
                                        <input type="email" id="exampleInputTag" class="form-control txt">


                                    </div>

                                    <button class="btn btn-upper btn-primary" type="submit">ADD TAGS</button>
                                </div><!-- /.form-container -->
                            </form><!-- /.form-cnt -->

                            <form role="form" class="form-inline form-cnt">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <span class="text col-md-offset-3">Use spaces to separate tags. Use single quotes (') for phrases.</span>
                                </div>
                            </form><!-- /.form-cnt -->

                        </div><!-- /.product-tab -->
                    </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.product-tabs -->

    <!-- ============================================== UPSELL PRODUCTS ============================================== -->
    <section class="section featured-product wow fadeInUp">
        <h3 class="section-title">Related products</h3>
        @if(!$related_subcat_products->isEmpty())
            @foreach($related_subcat_products as $product)
        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
            <div class="item item-carousel">
                <div class="products">
                    <div class="product">
                        <div class="product-image">
                            <div class="image">
                                <a href="{{ route('site.product-detail', $product->slug) }}"><img  src="{{ asset('uploads/images/product/images/'. $product->image) }}" alt="{{ $product->image }}"></a>
                            </div><!-- /.image -->

                            <div class="tag sale"><span>sale</span></div>
                        </div><!-- /.product-image -->


                        <div class="product-info text-left">
                            <h3 class="name"><a href="{{ route('site.product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="description"></div>

                            <div class="product-price">
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
                            </div><!-- /.product-price -->

                        </div><!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        <button class="btn btn-primary icon" data-toggle="dropdown" type="button">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>

                                    </li>

                                    <li class="lnk wishlist">
                                        <a class="add-to-cart" href="" title="Wishlist">
                                            <i class="icon fa fa-heart"></i>
                                        </a>
                                    </li>

                                    <li class="lnk">
                                        <a class="add-to-cart" href="{{ route('site.product-detail', $product->slug) }}" title="Compare">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div><!-- /.action -->
                        </div><!-- /.cart -->
                    </div><!-- /.product -->

                </div><!-- /.products -->
            </div><!-- /.item -->
        </div><!-- /.home-owl-carousel -->
        @endforeach
        @else
            @if($product_detail->sub_category_id != null)
            <h2 class="text-center">No Related Product Found Under This,
                    <span style="color: #59B210;">
                    {{ 'Category - ( ' . $product_detail->category->category_name .
                    ' ) wise Sub Category - ( ' . $product_detail->subCategory->sub_category_name . ' )!' }}         </span>
            </h2>
            @else()
                <h2 class="text-center">No Related Product Found Under This,
                    <span style="color: #59B210;">
                    {{ 'Category - ( ' . $product_detail->category->category_name .
                    ' )!' }}
                    </span>
                </h2>
            @endif
        @endif
    </section><!-- /.section -->
    <!-- ============================================== UPSELL PRODUCTS : END ============================================== -->

    <div class="clearfix"></div>

@endsection

