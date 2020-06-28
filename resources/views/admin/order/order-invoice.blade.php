
@extends('admin.components.admin-master')

@section('title', 'Order Invoice | Lara-Ecomm')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/invoice/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/vendor/invoice/css/print.css') }}">
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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.order.order-invoice', base64_encode($order->id)) : route('admin.order.order-invoice', base64_encode($order->id)) }}"><i class="fa fa-tasks"></i>Order Invoice</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">

                @includeIf('messages.show-message')

                <h3 class="section-subtitle"><b>ORDER INVOICE SHOW</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div id="page-wrap">
                            <h3 id="header">INVOICE</h3>

                            <div id="identity">

                                <p id="address">
                                    799/A, 1 No Lane,<br>
                                    Dhumpara, Chittagong Wasa,<br>
                                    Bangladesh.<br>
                                    +(880) 123-456
                                    +(880) 456-789
                                    lara.ecomm@gmail.com
                                </p>

                                <div id="logo">
                                    <img id="image" src="{{ asset('assets/site/images/logo-2.png') }}" alt="Lara-Ecomm logo" /><br>
                                </div>

                            </div>

                            <div style="clear:both"></div>

                            <div id="customer">

                                <p id="customer-title">
                                    Name : {{ $order->customer->name }}<br>
                                    Email : {{ $order->customer->email }}<br>
                                    Mobile No. : {{ $order->customer->phone }}<br>
                                </p>

                                <table id="meta">
                                    <tr>
                                        <td class="meta-head">Invoice #</td>
                                        <td><textarea>{{ $order->id }}</textarea></td>
                                    </tr>
                                    <tr>

                                        <td class="meta-head">Date</td>
                                        <td><textarea id="date">{{ date('F d(D) Y', strtotime($order->created_at)) }}</textarea></td>
                                    </tr>
                                    <tr>
                                        <td class="meta-head">Amount Due</td>
                                        <td><div class="due">&#2547;{{ $order->total + $order->shipping->shipping_charge }}.00</div></td>
                                    </tr>

                                </table>

                            </div>

                            <table id="items">

                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Unit Cost</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>

                                @foreach($order->orderItems as $product_item)
                                <tr class="item-row">
                                    <td class="item-name"><div class="delete-wpr"><textarea>{{ $product_item->product_name }}</textarea><a class="delete" href="javascript:void(0);" title="Remove row">X</a></div></td>
                                    <td class="description"><textarea>NA</textarea></td>
                                    <td><textarea class="cost">&#2547;{{ $product_item->product_price }}</textarea></td>
                                    <td><textarea class="qty">{{ $product_item->product_qty }}</textarea></td>
                                    <td><span class="price">
                                            &#2547;{{ $product_item->product_price *  $product_item->product_qty  }}.00
                                        </span></td>
                                </tr>
                                @endforeach

                                <tr id="hiderow">
                                    <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="blank"> </td>
                                    <td colspan="2" class="total-line">Subtotal</td>
                                    <td class="total-value"><div id="subtotal">&#2547;{{ $order->total  }}</div></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="blank"> </td>
                                    <td colspan="2" class="total-line">Shipping Charge</td>
                                    <td class="total-value"><div id="ship_charge">&#2547;{{ $order->shipping->shipping_charge  }}.00</div></td>
                                </tr>
                                <tr>

                                    <td colspan="2" class="blank"> </td>
                                    <td colspan="2" class="total-line">Total</td>
                                    <td class="total-value"><div id="total">&#2547;{{ $order->total + $order->shipping->shipping_charge  }}.00 </div></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="blank"> </td>
                                    <td colspan="2" class="total-line">Amount Paid</td>

                                    <td class="total-value"><textarea id="paid">$0.00</textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="blank"> </td>
                                    <td colspan="2" class="total-line balance">Balance Due</td>
                                    <td class="total-value balance"><div class="due">&#2547;{{ $order->total + $order->shipping->shipping_charge  }}.00</div></td>
                                </tr>

                            </table>

                            <div id="terms">
                                <h5>Terms</h5>
                                <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
                            </div>

                            <div class="row">
                                <a href="{{ route('super-admin.order.order-invoice-print', base64_encode($order->id)) }}" target="_blank" class="btn btn-primary btn-sm pull-right"><i class="fa fa-print">&nbsp;&nbsp;Print</i></a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/admin/vendor/invoice/js/example.js') }}"></script>
@endpush
