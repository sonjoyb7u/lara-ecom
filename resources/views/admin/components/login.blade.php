@extends('layouts.admin-master')

@section('title', 'Lara-Ecomm | Login( Admin/User )')


@section('login-form')
    <!--LOGO-->
    <div class="logo">
        <img alt="logo" src="{{ asset('assets/admin/images/logo-dark.png') }}" />
    </div>
    <div class="box">
        <!--SIGN IN FORM-->
        <div class="panel mb-none">
            <div class="panel-content bg-scale-0">
                <form>
                    <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" id="email" placeholder="Email">
                                <i class="fa fa-envelope"></i>
                            </span>
                    </div>
                    <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" id="password" placeholder="Password">
                                <i class="fa fa-key"></i>
                            </span>
                    </div>
                    <div class="form-group">
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" id="remember-me" value="option1" checked>
                            <label class="check" for="remember-me">Remember me</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="index.html" class="btn btn-primary btn-block">Sign in</a>
                    </div>
                    <div class="form-group text-center">
                        <a href="pages_forgot-password.html">Forgot password?</a>
                        <hr/>
                        <span>Don't have an account ?&nbsp;&nbsp;</span>
                        <a href="{{ route('register') }}" class="btn btn-block mt-sm">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
