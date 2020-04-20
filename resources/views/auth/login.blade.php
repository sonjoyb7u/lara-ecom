@extends('admin.components.admin-master')

@section('title', 'Lara-Ecomm | Login( Admin/User )')

@section('login-form')
 <!--LOGO-->
<div class="logo">
    <img alt="logo" src="{{ asset('assets/site/images/logo-2.png') }}" />
</div>
<div class="box">
    <!--SIGN IN FORM-->
    <div class="panel mb-none">
        <div class="panel-content bg-scale-0">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mt-md">
                    <span class="input-with-icon">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <i class="fa fa-envelope"></i>
                    </span>
                </div>
                <div class="form-group">
                    <span class="input-with-icon">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <i class="fa fa-key"></i>
                    </span > 
                </div>
                <div class="form-group">
                    <div class="checkbox-custom checkbox-primary">
                        <input class="form-check-input" type="checkbox" name="remember" value="" id="remember-me" {{ old('remember') ? 'checked' : '' }}>
                        <label class="check" for="remember-me">Remember me</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Sign in') }}
                    </button>
                </div>  
                <div class="form-group text-center">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password ?') }}
                        </a>
                    @endif
                    <hr/>
                    <span>Don't have an account ?&nbsp;&nbsp;</span>
                    <a href="{{ route('register') }}" class="btn btn-block mt-sm">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
