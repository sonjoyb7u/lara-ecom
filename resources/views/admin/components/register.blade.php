@extends('layouts.admin-master')

@section('title', 'Lara-Ecomm | Register( Admin/User )')


@section('register-form')
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
                            <input type="text" class="form-control" id="name" placeholder="Name">
                            <i class="fa fa-user"></i>
                        </span>
                </div>
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
                        <span class="input-with-icon">
                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm Password">
                            <i class="fa fa-key"></i>
                        </span>
                </div>
                <div class="form-group">
                    <div class="checkbox-custom checkbox-primary">
                        <input type="checkbox" id="terms" value="option1">
                        <label class="check" for="terms">I agree </label>  to the <a href="#">Terms and Conditions</a>
                    </div>
                </div>
                <div class="form-group">
                    <a href="index.html" class="btn btn-primary btn-block">Register</a>
                </div>
                <div class="form-group text-center">
                    Have an account ?, please&nbsp;&nbsp;<a href="{{ route('login') }}">Sign In</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
