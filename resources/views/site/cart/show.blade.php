@extends('site.components.site-master')

@section('title', 'Category Wise Products | Lara-Ecomm')

@section('content')

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('site.index') }}">Home</a></li>
                <li class='{{ request()->is('cart/*') ? 'active' : '' }}'><a href="{{ route('site.cart.show') }}">Shopping Cart</a></li>
            </ul>
        </div>
        <!-- /.breadcrumb-inner -->
    </div>
    <!-- /.container -->
</div>

<div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

    <div id="showMsg"></div>
    @includeIf('messages.show-message')

    @if(Cart::isEmpty())
    <div class="shopping-cart">
        <div class="cart-item-message text-center">
            <h2 class="text-danger">Your Cart Item Is Empty, Please Continue Shopping...</h2>
            <span><a href="{{ route('site.index') }}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a></span>
        </div>
    </div>
    @else
        <div class="shopping-cart">
            <div class="shopping-cart-table ">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="cart-romove item">Remove</th>
                            <th class="cart-description item">Image</th>
                            <th class="cart-product-name item">Product Name</th>
                            <th class="cart-qty item">Quantity</th>
                            <th class="cart-sub-total item">Unit Price</th>
                            <th class="cart-total last-item">Grandtotal</th>
                        </tr>
                        </thead><!-- /thead -->
                        <tbody>
                        @php($cart_items = \Cart::getContent())
{{--                        {{ dd($cart_items->toArray()) }}--}}
                        @foreach($cart_items as $item)
{{--                            {{ dd($item) }}--}}
                            <tr>
                                <td class="text-center">
                                    <form action="{{ route('site.cart.delete') }}" method="post" id="delete-form-cart-{{ $item->id }}">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                    </form>
                                    <button type="sudmit" class="btn btn-danger btn-sm" onclick="deleteCartItem({{ $item->id }});">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                                <td class="text-center">
{{--                                @foreach($item->attributes as $attribute)--}}
{{--                                {{ dd($attribute['image']) }}--}}
                                    <a href="{{ route('site.product-detail', $item->attributes->slug) }}">
                                        <img width="80" height="70" src="{{ asset('uploads/images/product/images/'.$item->attributes->image) }}" alt="{{ $item->attributes->image }}">
                                    </a>
{{--                                @endforeach--}}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('site.product-detail', $item->attributes->slug) }}">{{ $item->name }}</a>
                                </td>
                                <td class="cart-product-quantity text-center">
                                    <form action="{{ route('site.cart.update') }}" method="post">
                                        @csrf

                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="hidden" name="price" value="{{ $item->price }}">
                                        <input type="number" min="1" name="quantity" value="{{ $item->quantity }}" class="form-control quantity" id="quantity" data-id="{{ $item->id }}">
{{--                                        <span>--}}
{{--                                            <button type="submit" class="btn btn-success btn-sm quantity-update-btn">Update</button>--}}
{{--                                        </span>--}}
                                    </form>
{{--                                    <input style="width: 50px;" type="number" name="quantity" value="{{ $item->quantity }}" class="quantity" data-id="{{ $item->id }}">--}}
                                </td>
                                <td class="text-center">
                                    @php($special_price = false)
                                    @if($item->attributes->special_start <= date('Y-m-d') && $item->attributes->special_end >= date('Y-m-d'))
                                        @php($special_price = true)
                                    @endif
                                    @if($special_price)
                                        <strike>
                                            &#2547;{{ $item->attributes->sales_price }}
                                        </strike>&nbsp;&nbsp;
                                    @endif
                                    &#2547;{{ $item->price }}
                                </td>
                                <td class="text-center" id="grandTotalPrice">&#2547;&nbsp;{{ $item->price * $item->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody><!-- /tbody -->
                        <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="shopping-cart-btn">
                                <span class="">
                                    <a href="{{ route('site.index') }}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
                                    <a href="#" class="btn btn-upper btn-primary outer-right-xs">Update shopping cart</a>
                                </span>
                                </div><!-- /.shopping-cart-btn -->
                            </td>
                        </tr>
                        </tfoot>
                    </table><!-- /table -->
                </div>
            </div><!-- /.shopping-cart-table -->

{{--                    {{ \Cart::clear() }}--}}

            <div class="col-md-4 col-sm-12 estimate-ship-tax">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <span class="estimate-title">Estimate shipping and tax</span>
                            <p>Enter your destination to get shipping and tax.</p>
                        </th>
                    </tr>
                    </thead><!-- /thead -->
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <label class="info-title control-label">Country <span>*</span></label>
                                <select class="form-control unicase-form-control selectpicker">
                                    <option>--Select options--</option>
                                    <option>India</option>
                                    <option>SriLanka</option>
                                    <option>united kingdom</option>
                                    <option>saudi arabia</option>
                                    <option>united arab emirates</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="info-title control-label">State/Province <span>*</span></label>
                                <select class="form-control unicase-form-control selectpicker">
                                    <option>--Select options--</option>
                                    <option>TamilNadu</option>
                                    <option>Kerala</option>
                                    <option>Andhra Pradesh</option>
                                    <option>Karnataka</option>
                                    <option>Madhya Pradesh</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="info-title control-label">Zip/Postal Code</label>
                                <input type="text" class="form-control unicase-form-control text-input" placeholder="">
                            </div>
                            <div class="pull-right">
                                <button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- /.estimate-ship-tax -->

            <div class="col-md-4 col-sm-12 estimate-ship-tax">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <span class="estimate-title">Discount Code</span>
                            <p>Enter your coupon code if you have one..</p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control unicase-form-control text-input" placeholder="You Coupon..">
                            </div>
                            <div class="clearfix pull-right">
                                <button type="submit" class="btn-upper btn btn-primary">APPLY COUPON</button>
                            </div>
                        </td>
                    </tr>
                    </tbody><!-- /tbody -->
                </table><!-- /table -->
            </div><!-- /.estimate-ship-tax -->

            <div class="col-md-4 col-sm-12 cart-shopping-total">
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <div class="cart-sub-total">
                                Subtotal<span class="inner-left-md">&#2547;&nbsp;{{ Cart::getSubTotal() }}</span>
                            </div>
                            <div class="cart-grand-total">
                                Grand Total<span class="inner-left-md">&#2547;&nbsp;{{ Cart::getTotal() }}</span>
                            </div>
                        </th>
                    </tr>
                    </thead><!-- /thead -->
                    <tbody>
                    <tr>
                        <td>
                            <div class="cart-checkout-btn pull-right">
                                <button type="submit" class="btn btn-primary checkout-btn">PROCCED TO CHEKOUT</button>
                                <span class="">Checkout with multiples address!</span>
                            </div>
                        </td>
                    </tr>
                    </tbody><!-- /tbody -->
                </table><!-- /table -->
            </div><!-- /.cart-shopping-total -->
        </div><!-- /.shopping-cart -->
    @endif


</div>

@endsection

@push('js')
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
@endpush


