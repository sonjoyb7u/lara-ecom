@extends('site.components.site-master')

@section('title', 'Not Authorized/Forbidden | Lara-Ecomm')


@section('content')
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="x-page inner-bottom-sm">
                <div class="row">
                    <div class="col-md-12 x-text text-center">
                        <h1>403</h1>
                        <h3 class="text-center text-danger">Not Authorized/Forbidden!</h3>
                        <p>We are sorry, the page you've requested is not available. </p>
                        <form role="form" class="outer-top-vs outer-bottom-xs">
                            <input placeholder="Search" autocomplete="off">
                            <button class="  btn-default le-button">Go</button>
                        </form>
                        <a href="{{ route('site.index') }}"><i class="fa fa-home"></i> Go To Homepage</a>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.sigin-in-->
        </div><!-- /.container -->
    </div><!-- /.body-content -->

@endsection
