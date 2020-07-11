@extends('site.components.site-master')

@section('title', 'Product Detail | Lara-Ecomm')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/site/custom/plugins/easy-zoom-image/css/easyzoom.css') }}" />
@endpush

@section('breadcrumb')
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
@endsection

@section('left-sidebar')
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
    <!-- ==================== SIDEBAR ======================= -->

    <!-- =================== TOP NAVIGATION =================== -->
    @includeIf('site.components.partials.leftside-category-list')
    <!-- =================== TOP NAVIGATION : END ================== -->

    <!-- ====================== SPECIAL OFFER ======================== -->
    @includeIf('site.components.partials.leftside-new-product')
    <!-- ====================== SPECIAL OFFER : END ==================== -->

    <!-- ====================== SPECIAL DEALS ===================== -->
{{--    @includeIf('site.components.partials.leftside-special-deals')--}}
    <!-- ===================== SPECIAL DEALS: END ================= -->

    <!-- ====================== Newsletter ===================== -->
    @includeIf('site.components.partials.leftside-newsletter')
    <!-- ============== Newsletter: END ==================== -->

    <!-- ================ SIDEBAR : END ====================== -->
    <div class="home-banner">
        <img src="{{ asset('assets/site/images/banners/LHS-banner.jpg') }}" alt="Image">
    </div>
</div>
<!-- /.sidemenu-holder -->
@endsection

