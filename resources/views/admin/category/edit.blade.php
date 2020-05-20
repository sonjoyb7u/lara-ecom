@extends('admin.components.admin-master')

@section('title', 'Edit Category | Lara-Ecomm')

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
            max-width:100px;
            height: 80px;
            margin: 5px;
            display: none;
        }
        .cat-banner {
            margin: 5px 15px;
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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.edit', base64_encode($category_detail->id)) : route('admin.category.edit', base64_encode($category_detail->id)) }}"><i class="fa fa-edit"  aria-hidden="true"></i>Edit Category</a></li>
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
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.update', [base64_encode($category_detail->id), base64_encode(auth()->user()->id)]) : route('admin.category.update', [base64_encode($category_detail->id), base64_encode(auth()->user()->id)]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="category_name" class="col-sm-4 control-label">Category Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="category_name" class="form-control" id="category_name" value="{{ $category_detail->category_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="category" class="col-sm-4 control-label">Category Image</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="banner" multiple id="category" onchange="previewCategory(this);" style="display: none;">
                                            <input type="button" class="btn btn-primary btn-sm file-click" data-id="category" value="Choose Category">
                                            <div class="category">
                                                <div class="row" id="gallery-with-zoom">
                                                    <a href="" title="">
                                                        <img id="show_category" src="" alt="" />
                                                    </a>
                                                </div>
                                            </div>
                                            <span>
                                                <div class="row" id="gallery-with-zoom">
                                                    <a href="{{ asset('uploads/images/category/'.$category_detail->banner) }}" title="" class="image">
                                                        <img class="cat-banner" width="100" height="80" src="{{ asset('uploads/images/category/'.$category_detail->banner) }}" alt="{{$category_detail->banner}}">
                                                    </a>
                                                </div>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="logo" class="col-sm-4 col-md-4 control-label">Category Logo</label>
                                        <div class="col-sm-8 col-md-8">
                                            <input type="text" name="logo" class="form-control" id="logo" value="{{ $category_detail->logo }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
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
