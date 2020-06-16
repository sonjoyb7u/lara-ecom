
{{--@if(count($products) > 0)--}}

@if(!$products->isEmpty())
    @php($i=0)
    @foreach($products as $product)
        <div class="col-sm-6 col-md-3 col-lg-3 wow fadeInUp">
{{--            wow fadeInUp--}}
            <div class="products">
                <div class="product">
                    @php($special_price = false)
                    @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))
                        @php($special_price = true)
                    @endif
                    <div class="product-image">
                        <div class="image"> <a href="{{ route('site.product-detail', $product->slug) }}"><img  src="{{ asset('uploads/images/product/images/'. $product->image) }}" alt="{{ $product->image }}"></a> </div>
                        <!-- /.image -->
                        @if($special_price)
                            <div class="special-price-percent special">
                                <span>{{ $special_price ? sprintf('%.2f', (($product->sales_price - $product->special_price) / $product->sales_price) * 100) : '' }}%<br>off</span>
                            </div>
                        @else

                        @endif
                    </div>
                    <!-- /.product-image -->

                    <div class="product-info text-left">
                        <h3 class="name"><a href="{{ route('site.product-detail', $product->slug) }}">{{ $product->title }}</a></h3>
{{--                        <div class="rating rateit-small"></div>--}}
                        <div class="description"></div>
{{--                        <div class="product-price">--}}

{{--                            @if($product->special_start <= date('Y-m-d') && $product->special_end >= date('Y-m-d'))--}}

{{--                            <span class="price">--}}
{{--                                &#2547;{{ $product->special_price }}--}}
{{--                            </span>--}}
{{--                            <span class="special-price-percent">10.50% off</span>--}}
{{--                            <span class="price-before-discount pull-right">--}}
{{--                                {{ $product->sales_price }}--}}
{{--                            </span>--}}
{{--                            @else--}}
{{--                            <span class="price">--}}
{{--                                &#2547;{{ $product->sales_price }}--}}
{{--                            </span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
                    <!-- /.product-price -->

                        <div class="product-price" style="padding: 8px;">
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

                    </div>
                    <!-- /.product-info -->
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
    @php($i++)
    @endforeach

    @php($getLastId = $product->id)

    @if($i > 3)
    <div class="load-sub-cat-button">
        <button type="submit" class="btn btn-success btn-md" data-id="{{ $getLastId }}" id="loadSubCatShowButton">Load More</button>
    </div>
    @endif

@else
    <h3 class="text-center" style="color: #59B210;">No Product Found Under this Sub Category!</h3>

@endif










