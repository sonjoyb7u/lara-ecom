@extends('admin.components.admin-master')

@section('title', 'Manage Products | Lara-Ecomm')


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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.index') : route('admin.product.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Products</a></li>
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.index') : route('admin.product.index') }}"><i class="fa fa-tasks"></i>Manage Products</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>PRODUCT LISTS</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Manage Products :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.create') : route('admin.product.create') }}" class="btn btn-primary">Add Product</a>
                            </div>
                        </div>

                        <!--SEARCHING, ORDENING & PAGING-->
                        <div class="table-responsive">
                            <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Product Added By</th>
                                    <th>Brand Name</th>
                                    <th>Category Name</th>
                                    <th>Product Title</th>
                                    <th>Product Description</th>
                                    <th>Product Code</th>
                                    <th>Available</th>
                                    <th>Product Image's</th>
                                    <th>Quantity</th>
                                    <th>Original Price</th>
                                    <th>Sales Price</th>
                                    <th>Offer Price</th>
                                    <th>Total Price</th>
                                    <th>Product is New?</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if($product->user->id)
                                        {{ $product->user->is_admin === 1 ? 'Super Admin' : 'Admin' }}
                                        @else
                                        No User Found Yet.
                                        @endif
                                    </td>
                                    <td>{{ $product->brand->brand_name }}</td>
                                    <td>{{ $product->category->category_name }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ substr($product->title, 0, 50).' ... ... ' }}</td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ ucwords($product->available) }}</td>
                                    <td>
                                        @php
                                            $images = json_decode($product->image)
                                        @endphp
                                        @if($images)
                                        @foreach($images as $image)
                                            <img width="120" height="60" src="{{ asset('uploads/images/product/'.$image) }}" alt="{{ $image }}">
                                        @endforeach
                                        @else
                                            <img width="120" height="60" src="{{ asset('uploads/images/slider/'.$product->image) }}" alt="{{ $product->image }}">
                                        @endif
                                    </td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->original_price }}</td>
                                    <td>{{ $product->sales_price }}</td>
                                    <td>{{ $product->offer_price }}</td>
                                    <td>{{ $product->total_price }}</td>
                                    <td>
                                        {{ $product->is_new === 1 ? 'YES' : "NO" }}
                                    </td>
                                    <td>
                                        @if(auth()->user()->is_admin === 1)
                                        <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $product->status === 'active' ? 'checked' : '' }} id="productStatus" data-id="{{ $product->id }}">
                                        @else
                                        <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $slider->status === 'active' ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled="">
                                        @endif

                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.show') : route('admin.product.show') }}"><i class="fa fa-eye"></i></a>

                                        @if(auth()->user()->is_admin === 1)

                                        <a class="btn btn-info btn-sm" href="{{ route('super-admin.product.edit', base64_encode($product->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <span style="display: inline-block">
                                        <form action="{{ route('super-admin.product.delete', base64_encode($product->id)) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button style="margin-top: -10px;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Want To Delete This Product ?')"><i class="fa fa-trash-o"></i></button>
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
    <div style="margin-top: -70px;" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
    </div>

@endsection
