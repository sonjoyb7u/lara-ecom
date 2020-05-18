@extends('admin.components.admin-master')

@section('title', 'Add Brand | Lara-Ecomm')


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
                    <li><a href="{{ route('super-admin.brand.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Brand</a></li>
                    <li><a href="{{ route('super-admin.brand.create') }}"><i class="fa fa-plus-square"  aria-hidden="true"></i>Add Brand</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-6 col-lg-6 col-md-offset-3">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>BRAND FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-xs-6">
                                <h4>Add Brand :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.brand.index') : route('admin.brand.index') }}" class="btn btn-primary">All Brands</a>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.brand.store', [base64_encode(auth()->user()->id)]) : route('admin.brand.store', base64_encode(auth()->user()->id)) }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="brand_name" class="col-sm-3 control-label">Brand Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="brand_name" class="form-control" id="brand_name" value="{{ old('brand_name') }}" placeholder="Enter Brand Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Add Brand</button>
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
