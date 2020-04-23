@extends('admin.components.admin-master')

@section('title', 'Edit Sub-Category | Lara-Ecomm')


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
                    <li><a href="javascript:avoid(0)"><i class="fa fa-list-alt" aria-hidden="true"></i>Sub-Category</a></li>
                    <li><a href="javascript:avoid(0)"><i class="fa fa-edit"  aria-hidden="true"></i>Edit Sub-Category</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-6 col-lg-6 col-md-offset-3">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>EDIT SUB-CATEGORY FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-xs-6">
                                <h4>Edit Sub-Category :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.index') : route('admin.sub-category.index') }}" class="btn btn-primary">All Categories</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.update', [base64_encode($sub_category_detail->id), base64_encode(auth()->user()->id)]) : route('admin.sub-category.update', [base64_encode($sub_category_detail->id), base64_encode(auth()->user()->id)]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="brand_id" class="col-sm-4 control-label">Select Brand</label>
                                        <div class="col-sm-8">
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="">Selete Brand Name</option>
                                                @foreach($brand_details as $brand)
                                                <option value="{{ $brand->id }}" {{ $brand->id === $sub_category_detail->brand_id  ? 'selected' : ''}}>{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id" class="col-sm-4 control-label">Select Category</label>
                                        <div class="col-sm-8">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Selete Category Name</option>
                                                @foreach($category_details as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id === $sub_category_detail->category_id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_category_name" class="col-sm-4 control-label">Sub-Category Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="sub_category_name" class="form-control" id="sub_category_name" value="{{ $sub_category_detail->sub_category_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Update Sub-Category</button>
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
