@extends('admin.components.admin-master')

@section('title', 'Manage Orders | Lara-Ecomm')

@push('css')

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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.order.index') : route('admin.order.index') }}"><i class="fa fa-tasks"></i>Manage Orders</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated">
            <div class="col-sm-12 col-md-12">

                @includeIf('messages.show-message')

                <h3 class="section-subtitle"><b>ORDER LISTS</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Manage Orders :</h4>
                            </div>
                        </div>

                        <!--SEARCHING, ORDENING & PAGING-->
                        <div class="table-responsive">
                            <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Order Id</th>
                                    <th>Order Date</th>
                                    <th>Order Status</th>
                                    <th>Cus. Name</th>
                                    <th>Cus. Contact</th>
                                    <th>Shipp. Addr.</th>
                                    <th>Pay. Type</th>
                                    <th>Pay. Status</th>
                                    <th>Pro. Name</th>
                                    <th>Pro. Qty</th>
                                    <th>Product Image</th>
                                    <th>Original Price</th>
                                    <th>Sales Price</th>
                                    <th>Spec. Price</th>
                                    <th>Spec. Price Duration</th>
                                    <th>Total Order(qty)</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ date('Y-m-d(D)', strtotime($order->created_at)) }}</td>
                                    <td>
                                        <span class="badge x-o {{ randomStatusColor($order->status) }}">{{ $order->status }}</span>
                                    </td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->customer->phone }}</td>
                                    <td>{{ $order->shipping->address }}</td>
                                    <td>
{{--                                        @foreach($order->payments as $payment)--}}
{{--                                            {{ $payment->type }} <br>--}}
{{--                                        @endforeach--}}
                                        {{ $order->payment->type }}
                                    </td>
                                    <td>
                                        @if(auth()->user()->is_admin === 1)
                                            <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Success" data-off="Pending" {{ $order->payment->status === 'success' ? 'checked' : '' }} id="paymentStatus" data-id="{{ $order->payment->id }}">
                                        @else
                                            <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Success" data-off="Pending" {{ $order->payment->status === 'success' ? 'checked' : '' }} id="paymentStatus" data-id="{{ $order->payment->id }}" onclick="return confirm('You have Not Authorized To Access This Action!')" disabled="">
                                        @endif
                                    </td>
{{--                                    <td>--}}
{{--                                        @foreach($order->payments as $payment)--}}
{{--                                            {{ $payment->status }} <br>--}}
{{--                                        @endforeach--}}
{{--                                        {{ $order->p_status }}--}}
{{--                                    </td>--}}
                                    <td>
                                        @foreach($order->orderItems as $item)
                                        {{ $loop->iteration }}. {{ $item->product_name }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @php($product_qty = 0)
                                        @foreach($order->orderItems as $item)
                                            @php($product_qty += $item->product_qty)
                                        @endforeach
                                        {{ $product_qty }}
                                    </td>
                                    <td>
                                        @foreach($order->orderItems as $order_item)
                                        <img width="80" height="70" src="{{ asset('uploads/images/product/images/'.$order_item->product->image) }}" alt="{{ $order_item->product->image }}">
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->orderItems as $order_item)
                                            {{ $order_item->product->original_price }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->orderItems as $order_item)
                                            {{ $order_item->product->sales_price }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->orderItems as $order_item)
                                            @if($order_item->product->special_start && $order_item->product->special_end)
                                            {{ $order_item->product->special_price }} <br>
                                            @else
                                                No Special Price <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->orderItems as $order_item)
                                            @if($order_item->product->special_start && $order_item->product->special_end)
                                            {{ $order_item->product->special_start . ' - ' .  $order_item->product->special_end  }} <br>
                                            @else
                                                No Special Date <br>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @php($total_order_qty = 0)
                                        @foreach($order->orderItems as $order_item)
                                            @php($total_order_qty += $order_item->product_qty)
                                        @endforeach
                                        {{ $total_order_qty }}
                                    </td>
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.order.show', base64_encode($order->id)) : route('admin.order.show', base64_encode($order->id)) }}" data-toggle="tooltip" data-placement="top" title="Order Info Details"><i class="fa fa-eye"></i></a>

                                        @if(auth()->user()->is_admin === 1)

                                        <a class="btn btn-info btn-sm" href="{{ route('super-admin.order.order-invoice', base64_encode($order->id)) }}"  data-toggle="tooltip" data-placement="top" title="Invoice Order Info"><i class="fa fa-file"></i></a>
                                        <a class="btn btn-warning btn-sm" id="editOrder" data-id="{{ $order->id }}" data-order-status={{ $order->status }} data-payment-status={{ $order->payment->status }}  data-toggle="tooltip" data-placement="top" title="Edit Order"><i class="fa fa-pencil-square-o"></i></a>
                                        <span style="display: inline-block">
                                        <button style="margin-top: -10px;" type="submit" class="btn btn-danger btn-sm" id="deleteOrder" data-id="{{ base64_encode($order->id) }}"  data-toggle="tooltip" data-placement="top" title="Order Delete"><i class="fa fa-trash-o"></i></button>
                                        </span>

                                        @else
                                        <a class="btn btn-info btn-sm" href="javascript:avoid(0)" onclick="return confirm('You have Not Authorized To Access This Action!')" disabled=""><i class="fa fa-pencil-square-o"></i></a>

                                        <a class="btn btn-danger btn-sm" href="javascript:avoid(0)" onclick="return confirm('You have Not Authorized To Access This Action!')" disabled=""><i class="fa fa-trash-o"></i></a>

                                        @endif

                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Order Modal -->
    <div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="modal-default-label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header state modal-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal-default-label">Default modal</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal col-md-offset-1" action="{{ route('super-admin.order.update') }}" method="post">
                        @csrf

                        <h5 class="mb-lg">To enjoy more, Edit Order!</h5>
                        <div class="form-group">
                            <label for="order_status" class="col-sm-4 control-label">Order Status</label>
                            <div class="col-sm-6">
                                <select class="form-control order_status" name="order_status" id="order_status">
                                    <option value="">Choose Order Status</option>
                                    @foreach(orderStatus() as $o_status)
                                        <option value="{{ $o_status }}">{{ $o_status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment_status" class="col-sm-4 control-label">Payment Status</label>
                            <div class="col-sm-6">
                                <select class="form-control payment_status" name="payment_status" id="payment_status">
                                    <option value="">Choose Payment Status</option>
                                    @foreach(paymentStatus() as $p_status)
                                        <option value="{{ $p_status }}">{{ $p_status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="modal-footer col-sm-offset-2 col-sm-8 col-md-8 col-md-offset-2 text-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <input type="hidden" class="id" name="id" id="id">
                                <button type="submit" class="btn btn-primary">Update Order</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>
        $(document).ready(function () {
            $('body').on('click', '#editOrder', function () {
                $('#editOrderModal').modal('show');
                var token = $("meta[name='csrf-token']").attr('content');
                var id = $(this).data('id');
                var orderStatus = $(this).data('order-status');
                var paymentStatus = $(this).data('payment-status');
                // console.log(token);
                $('#id').val(id);
                $('#order_status').val(orderStatus);
                $('#payment_status').val(paymentStatus);

                let m_id = $('.id').val();
                let m_order_status = $('.order_status').val();
                let m_payment_status = $('.payment_status').val();
                // console.log(m_id);

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '/super-admin/orders/update',
                    data: {_token: token, id: m_id, order_status: m_order_status, payment_status: m_payment_status},
                    success: function (response) {
                        console.log(response);
                    },
                    error: function () {
                        // alert('Error!');
                    }
                });
            });
        });
    </script>
@endpush




