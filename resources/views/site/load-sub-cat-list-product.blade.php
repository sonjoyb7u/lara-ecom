@if($products->isEmpty())
    @foreach($products as $product)
        <h2 class="text-center">No Product Found under this, <span style="color: #59B210;">{{ 'Category - ( ' . $product->category->category_name . ' ) wise Sub Category - ( ' . $product->subCategory->sub_category_name . ' )' }}</span></h2>
    @endforeach
@else
    @php($i=0)
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
                                <div class="rating rateit-small"></div>
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
        @php($i++)
    @endforeach
    @php($getLastId = $product->id)

    @if($i > 3)
        <div class="load-sub-cat-button">
            <button type="submit" class="btn btn-success btn-md" data-id="{{ $getLastId }}" id="loadSubCatShowButton">Load More</button>
        </div>
    @endif

@endif

