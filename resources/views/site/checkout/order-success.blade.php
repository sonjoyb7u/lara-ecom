@extends('site.components.site-master')

@section('title', 'Customer Shipping Info | Lara-Ecomm')

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('site.index') }}">Home</a></li>
                    <li class='active'><a href="#">Customer Order Success</a></li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
@endsection

@section('content')
    <div class="sign-in-page">
        <div class="row">
            <!-- create a new account -->
            <div class="col-md-6 col-sm-6 col-md-offset-3 create-new-account">
                <h4 class="checkout-subtitle text-center"><span style="color: limegreen;">Congratulation,</span> Mr./Miss. &nbsp;<strong>{{ $customer_detail->name }}</strong></h4>

                @foreach($order_item_details as $order_item_detail)
                <h5 class="text-center">Product Name: {{ $order_item_detail->product_name }}</h5>
                <h5 class="text-center">Product Quantity: {{ $order_item_detail->product_qty }}</h5>
                <h5 class="text-center">Product Price: {{ $order_item_detail->product_price }}</h5>
                @endforeach
                <hr>
                <h5 class="text-center">Total Quantity : {{ $cart_total_qty }}</h5>
                <h5 class="text-center">Total Amount : {{ $cart_total_price }}</h5>
                <p class="text title-tag-line text-center">Your Order is Confirmed Successfully Done, Thanks for Shopping to our Lara Ecomm Application.</p>

            </div>
            <!-- create a new account -->
        </div><!-- /.row -->
    </div><!-- /.sigin-in-->

@endsection



