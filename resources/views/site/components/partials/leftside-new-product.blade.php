<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">New Product Offer</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
            @php($sl = 1)
            @php($total_special_products = count($new_special_products))

            @foreach($new_special_products as $product)

                @if(($sl%3) == 1)
                    <div class="item">
                        <div class="products special-product">
                            @endif
                            <div class="product">
                                <div class="product-micro">
                                    <div class="row product-micro-row">
                                        <div class="col col-md-5 col-xs-5">
                                            <div class="product-image">
                                                <div class="image">
                                                    <a href="{{ route('site.product-detail', $product->slug) }}">
                                                        <img src="{{ asset('uploads/images/product/images/'.$product->image) }}" alt="{{ $product->image }}">
                                                    </a>
                                                </div><!-- /.image -->

                                            </div><!-- /.product-image -->
                                        </div><!-- /.col -->
                                        <div class="col col-md-7 col-xs-7">
                                            <div class="product-info">
                                                <h3 class="name"><a href="{{ route('site.product-detail', $product->slug) }}">{{ substr($product->title, 0, 14) . '..' }}</a></h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="product-price">
                                                    @php($special_price = false)
                                                    @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))
                                                        @php($special_price = true)
                                                    @endif
                                                    <span class="price">
                                                        &#2547;{{ sprintf('%.2f', $special_price ? $product->special_price : $product->sales_price) }}<br>
                                                    </span>
                                                    @if($special_price)
                                                        <span class="special-price-percent">
{{--                                                            {{ sprintf('%.2f', (($product->sales_price - $product->special_price) / $product->sales_price) * 100) }}% off--}}
                                                         </span>
                                                        <span class="price-before-discount">
                                                            &#2547;{{ sprintf('%.2f', $product->sales_price) }}
                                                        </span>
                                                    @endif
                                                </div><!-- /.product-price -->

                                            </div>
                                        </div><!-- /.col -->
                                    </div><!-- /.product-micro-row -->
                                </div><!-- /.product-micro -->

                            </div>

                            @if(($sl%3) == 0 || $sl == $total_special_products)
                        </div>
                    </div>
                @endif

                @php($sl++)

            @endforeach

        </div>
    </div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
