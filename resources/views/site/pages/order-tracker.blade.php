@extends('site.components.site-master')

@section('title', 'Order Tracker Check | Lara-Ecomm')

@push('css')

@endpush

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                        <li><a href="{{ route('site.index') }}">Home</a></li>
                        <li class='{{ request()->is('order/track') ? 'active' : '' }}'><a href="{{ route('site.order.track') }}"> Track your orders</a></li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
@endsection

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

        <div class="track-order-page">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="heading-title">Track your Order</h2>
                    <span class="title-tag inner-top-ss">Please enter your Order ID in the box below and press Enter. This was given to you on your receipt and in the confirmation email you should have received. </span>
                    <form class="register-form outer-top-xs" role="form" action="{{ route('site.order.track.check') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label class="info-title" for="order_id">Order ID</label>
                            <input type="text" name="order_id" class="form-control unicase-form-control text-input" id="order_id" placeholder="Enter Your Order Number">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="email">Billing Email</label>
                            <input type="email" class="form-control unicase-form-control text-input" id="email" disabled>
                        </div>
                        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Track</button>
                    </form>
                </div>
            </div><!-- /.row -->

        </div><!-- /.sigin-in-->

        <div class="clearfix"></div>

    </div>
    <!-- /.homebanner-holder -->
@endsection


@push('js')

@endpush


