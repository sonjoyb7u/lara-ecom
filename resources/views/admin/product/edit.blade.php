@extends('admin.components.admin-master')

@section('title', 'Edit Product | Lara-Ecomm')


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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.edit', base64_encode($product_detail->id)) : route('admin.product.edit', base64_encode($product_detail->id)) }}"><i class="fa fa-edit"  aria-hidden="true"></i>Edit Product</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-10 col-md-10 col-md-offset-1">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>PRODUCT FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-xs-6">
                                <h4>Edit Product :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.index') : route('admin.product.index') }}" class="btn btn-primary">Manage Products</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.update', [base64_encode($product_detail->id), base64_encode(auth()->user()->id)]) : route('admin.product.update', [base64_encode($product_detail->id), base64_encode(auth()->user()->id)]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="brand_id" class="col-sm-4 control-label">Brand Name</label>
                                        <div class="col-sm-8">
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="">Select Brand Name</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $brand->id === $product_detail->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id" class="col-sm-4 control-label">Select Category Name</label>
                                        <div class="col-sm-8">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category Name</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id === $product_detail->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_category_id" class="col-sm-4 control-label">Select Sub-Category Name</label>
                                        <div class="col-sm-8">
                                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                                <option value="">Select Sub-Category Name</option>
                                                @foreach($sub_categories as $sub_category)
                                                    <option value="{{ $sub_category->id }}" {{ $sub_category->id === $product_detail->sub_category_id ? 'selected' : '' }}>{{ $sub_category->sub_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="col-sm-4 control-label">Product Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="title" class="form-control" id="title" value="{{ $product_detail->title }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="desc" class="col-sm-4 control-label">Product Description</label>
                                        <div class="col-sm-8">
                                            <textarea name="desc" id="desc" cols="55" rows="4">
                                                {{ $product_detail->desc }}
                                            </textarea>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="code" class="col-sm-4 control-label">Product Level Code</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="code" class="form-control" id="code" value="{{ $product_detail->code }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="available" class="col-sm-4 control-label">Product Availability</label>
                                        <div class="col-sm-8">
                                            <select name="available" id="available" class="form-control">
                                                <option value="">Select Product Availability</option>
                                                <option value="in stock" {{ $product_detail->available === 'in stock' ? 'selected' : '' }}>In Stock</option>
                                                <option value="not in stock" {{ $product_detail->available === 'not in stock' ? 'selected' : '' }}>Not Stock</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="col-sm-4 control-label">Product Image</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="image[]" multiple class="form-control" id="image">
                                            @php
                                                $images = json_decode($product_detail->image)
                                            @endphp
                                            @if($images)
                                                @foreach($images as $image)
                                                    <span><img style="margin: 5px 0;" width="100" height="60" src="{{ asset('uploads/images/product/'.$image) }}" alt="{{ $image }}"></span>
                                                @endforeach
                                            @else
                                               <span><img width="100" height="60" src="{{ asset('uploads/images/slider/'.$product_detail->image) }}" alt="{{ $product_detail->image }}"></span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="quantity" class="col-sm-4 control-label">Product Quantity</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $product_detail->quantity }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="original_price" class="col-sm-4 control-label">Product Original Price</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="original_price" class="form-control" id="original_price" value="{{ $product_detail->original_price }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sales_price" class="col-sm-4 control-label">Product Sales Price</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="sales_price" class="form-control" id="sales_price" value="{{ $product_detail->sales_price }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="offer_price" class="col-sm-4 control-label">Product Offer Price</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="offer_price" class="form-control" id="offer_price" value="{{ $product_detail->offer_price }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total_price" class="col-sm-4 control-label">Product Total Price</label>
                                        <div class="col-sm-8">
                                            <input type="number" name="total_price" class="form-control" id="total_price" value="{{ $product_detail->total_price }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="is_new" class="col-sm-4 control-label">Product Is New or Not</label>
                                        <div class="col-sm-8">
                                            <select name="is_new" id="is_new" class="form-control">
                                                <option value="">Select New or Not</option>
                                                <option value="1" {{ $product_detail->is_new === 1 ? 'selected' : '' }}>YES</option>
                                                <option value="0" {{ $product_detail->is_new === 0 ? 'selected' : '' }}>NO</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Update Product</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
