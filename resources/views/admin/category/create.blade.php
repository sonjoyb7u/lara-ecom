@extends('admin.components.admin-master')

@section('title', 'Add Category | Lara-Ecomm')

@push('css')
    <style>
        .btn.btn-primary.btn-sm.file-click {
            margin-bottom: 0;
        }
        .images img{
            width:100px;
            height: 80px;
            display: none;
            margin: 7px;
        }
        .category img{
            max-width:120px;
            height: 70px;
            margin: 5px;
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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.index') : route('admin.category.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Category</a></li>
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.create') : route('admin.category.create') }}"><i class="fa fa-plus-square"  aria-hidden="true"></i>Add Category</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-6 col-md-8 col-md-offset-2">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>CATEGORY FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-md-6">
                                <h4>Add Category :</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.index') : route('admin.category.index') }}" class="btn btn-primary">All Categories</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.store', base64_encode(auth()->user()->id)) : route('admin.category.store', base64_encode(auth()->user()->id)) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="category_name" class="col-sm-4 col-md-4 control-label">Category Name</label>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" name="category_name" class="form-control" id="category_name" value="{{ old('category_name') }}" placeholder="Enter Category Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="col-sm-4 col-md-4 control-label">Category Banner</label>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="file" name="banner" id="category" onchange="previewCategory(this);" style="display: none;">
                                            <input type="button" class="btn btn-primary btn-sm file-click" data-id="category" value="Choose Banner">
                                            <div class="images">
                                                <div class="row" id="gallery-with-zoom">
                                                    <a href="" title="">
                                                        <img id="show_category" src="" alt="" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="logo" class="col-sm-4 col-md-4 control-label">Category Logo</label>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" name="logo" class="form-control" id="logo" value="{{ old('logo') }}" placeholder="Enter Category Logo Class Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">Add Category</button>
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

@push('js')
    <script>

        //Single images preview in browser...
        function previewCategory(input) {
            var id = $(input).attr('id');
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                $('#show_'+id).slideUp();
                reader.onload = function (e) {
                    $('#show_'+id).attr('src', e.target.result);
                    $('#show_'+id).parent().attr('href', e.target.result);
                    $('#show_'+id).slideDown();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Multiple Slider images preview in browser...
        // var categoryPreview = function(input, insertCategoryPreview) {
        //
        //     if (input.files) {
        //         var filesAmount = input.files.length;
        //         for (i = 0; i < filesAmount; i++) {
        //             var reader = new FileReader();
        //
        //             reader.onload = function(event) {
        //                 $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(insertCategoryPreview);
        //             };
        //
        //             reader.readAsDataURL(input.files[i]);
        //         }
        //     }
        //
        // };
        //
        // $('#category').on('change', function () {
        //     categoryPreview(this, 'div.category');
        // });
    </script>
@endpush
