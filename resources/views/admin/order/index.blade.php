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
        <div class="row animated fadeInUp">
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
                                    <th>Customer Name</th>
                                    <th>Customer Contact</th>
                                    <th>Shipping Address</th>
                                    <th>Order Payment Type</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Product Image</th>
                                    <th>Original Price</th>
                                    <th>Sales Price</th>
                                    <th>Special Price</th>
                                    <th>Special Price Duration</th>
                                    <th>Total Order(qty)</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ date('Y-m-d(D)', strtotime($order->created_at)) }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->customer->phone }}</td>
                                    <td>{{ $order->shipping->address }}</td>
                                    <td>
                                        @foreach($order->payments as $payment)
                                            {{ $payment->type }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->orderItems as $item)
                                        {{ $loop->iteration }}. {{ $item->product_name }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->orderItems as $item)
                                            {{ $item->product_qty }} <br>
                                        @endforeach
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
                                            {{ $order_item->product->special_price }} <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($order->orderItems as $order_item)
                                            @if($order_item->product->special_start && $order_item->product->special_end)
                                            {{ $order_item->product->special_start . ' - ' .  $order_item->product->special_end  }} <br>
                                            @else
                                                No Special Date
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>Total Order(Qty)</td>
                                    <td>{{ $order->total }}</td>
                                    <td>
                                        @if(auth()->user()->is_admin === 1)
                                        <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Success" data-off="Pending" {{ $order->status === 'success' ? 'checked' : '' }} id="orderStatus" data-id="{{ $order->id }}">
                                        @else
                                        <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $order->status === 'active' ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled="">
                                        @endif

                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.order.show', base64_encode($order->id)) : route('admin.order.show', base64_encode($order->id)) }}"><i class="fa fa-eye"></i></a>

                                        @if(auth()->user()->is_admin === 1)

                                        <a class="btn btn-info btn-sm" href="{{ route('super-admin.order.edit', base64_encode($order->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <span style="display: inline-block">
                                        <form action="{{ route('super-admin.order.delete', base64_encode($order->id)) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button style="margin-top: -10px;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Want To Delete This Order ?')"><i class="fa fa-trash-o"></i></button>
                                        </form>
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
                        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider Modal -->
    {{-- <div style="margin-top: -70px;" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div style="padding: 0; border-bottom: 0; margin-right: -200px;" class="modal-header">
                <button style="background: #2adcb7; padding: 2px; color: #59b210;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img width="135%" height="auto" id="slider-popup" src="" alt="Slider Image">
            </div>
            <div style="padding: 0; border-top: 0; margin-right: -185px;" class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm">Delete</button>
            </div>
        </div>
    </div> --}}

@endsection
