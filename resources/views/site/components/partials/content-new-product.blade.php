<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    <div class="more-info-tab clearfix ">
        <h3 class="new-product-title pull-left">All Products</h3>
        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
            <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
            @foreach($categories as $category)
            <li>
                <a data-transition-type="backSlide" href="#{{ $category->category_slug }}" data-toggle="tab">{{ $category->category_name }}
                </a>
            </li>
            @endforeach
{{--            <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>--}}
{{--            <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li>--}}
        </ul><!-- /.nav-tabs -->
    </div>

    <div class="tab-content outer-top-xs">
        <div class="tab-pane in active" id="all">
            <div class="product-slider">
                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                    @foreach($products as $product)
                    <div class="item item-carousel">
                        <div class="products">
                            @php($special_price = false)
                            @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))
                                @php($special_price = true)
                            @endif
                            <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ route('site.product-detail', $product->slug) }}"><img  src="{{ asset('uploads/images/product/images/'. $product->image) }}" alt="{{ $product->image }}"></a>
                                    </div><!-- /.image -->

                                    @if($special_price)
                                        <div class="tag sale">
                                        <span class="special-price-percent">
                                            {{ $special_price ? sprintf('%.2f', (($product->sales_price - $product->special_price) / $product->sales_price) * 100).'%off' : '' }}
                                        </span>
                                        </div>
                                    @else

                                    @endif
                                </div><!-- /.product-image -->


                                <div class="product-info text-left">
                                    <h3 class="name"><a href="{{ route('site.product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
{{--                                    <div class="rating rateit-small"></div>--}}
{{--                                    <div class="description"></div>--}}

                                    <div class="product-price">
                                        <span class="price">
                                            &#2547;{{ $special_price ? $product->special_price : $product->sales_price }}
                                        </span>
                                        @if($special_price)
                                            <span class="price-before-discount pull-right">
                                                &#2547;{{ $product->sales_price }}
                                            </span>
                                        @endif

                                    </div>
                                    <!-- /.product-price -->

                                </div><!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>

                                            </li>

                                            <li class="lnk wishlist">
                                                <a data-toggle="tooltip" class="add-to-cart" href="detail.html" title="Wishlist">
                                                    <i class="icon fa fa-heart"></i>
                                                </a>
                                            </li>

                                            <li class="lnk">
                                                <a data-toggle="tooltip" class="add-to-cart" href="{{ route('site.product-detail', $product->slug) }}" title="View">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div><!-- /.action -->
                                </div><!-- /.cart -->
                            </div><!-- /.product -->

                        </div><!-- /.products -->
                    </div><!-- /.item -->
                    @endforeach
                </div><!-- /.home-owl-carousel -->
            </div><!-- /.product-slider -->
        </div><!-- /.tab-pane -->

        @foreach($categories as $category)
            <div class="tab-pane" id="{{ $category->category_slug }}">
                <div class="product-slider">
                    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme">
                        @if($category->products->isEmpty())
                            <h3 class="text-center">No Product Found!</h3>
                        @else
                        @foreach($category->products as $product)
                            <div class="item item-carousel">
                                <div class="products">                                                @php($special_price = false)
                                    @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))
                                        @php($special_price = true)
                                    @endif
                                    <div class="product">
                                        <div class="product-image">
                                            <div class="image">
                                                <a href="{{ route('site.product-detail', $product->slug) }}"><img  src="{{ asset('uploads/images/product/images/'.$product->image) }}" alt="{{ $product->image }}"></a>
                                            </div><!-- /.image -->

                                            @if($special_price)
                                                <div class="tag new">
                                                <span class="special-price-percent">
                                                    {{ $special_price ? sprintf('%.2f', (($product->sales_price - $product->special_price) / $product->sales_price) * 100).'%off' : '' }}
                                                </span>
                                                </div>
                                            @else

                                            @endif
                                        </div><!-- /.product-image -->


                                        <div class="product-info text-left">
                                            <h3 class="name"><a href="{{ route('site.product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
                                            <div class="rating rateit-small"></div>
                                            <div class="description"></div>

                                            <div class="product-price">
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
                                                        <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                            <i class="icon fa fa-heart"></i>
                                                        </a>
                                                    </li>

                                                    <li class="lnk">
                                                        <a class="add-to-cart" href="{{ route('site.product-detail', $product->slug) }}" title="View">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div><!-- /.action -->
                                        </div><!-- /.cart -->
                                    </div><!-- /.product -->

                                </div><!-- /.products -->
                            </div><!-- /.item -->
                        @endforeach
                        @endif
                    </div><!-- /.home-owl-carousel -->
                </div><!-- /.product-slider -->
            </div><!-- /.tab-pane -->
        @endforeach

    </div><!-- /.tab-content -->
</div><!-- /.scroll-tabs -->
