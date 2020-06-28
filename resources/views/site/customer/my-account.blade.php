@extends('site.components.site-master')

@section('title', 'HOME || LARA-ECOMM')

@push('css')
    <style>
        .nav-tabs.my-account > li.active > a, .nav-tabs.my-account > li.active > a:hover, .nav-tabs.my-account > li.active > a:focus {
            color: #59B210;
        }
    </style>
@endpush

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('site.index') }}">Home</a></li>
                    <li class='{{ request()->is('customer/account/*') ? 'active' : '' }}'><a href="{{ route('site.customer.account', base64_encode($customer->id)) }}">Customer Account</a></li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
@endsection

@section('content')
<div class="col-sm-4 col-md-4">
    <div class="thumbnail">
        <a href="">
            <img src="{{ asset('uploads/images/customer/avataaars.png') }}" alt="Nature" width="200">
            <div class="caption">
                <h3><strong>Name: </strong> {{ $customer->name }}</h3>
                <h4><strong>Email: </strong>{{ $customer->email }}</h4>
                <p><strong>About: </strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa inventore laborum molestiae, molestias nisi rem rerum similique voluptatem? Accusamus cupiditate debitis eligendi eos.</p>
            </div>
        </a>
    </div>
</div>
<div class="col-sm-8 col-md-8">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4>MY ACCOUNT</h4>
        </div>
        <div class="panel-body">
            <p>To make the tabs toggleable, add the data-toggle="tab" attribute to each link. Then add a .tab-pane class with a unique ID for every tab and wrap them inside a div element with class .tab-content.</p>

            <ul class="nav nav-tabs my-account">
                <li class="active"><a data-toggle="tab" href="#myProfile">My Profile</a></li>
                <li><a data-toggle="tab" href="#myOrders">My Orders</a></li>
                <li><a data-toggle="tab" href="#changePassword">Change Password</a></li>
                <li><a data-toggle="tab" href="#optional">Optional</a></li>
            </ul>

            <div class="tab-content">
                <div id="myProfile" class="tab-pane fade in active">
                    <h3>My Profile</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div id="myOrders" class="tab-pane fade">
                    <h3>My Orders</h3>
                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div id="changePassword" class="tab-pane fade">
                    <h3>Change Password</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
                <div id="optional" class="tab-pane fade">
                    <h3>Optional</h3>
                    <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
    <script>

    </script>
@endpush
