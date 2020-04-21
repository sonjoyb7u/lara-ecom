@extends('admin.components.admin-master')

@section('title', 'Edit Category | Lara-Ecomm')


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
                    <li><a href="javascript:avoid(0)"><i class="fa fa-list-alt" aria-hidden="true"></i>Brand</a></li>
                    <li><a href="javascript:avoid(0)"><i class="fa fa-edit"  aria-hidden="true"></i>Edit Brand</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-6 col-lg-6 col-md-offset-3">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>CATEGORY FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-xs-6">
                                <h4>Edit Category :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.index') : route('admin.category.index') }}" class="btn btn-primary">All Categories</a>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.update', base64_encode($category_detail->id)) : route('admin.category.update', base64_encode($category_detail->id)) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="brand_id" class="col-sm-4 control-label">Brand Name</label>
                                        <div class="col-sm-8">
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="">Selete Brand Name</option>
                                                @foreach($brand_details as $brand)
                                                <option value="{{ $brand->id }}" {{ $category_detail->brand_id === $brand->id ? 'selected' : ''}}>{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_name" class="col-sm-4 control-label">Category Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $category_detail->category_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Update Category</button>
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
