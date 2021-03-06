@extends('site.components.site-master')

@section('title', 'Customer Register | Lara-Ecomm')

@push('css')
    <style>
        .create-new-account {
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
                    <li class='{{ request()->is('customer/register') ? 'active' : '' }}'><a href="{{ route('site.customer.register') }}">Customer Register</a></li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
@endsection

@section('content')

    <!-- create a new account -->
    <div class="col-md-6 col-sm-6 col-md-offset-3 sign-in-page">
        <div class="row">

            <div class="create-new-account">
                <h4 class="checkout-subtitle">Create Account</h4>
                <p class="text title-tag-line">Create your new account.</p>

                @includeIf('messages.show-message')

                <form class="register-form outer-top-xs" role="form" action="{{ route('site.customer.register') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="name"><i class="fa fa-user"></i></span>
                            <input type="text" name="name" class="form-control unicase-form-control text-input"  aria-describedby="name" id="name" value="{{ old('name') }}" placeholder="Enter Your Full Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="email"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control unicase-form-control text-input"  aria-describedby="email" id="email" value="{{ old('email') }}" placeholder="Enter Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="phone"><i class="fa fa-phone"></i></span>
                            <input type="number" name="phone" class="form-control unicase-form-control text-input"  aria-describedby="phone" id="phone" value="{{ old('phone') }}" pattern="01[0|3|5|6|7|8|9][0-9]{8}" placeholder="Enter Mobile Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon" id="password"><i class="fa fa-unlock-alt"></i></span>
                            <input type="password" name="password" class="form-control unicase-form-control text-input" aria-describedby="password" id="password" placeholder="Enter Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
{{--                            <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>--}}
                            <span class="input-group-addon" id="password_confirmation"><i class="fa fa-unlock-alt"></i></span>
                            <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" aria-describedby="password_confirmation" id="password_confirmation" placeholder="Enter Confirm Password">
                        </div>
                    </div>

                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button" style="margin-bottom: 20px;">Sign Up</button>
                    <div>
                        <a href="{{ route('site.customer.login') }}" class="forgot-password">Have an account, Please&nbsp;<span style="color: #59B210; font-weight: bold">Login</span></a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- create a new account -->

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

