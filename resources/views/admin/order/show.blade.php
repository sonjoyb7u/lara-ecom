@extends('admin.components.admin-master')

@section('title', 'Order Details | Lara-Ecomm')

@push('css')
    <style>
        .height {
            min-height: 200px;
        }
        .icon {
            font-size: 47px;
            color: #5CB85C;
        }
        .iconbig {
            font-size: 77px;
            color: #5CB85C;
        }
        .table > tbody > tr > .emptyrow {
            border-top: none;
        }
        .table > thead > tr > .emptyrow {
            border-bottom: none;
        }
        .table > tbody > tr > .highrow {
            border-top: 3px solid;
        }
        .table {
             margin-bottom: 0;
        }
        .form-group:last-child, .form-group:last-of-type {
             margin-bottom: 15px;
        }
    </style>
@endpush

@section('header')
    @includeIf('admin.components.partials.header')
@endsection

@section('left-sidebar')
    @includeIf('admin.components.partials.left-sidebar')
@endsection


@section('content')
    <div class="content">
        <!-- content HEADER -->
        <!-- ========================================================= -->
        <div class="content-header">
            <!-- leftside content header -->
            <div class="leftside-content-header">
                <ul class="breadcrumbs">
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.home') : route('admin.home') }}">Dashboard</a></li>
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.order.index') : route('admin.order.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Orders</a></li>
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.order.show', base64_encode($order->id)) : route('admin.order.show', base64_encode($order->id)) }}"><i class="fa fa-tasks"></i>Order Details</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">

                @includeIf('messages.show-message')

                <h3 class="section-subtitle"><b>ORDER DETAILS</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Order Details :</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="text-left">
                                    <h2>Invoice for purchase #{{ $order->id }}</h2>
                                </div>
                                <div class="">
                                    <a href="{{ route('super-admin.order.order-invoice', base64_encode($order->id)) }}" id="printInvoice" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Print</a>
                                    <button class="btn btn-info btn-sm"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                                </div>
                                <hr>

                                <div class="panel">
                                    <div class="panel-header">
                                        <h6><span>Edit Order Detail : </span></h6>
                                    </div>
                                    <div class="panel-content">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <form action="{{ route('super-admin.order.order-status-update') }}" method="post" class="form-horizontal">

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label class="input-group-addon" for="order_status">Order Status</label>
                                                                <select class="form-control order_status" name="order_status" id="order_status" data-id="{{ $order->id }}">
                                                                    <option value="">Choose Order Status</option>
                                                                    @foreach(orderStatus() as $o_status)
                                                                        <option value="{{ $o_status }}" {{ $order->status == $o_status ? 'selected' : '' }}>{{ $o_status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form action="{{ route('super-admin.order.payment-status-update') }}" method="post" class="form-horizontal">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label class="input-group-addon" for="payment_status">Payment Status</label>
                                                                <select class="form-control payment_status" name="payment_status" id="payment_status" data-id="{{ $order->payment->id }}">
                                                                    <option value="">Choose Payment Status</option>
                                                                    @foreach(paymentStatus() as $p_status)
                                                                        <option value="{{ $p_status }}" {{ $order->payment->status == $p_status ? 'selected' : '' }}>{{ $p_status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <form action="{{ route('super-admin.order.shipping-charge-update') }}" method="post" class="form-horizontal">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label class="input-group-addon" for="payment_status">Shipping Charge</label>
                                                                <input type="text" class="form-control shipping_charge" name="shipping_charge" id="shipping_charge" value="{{ $order->shipping->shipping_charge }}" data-id="{{ $order->shipping->id }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-sm-8">
                                                <form action="{{ route('super-admin.order.order-info-mail') }}" method="post" class="form-horizontal">
                                                    @csrf

                                                    <div class="col-sm-9">
                                                        <textarea class="form-control" name="order_info" id="" cols="30" rows="5">
                                                            Name : {{ $order->customer->name }}
                                                            Email : {{ $order->customer->email }}
                                                            Mobile No. : {{ $order->customer->phone }}
                                                            Address : {{ $order->shipping->address }}
                                                            Order Invoice No. : {{ $order->id }}
                                                            Product Infomation :
                                                            @foreach($order->orderItems as $orderItem)
                                                            Product Name. : {{ $orderItem->product_name }}
                                                            Product Qty. : {{ $orderItem->product_qty }}
                                                            @endforeach
                                                            Shipping Charge: {{ $charge = $order->shipping->shipping_charge }}
                                                            Total Price: {{ $order->total + $charge }}

                                                            Thanks for Shopping with Us.

                                                        </textarea>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="hidden" name="customer_id" value="{{ $order->customer->id }}">
                                                        <input type="submit" value="Send Mail" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6 pull-left">
                                        <div class="panel">
                                            <div class="panel-header panel-info">
                                                <h3 class="panel-title">Customer Info</h3>
                                                <div class="panel-actions">
                                                    <ul>
                                                        <li class="action toggle-panel panel-expand"><span></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="panel-content">
                                                <table class="table table-bordered table-hover">
                                                    <tr>
                                                        <td>Name :</td>
                                                        <td>{{ $order->customer->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email :</td>
                                                        <td>{{ $order->customer->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile No. :</td>
                                                        <td>{{ $order->customer->phone }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="panel">
                                            <div class="panel-header panel-info">
                                                <h3 class="panel-title">Order Information</h3>
                                                <div class="panel-actions">
                                                    <ul>
                                                        <li class="action toggle-panel panel-expand"><span></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="panel-content">
                                                <table class="table table-bordered table-hover">
                                                    <tr>
                                                        <td>Invoice No. :</td>
                                                        <td>{{ $order->id }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order Status :</td>
                                                        <td>
                                                            <span class="badge x-o {{ randomStatusColor($order->status) }}">{{ $order->status }}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Amount :</td>
                                                        <td>&#2547;{{ $order->total }}&nbsp;/=</td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-6">
                                        <div class="panel">
                                            <div class="panel-header panel-info">
                                                <h3 class="panel-title">Shipping Detail</h3>
                                                <div class="panel-actions">
                                                    <ul>
                                                        <li class="action toggle-panel panel-expand"><span></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="panel-content">
                                                <table class="table table-bordered table-hover">
                                                    <tr>
                                                        <td>Name :</td>
                                                        <td>{{ $order->shipping->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email :</td>
                                                        <td>{{ $order->shipping->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile No. :</td>
                                                        <td>{{ $order->shipping->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address. :</td>
                                                        <td>{{ $order->shipping->address }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-md-6 col-lg-6 pull-right">
                                        <div class="panel">
                                            <div class="panel-header panel-info">
                                                <h3 class="panel-title">Payment Information</h3>
                                                <div class="panel-actions">
                                                    <ul>
                                                        <li class="action toggle-panel panel-expand"><span></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="panel-content">
                                                <table class="table table-bordered table-hover">
                                                    <tr>
                                                        <td>Payemnt Type :</td>
                                                        <td>{{ $order->payment->type }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payemnt Status :</td>
                                                        <td>
                                                            <span class="badge x-o {{ randomStatusColor($order->payment->status) }}">{{ $order->payment->status }}</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-12">
                                <div class="panel">
                                    <div class="panel-header panel-info">
                                        <h3 class="panel-title">Order Items Information</h3>
                                        <div class="panel-actions">
                                            <ul>
                                                <li class="action toggle-panel panel-expand"><span></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-content">
                                        <table class="table table-condensed table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <td><strong>Item Name</strong></td>
                                                <td class="text-center"><strong>Unit Price</strong></td>
                                                <td class="text-center"><strong>Item Quantity</strong></td>
                                                <td class="text-right"><strong>Total</strong></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->orderItems as $orderItem)
                                                <tr>
                                                    <td>{{ $orderItem->product_name }}</td>
                                                    <td class="text-center">&#2547;{{ $orderItem->product_price }}</td>
                                                    <td class="text-center">{{ $orderItem->product_qty }}</td>
                                                    <td class="text-right">
                                                        @php
                                                        $price = 0;
                                                        $price = $orderItem->product_price * $orderItem->product_qty;
                                                        @endphp
                                                        &#2547;{{ $price }}&nbsp;/=</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="highrow"></td>
                                                <td class="highrow"></td>
                                                <td class="highrow text-center"><strong>Subtotal</strong></td>
                                                <td class="highrow text-right">
                                                    &#2547;{{ $order->total }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="emptyrow"></td>
                                                <td class="emptyrow"></td>
                                                <td class="emptyrow text-center"><strong>Shipping Charge</strong></td>
                                                <td class="emptyrow text-right">&#2547;{{ $order->shipping->shipping_charge }}</td>
{{--                                                <td id="ship_charge" style="display: none;"></td>--}}
                                            </tr>
                                            <tr>
                                                <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                                <td class="emptyrow"></td>
                                                <td class="emptyrow text-center"><strong>Total</strong></td>
                                                <td class="emptyrow text-right">&#2547;{{ $order->total + $order->shipping->shipping_charge }}.00</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@push('js')
    <script>
        $('body').on('change', '#order_status', function() {
            var token = $("meta[name='csrf-token']").attr('content');
            let id = $(this).data('id');
            let order_status = $(this).val();
            // alert(id);
            // $('.loader-overlay').show();
            $.ajax({
                type: 'POST',
                url: '/super-admin/orders/order-status-update',
                data: {_token: token, id: id, order_status: order_status},
                dataType: 'json',
                succces:function(response) {
                    // alert(response);
                    // $('.loader-overlay').hide();

                }, error:function() {
                    // alert('Error!');
                }
            });

        });

        $('body').on('change', '#payment_status', function() {
            var token = $("meta[name='csrf-token']").attr('content');
            let id = $(this).data('id');
            let payment_status = $(this).val();
            // alert(id);
            // $('.loader-overlay').show();
            $.ajax({
                type: 'POST',
                url: '/super-admin/orders/payment-status-update',
                data: {_token: token, id: id, payment_status: payment_status},
                dataType: 'json',
                succces:function(response) {
                    // alert(response);
                    // $('.loader-overlay').hide();

                }, error:function() {
                    // alert('Error!');
                }
            });

        });

        $('body').on('change', '#shipping_charge', function() {
            var token = $("meta[name='csrf-token']").attr('content');
            let id = $(this).data('id');
            let shipping_charge = $(this).val();
            // alert(id);
            // $('.loader-overlay').show();
            $.ajax({
                type: 'POST',
                url: '/super-admin/orders/shipping-charge-update',
                data: {_token: token, id: id, shipping_charge: shipping_charge},
                dataType: 'json',
                succces:function(response) {
                    // alert(response);
                    // $('.loader-overlay').hide();
                    // $('#ship_charge').val(shipping_charge);

                }, error:function() {
                    // alert('Error!');
                }
            });

        });
    </script>
@endpush


