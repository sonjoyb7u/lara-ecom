@extends('site.components.site-master')

@section('title', 'Order Tracker Status | Lara-Ecomm')

@push('css')

@endpush

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('site.index') }}">Home</a></li>
                    <li class='{{ request()->is('order/track') ? 'active' : '' }}'><a href="{{ route('site.order.track') }}"> Track your orders Status</a></li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
@endsection

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-12 homebanner-holder">

        <div class="track-order-page">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h2 class="heading-title">Track your Order Status</h2>
                    <div class="panel panel-success">
                        <div class="panel-heading">Status</div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th  class="text-center">Order Status</th>
                                        <th  class="text-center">Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($order_status as $status)
                                    <tr>
                                        <td  class="text-center">{{ $status->status }}</td>
                                        <td  class="text-center">{{ $status->payment->status }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->

        </div><!-- /.sigin-in-->

        <div class="clearfix"></div>

    </div>
    <!-- /.homebanner-holder -->
@endsection


@push('js')

@endpush



