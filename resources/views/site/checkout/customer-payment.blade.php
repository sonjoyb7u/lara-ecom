@extends('site.components.site-master')

@section('title', 'Customer Shipping Info | Lara-Ecomm')

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('site.index') }}">Home</a></li>
                    <li class='{{ request()->is('checkout/customer-payment') ? 'active' : '' }}'><a href="{{ route('site.checkout.customer-payment') }}">Customer Payment Detail</a></li>
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
                <h4 class="checkout-subtitle">Customer Payment Detail Form</h4>
                <p class="text title-tag-line">Enter Your Payment Option : </p>

                @includeIf('messages.show-message')

                <form class="register-form outer-top-xs" role="form" action="{{ route('site.checkout.customer-order') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label class="radio-inline">
                            <input type="radio" name="type" value="cash">Cash On Delivery
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="bkash">bKash Payment
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="type" value="rocket">Rocket Payment
                        </label>
                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Place Your Order</button>
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



