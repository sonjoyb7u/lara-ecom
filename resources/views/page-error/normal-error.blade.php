@extends('site.components.site-master')

@section('title', 'Bad Request | Lara-Ecomm')


@section('content')
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="x-page inner-bottom-sm">
                <div class="row">
                    <div class="col-md-12 x-text text-center">
                        <h1 style="font-size: 100px;">Please Stop</h1>
                        <h3 class="text-center text-danger">Don't do this, Bad Request!</h3>
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

