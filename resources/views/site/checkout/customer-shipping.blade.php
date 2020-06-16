@extends('site.components.site-master')

@section('title', 'Customer Shipping Info | Lara-Ecomm')

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='{{ request()->is('checkout/customer-shipping') ? 'active' : '' }}'><a href="{{ route('site.checkout.customer-shipping') }}">Customer Shipping Info</a></li>
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
                <h4 class="checkout-subtitle">Customer Shipping Information Form</h4>
                <p class="text title-tag-line">Enter Your Shipping Details.</p>

                @includeIf('messages.show-message')

                <form class="register-form outer-top-xs" role="form" action="{{ route('site.checkout.customer-shipping.info') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label class="info-title" for="name">Name <span>*</span></label>
                        <input type="text" name="name" class="form-control unicase-form-control text-input" id="name" value="{{ $customer_info->name }}" placeholder="Enter Your Full Name">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="email">Email Address <span>*</span></label>
                        <input type="email" name="email" class="form-control unicase-form-control text-input" id="email" value="{{ $customer_info->email }}" placeholder="Enter Email Address">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="phone">Phone Number <span>*</span></label>
                        <input type="number" name="phone" class="form-control unicase-form-control text-input" id="phone" value="{{ $customer_info->phone }}" pattern="01[0|3|5|6|7|8|9][0-9]{8}" placeholder="Enter Mobile Number">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="address">Delivery Address <span>*</span></label>
                        <textarea name="address" class="form-control unicase-form-control text-input" id="address" cols="30" rows="10" placeholder="Enter Your Delivery Address">{{ old('address') }}</textarea>

                    </div>


                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Next Step</button>
                </form>


            </div>
            <!-- create a new account -->
        </div><!-- /.row -->
    </div><!-- /.sigin-in-->

@endsection


@push('js')
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
    </script>
@endpush



