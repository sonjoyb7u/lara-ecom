@extends('site.components.site-master')

@section('title', 'Checkout Login | Lara-Ecomm')

@push('css')
    <style>
        .sign-in {
            padding: 30px;
        }
    </style>
@endpush

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('site.index') }}">Home</a></li>
                    <li class='{{ request()->is('checkout/login') ? 'active' : '' }}'><a href="{{ route('site.checkout.login') }}">Checkout Login</a></li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
@endsection

@section('content')
    <div class="col-md-6 col-sm-6 col-md-offset-3 sign-in-page">
        <div class="row">
            <!-- Sign-in -->
            <div class="sign-in">
                <h4 class="">Sign in</h4>
                <p class="">Hello, Welcome to your Login Info.</p>
                <div class="social-sign-in outer-top-xs">
                    <a href="#" class="google-sign-in"><i class="fa fa-google"></i> Sign In with Google</a>
                    <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                    <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                </div>
{{--                @if(Session()->has('Error'))--}}
{{--                    <div class="alert alert-danger fade in">--}}
{{--                        <a href="#" class="close" data-dismiss="alert">&times;</a>--}}
{{--                        {{ Session('Error') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
                @includeIf('messages.show-message')

                <form class="register-form outer-top-xs" role="form" action="{{ route('site.checkout.login') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label class="info-title" for="email">Email Address <span>*</span></label>
                        <input type="text" name="email" class="form-control unicase-form-control text-input" id="email" value="{{ old('email') }}" placeholder="Enter Email Address">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="password">Password <span>*</span></label>
                        <input type="password" name="password" class="form-control unicase-form-control text-input" id="password" placeholder="Enter Valid Password">
                    </div>
                    <div class="radio outer-xs">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember me!
                        </label>
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button" style="margin-bottom: 20px;">Login</button>
                    <div>
                        <a href="#" class="forgot-password pull-left" style="font-weight: bold;">Forgot your Password ?</a>
                        <a href="{{ route('site.checkout.register') }}" class="forgot-password pull-right">New Register ?&nbsp;<span style="color: #59B210;">Click here</span></a>
                    </div>

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


