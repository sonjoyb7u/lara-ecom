@extends('site.components.site-master')

@section('title', 'Customer Account Verify | Lara-Ecomm')

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='{{ request()->is('customer-account-verify') ? 'active' : '' }}'><a href="{{ route('site.customer.account.verify') }}">Customer Account Varify</a></li>
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

            <!-- Sign-in -->
            <div class="col-md-6 col-sm-6 col-md-offset-3 sign-in">

                @includeIf('messages.show-message')

                <h4 class="">Account Verification Form</h4>
                <p class="">Hello, Welcome to input verify your account.</p>

                <form class="register-form outer-top-xs" role="form" action="{{ route('site.checkout.account.verify') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label class="info-title" for="email">Email Address <span>*</span></label>
                        <input type="email" name="email" class="form-control unicase-form-control text-input" id="email" placeholder="Enter Verify Email Address">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="verify_code">Verify Code <span>*</span></label>
                        <input type="number" name="verify_code" class="form-control unicase-form-control text-input" id="verify_code" placeholder="Enter Valid Verify Code">
                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Verify Your Account</button>
                </form>
            </div>
            <!-- Sign-in -->

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



