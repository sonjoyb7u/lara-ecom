@extends('admin.components.admin-master')

@section('title', 'Add Sub-Category | Lara-Ecomm')

@push('css')
    <style>
        .btn.btn-primary.btn-sm.file-click {
            margin-bottom: 0;
        }
        .sub_category img{
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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.index') : route('admin.sub-category.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Sub-Category</a></li>
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.create') : route('admin.sub-category.create') }}"><i class="fa fa-plus-square"  aria-hidden="true"></i>Add Sub-Category</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-6 col-lg-6 col-md-offset-3">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>SUB-CATEGORY FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-xs-6">
                                <h4>Add Sub-Category :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.index') : route('admin.sub-category.index') }}" class="btn btn-primary">All Sub-Categories</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.store', base64_encode(auth()->user()->id)) : route('admin.sub-category.store', base64_encode(auth()->user()->id)) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="cat_id" class="col-sm-4 control-label">Category Name</label>
                                        <div class="col-sm-8">
                                            <select name="category_id" id="cat_id" class="form-control">
                                                <option value="">Select Category Name</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_category_name" class="col-sm-4 control-label">Sub-Category Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="sub_category_name" class="form-control" id="sub_category_name" value="{{ old('sub_category_name') }}" placeholder="Enter Sub Category Name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="col-sm-4 control-label">Sub Category Image</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="banner" id="sub_category" onchange="previewSubCategory(this);" style="display: none;">
                                            <input type="button" class="btn btn-primary btn-sm file-click" data-id="sub_category" value="Choose Sub Category">
                                            <div class="sub_category">
                                                <div class="row" id="gallery-with-zoom">
                                                    <a href="" title="">
                                                        <img id="show_sub_category" src="" alt="" />
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Add Sub-Category</button>
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
        function previewSubCategory(input) {
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
        // var subCategoryPreview = function(input, insertSubCategoryPreview) {
        //
        //     if (input.files) {
        //         var filesAmount = input.files.length;
        //         for (i = 0; i < filesAmount; i++) {
        //             var reader = new FileReader();
        //
        //             reader.onload = function(event) {
        //                 $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(insertSubCategoryPreview);
        //             };
        //
        //             reader.readAsDataURL(input.files[i]);
        //         }
        //     }
        //
        // };
        //
        // $('#sub_category').on('change', function () {
        //     subCategoryPreview(this, 'div.category');
        // });
    </script>
@endpush
