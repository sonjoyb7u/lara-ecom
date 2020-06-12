@extends('site.components.site-master')

@section('title', 'Checkout | Lara-Ecomm')

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='{{ request()->is('checkout') ? 'active' : '' }}'><a href="{{ route('site.checkout') }}">Checkout</a></li>
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
            <div class="col-md-6 col-sm-6 sign-in">
                <h4 class="">Sign in</h4>
                <p class="">Hello, Welcome to your Login Info.</p>
                <div class="social-sign-in outer-top-xs">
                    <a href="#" class="google-sign-in"><i class="fa fa-google"></i> Sign In with Google</a>
                    <a href="#" class="facebook-sign-in"><i class="fa fa-facebook"></i> Sign In with Facebook</a>
                    <a href="#" class="twitter-sign-in"><i class="fa fa-twitter"></i> Sign In with Twitter</a>
                </div>
                <form class="register-form outer-top-xs" role="form">
                    <div class="form-group">
                        <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                        <input type="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
                        <input type="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" >
                    </div>
                    <div class="radio outer-xs">
                        <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">Remember me!
                        </label>
                        <a href="#" class="forgot-password pull-right">Forgot your Password?</a>
                    </div>
                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                </form>
            </div>
            <!-- Sign-in -->

            <!-- create a new account -->
            <div class="col-md-6 col-sm-6 create-new-account">
                <h4 class="checkout-subtitle">Create a new account</h4>
                <p class="text title-tag-line">Create your new account.</p>

                @includeIf('messages.show-message')

                <form class="register-form outer-top-xs" role="form" action="{{ route('site.customer.register') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label class="info-title" for="name">Name <span>*</span></label>
                        <input type="text" name="name" class="form-control unicase-form-control text-input" id="name" value="{{ old('name') }}" placeholder="Enter Your Full Name">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="email">Email Address <span>*</span></label>
                        <input type="email" name="email" class="form-control unicase-form-control text-input" id="email" value="{{ old('email') }}" placeholder="Enter Email Address">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="phone">Phone Number <span>*</span></label>
                        <input type="number" name="phone" class="form-control unicase-form-control text-input" id="phone" value="{{ old('phone') }}" pattern="01[0|3|5|6|7|8|9][0-9]{8}" placeholder="Enter Mobile Number">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="password">Password <span>*</span></label>
                        <input type="password" name="password" class="form-control unicase-form-control text-input" id="password" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
                        <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="password_confirmation" placeholder="Enter Confirm Password">
                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                </form>


            </div>
            <!-- create a new account -->
        </div><!-- /.row -->
    </div><!-- /.sigin-in-->

@endsection


