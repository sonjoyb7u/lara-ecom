<section class="section wow fadeInUp new-arriavls">
    <h3 class="section-title">New Arrivals</h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        @foreach($new_arriaval_products as $product)
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
                            <div class="special-price-percent new">
                                <span>
                                    {{ $special_price ? sprintf('%.2f', (($product->sales_price - $product->special_price) / $product->sales_price) * 100) : '' }}%<br>off
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
                                    <form action="{{ route('site.cart.add') }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                                        <button class="btn btn-primary icon" type="submit">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </form>

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
    </div><!-- /.home-owl-carousel -->
</section><!-- /.section -->