@section('content')
<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
    <!-- /.Product Detail... -->
    <div class="detail-block">
        <div class="row  wow fadeInUp">

            <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                <div class="product-item-holder size-big single-product-gallery small-gallery">

                    <div id="owl-single-product">

                        <div class="easyzoom easyzoom--overlay single-product-gallery-item" id="slide1">
                            <a data-lightbox="image-1" data-title="Gallery" href="{{ asset('uploads/images/product/images/'.$product_detail->image) }}">
                                <img class="img-responsive" alt="" src="{{ asset('uploads/images/product/images/'.$product_detail->image) }}" data-echo="{{ asset('uploads/images/product/images/'.$product_detail->image) }}" />
                            </a>
                        </div>
                        <!-- /.single-product-gallery-item -->
                    </div><!-- /.single-product-slider -->


                    <div class="single-product-gallery-thumbs gallery-thumbs">

                        <div id="owl-single-product-thumbnails">
                            @php($galleries = json_decode($product_detail->gallery))
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
{{--                                <div class="rating rateit-small"></div>--}}
                                <div class="star-1">
                                    <div class="star-bg">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                        @endfor
                                    </div>
                                    <div class="rating-avg" style="width: {{ $product_detail->getRating() * 20 }}%">
                                        <div class="star-color">
                                            @for($i=1; $i<=5; $i++)
                                                <i class="fa fa-star" style="color: yellowgreen;" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="reviews">
                                    <a href="#" class="lnk">({{ count($product_detail->reviews) }} Reviews)</a>
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
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="E-mail" href="#">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                </div>
                            </div>

                        </div><!-- /.row -->
                    </div><!-- /.price-container -->

                    <form action="{{ route('site.cart.add-single-product-cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $product_detail->slug }}">

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
                                        <input type="text" name="quantity" value="{{ $product_detail->quantity }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <input type="hidden" name="slug" value="{{ $product_detail->slug }}">
                                <button class="btn btn-primary icon" type="submit">ADD TO CART</button>
{{--                                <a href="" class="btn btn-primary" type="submit"><i class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</a>--}}
                            </div>


                        </div><!-- /.row -->
                    </div><!-- /.quantity-container -->

                    </form>






                </div><!-- /.product-info -->
            </div><!-- /.col-sm-7 -->
        </div><!-- /.row -->
    </div>

    <div class="product-tabs inner-bottom-xs  wow fadeInUp">
        @includeIf('messages.show-message')
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
                                <div class="review-rating">
                                    <span>{{ $product_detail->getRating() }}</span>
                                    <span>/5</span>
                                    <div class="star-2">
                                        <div class="star-bg">
                                            @for($i=1; $i<=5; $i++)
                                            <i class="fa fa-star-o" aria-hidden="true"></i>
                                            @endfor
                                        </div>
                                        <div class="rating-avg" style="width: {{ $product_detail->getRating() * 20 }}%">
                                            <div class="star-color">
                                                @for($i=1; $i<=5; $i++)
                                                    <i class="fa fa-star" style="color: yellowgreen;" aria-hidden="true"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear-fix"></div>
                                    <span>{{ count($product_detail->reviews) }} Review's</span>
                                </div>

                                <h4 class="title">Customer Reviews</h4>
                                @if(!$customer_reviews->isEmpty())
                                <div class="reviews">
                                    @foreach($customer_reviews as $review)
                                    <div class="review">
                                        <div class="review-title">
                                            <span class="summary">{{ $review->customer->name }}</span>
                                            <span class="date"><i class="fa fa-calendar"></i><span>{{ $review->created_at->diffForHumans() }}</span></span></div>
                                        <div class="text">"{{ $review->message }}"</div>
                                    </div>
                                    @endforeach

                                </div><!-- /.reviews -->
                                @else
                                    <h4 class="text-center text-danger" style="border: 1px solid #A0A0A0; padding: 5px;">There Were No Customer Reviews About This Product!</h4>
                                @endif
                            </div><!-- /.product-reviews -->

                            @if(Session::get('cuStOmArId'))
                                @if($count_order_item > 0)
                                <div class="product-add-review">
                                    <h4 class="title">Write your own review</h4>
                                    <form role="form" class="cnt-form" action="{{ route('site.review.store') }}" method="post">
                                        @csrf

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
                                                        <td class="cell-label">Rating</td>
                                                        <td><input type="radio" name="rating" class="radio" value="1"></td>
                                                        <td><input type="radio" name="rating" class="radio" value="2"></td>
                                                        <td><input type="radio" name="rating" class="radio" value="3"></td>
                                                        <td><input type="radio" name="rating" class="radio" value="4"></td>
                                                        <td><input type="radio" name="rating" class="radio" value="5"></td>
                                                    </tr>
                                                    </tbody>
                                                </table><!-- /.table .table-bordered -->
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.review-table -->

                                        <div class="review-form">
                                            <div class="form-container">

                                                    <div class="row">
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">Your Name <span class="astk">*</span></label>
                                                                <input type="text" class="form-control txt" id="name" placeholder="Enter Your Name" value="{{ Session::get('cuStOmArNaMe') ? Session::get('cuStOmArNaMe') : '' }}">
                                                            </div><!-- /.form-group -->
                                                        </div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">Your Email <span class="astk">*</span></label>
                                                                <input type="text" class="form-control txt" id="email" placeholder="Enter Your Email" value="{{ Session::get('cuStOmArEmAiL') ? Session::get('cuStOmArEmAiL') : '' }}">
                                                            </div><!-- /.form-group -->
                                                        </div>

                                                        <div class="col-sm-6 col-md-12">
                                                            <div class="form-group">
                                                                <label for="message">Review <span class="astk">*</span></label>
                                                                <textarea class="form-control txt txt-review" id="message" name="message" rows="2" placeholder=""></textarea>
                                                            </div><!-- /.form-group -->
                                                        </div>
                                                    </div><!-- /.row -->

                                                    <div class="action text-right">
                                                        <input type="hidden" name="product" value="{{ $product_detail->id }}">
                                                        <button type="submit" class="btn btn-primary btn-upper">SUBMIT REVIEW</button>
                                                    </div><!-- /.action -->


                                            </div><!-- /.form-container -->
                                        </div><!-- /.review-form -->
                                    </form><!-- /.cnt-form -->
                                </div><!-- /.product-add-review -->
                                @else
                                    <h4 class="text-center text-danger" style="border: 1px solid #A0A0A0; padding: 5px;">Please, Buy This Product, than Submit Your Rating & Review.</h4>
                                @endif
                            @else
                                <h4 class="text-center text-danger" style="border: 1px solid #A0A0A0; padding: 5px;">Please, Login First.</h4>
                            @endif
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
        <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">

            @if(!$related_subcat_products->isEmpty())
                @foreach($related_subcat_products as $product)
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
                @endforeach
            @else
                @if($product_detail->sub_category_id != null)
                    <h2 class="text-center">No Related Product Found Under This,
                        <span style="color: #59B210;">
                    {{ 'Category - ( ' . $product_detail->category->category_name .
                    ' ) wise Sub Category - ( ' . $product_detail->subCategory->sub_category_name . ' )!' }}         </span>
                    </h2>
                @else
                    <h2 class="text-center">No Related Product Found Under This,
                        <span style="color: #59B210;">
                    {{ 'Category - ( ' . $product_detail->category->category_name .
                    ' )!' }}
                    </span>
                    </h2>
                @endif
            @endif

        </div><!-- /.home-owl-carousel -->
    </section><!-- /.section -->
    <!-- ===================== RELATED PRODUCTS : END ====================== -->

    <div class="clearfix"></div>

</div>
<!-- /.homebanner-holder -->
@endsection


@push('js')
    <script src="{{ asset('assets/site/custom/plugins/easy-zoom-image/js/easyzoom.js') }}"></script>
    <script>
        // Toastr Message generate js...
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}', 'Error', {
            closeButton: true,
            progressBar: true,
        });
        @endforeach
        @endif

        $(function () {
            $('.easyzoom').easyZoom({
                // The text to display within the notice box while loading the zoom image.
                loadingNotice: 'Loading image',
                // The text to display within the notice box if an error occurs when loading the zoom image.
                errorNotice: 'The image could not be loaded',
                // The time (in milliseconds) to display the error notice.
                errorDuration: 2500,
                // Attribute to retrieve the zoom image URL from.
                linkAttribute: 'href',
                // Prevent clicks on the zoom image link.
                preventClicks: true,
                // Callback function to execute before the flyout is displayed.
                beforeShow: $.noop,
                // Callback function to execute before the flyout is removed.
                beforeHide: $.noop,
                // Callback function to execute when the flyout is displayed.
                onShow: $.noop,
                // Callback function to execute when the flyout is removed.
                onHide: $.noop,
                // Callback function to execute when the cursor is moved while over the image.
                onMove: $.noop
            });
        });

    </script>
@endpush

