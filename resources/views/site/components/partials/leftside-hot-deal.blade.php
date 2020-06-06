<div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
    <h3 class="section-title">Special Hot deals</h3>
    <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss">
        @foreach($special_deal_products as $product)
        <div class="item">
            <div class="products">
                @php($special_price = false)
                @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))
                    @php($special_price = true)
                @endif
                <div class="hot-deal-wrapper">
                    <div class="image">
                        <img src="{{ asset('uploads/images/product/images/'. $product->image) }}" alt="{{ $product->image }}">
                    </div>
                    <div class="sale-offer-tag">
                        <span>{{ $special_price ? sprintf('%.2f', (($product->sales_price - $product->special_price) / $product->sales_price) * 100) : '' }}%<br>off</span>
                    </div>
                    <div class="timing-wrapper">

                        <?php
                        $startdate = date_default_timezone_get();
                        $enddate =   $product->special_end;

                        $diff = strtotime($enddate. ' Asia/Dhaka') - strtotime($startdate. ' Asia/Dhaka');
                        $dd =  floor($diff / 86400);
                        $hh =  floor($diff / 3600 % 24);
                        $mm =  floor($diff / 60 % 60);
                        $ss   =  floor($diff % 60);
                        ?>
                        @if($special_price)
                        <div class="box-wrapper">
                            <div class="date box">
                                <span class="key">{{ $dd }}</span>
                                <span class="value">DAYS</span>
                            </div>
                        </div>

                        <div class="box-wrapper">
                            <div class="hour box">
                                <span class="key">{{ $hh }}</span>
                                <span class="value">HRS</span>
                            </div>
                        </div>

                        <div class="box-wrapper">
                            <div class="minutes box">
                                <span class="key">{{ $mm }}</span>
                                <span class="value">MINS</span>
                            </div>
                        </div>

                       <div class="box-wrapper hidden-md">
                            <div class="seconds box">
                                <span class="key">{{ $ss }}</span>
                                <span class="value">SEC</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div><!-- /.hot-deal-wrapper -->

                <div class="product-info text-left m-t-20">
                    <h3 class="name"><a href="{{ route('site.product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
                    <div class="rating rateit-small"></div>

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
                        <div class="add-cart-button btn-group">
                            <form action="{{ route('site.cart.add') }}" method="POST">
                                @csrf

                                <input type="hidden" name="slug" value="{{ $product->slug }}">
                                <button class="btn btn-primary icon" type="submit">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                                <button class="btn btn-primary cart-btn" type="submit">Add to cart</button>
                            </form>


                        </div>

                    </div><!-- /.action -->
                </div><!-- /.cart -->
            </div>
        </div>
        @endforeach
    </div><!-- /.sidebar-widget -->
</div>
