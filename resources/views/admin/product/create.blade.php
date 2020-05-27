@extends('admin.components.admin-master')

@section('title', 'Add Product | Lara-Ecomm')

@push('css')
    <!-- include summernote css -->
    <link href="{{ asset('assets/admin/vendor/summer-note-textarea/summernote.min.css') }}" rel="stylesheet">
    <style>
        .images img{
            width:100px;
            height: 80px;
            display: none;
            margin: 7px;
        }
        .btn.btn-primary.btn-sm.file-click {
            margin-bottom: 0;
        }
        .gallery img{
            max-width:100px;
            height: 80px;
            margin: 7px;
        }
        /*.product-image {*/
        /*    padding:10px;*/
        /*}*/
        .warranty-box {
            display: none;
        }
        .special-price-box {
            display: none;
        }
        .offer-price-box {
            display: none;
        }

        .status-button {
            display: inline-block;
            padding: 10px;
        }
        .special-offer {
            padding: 0;
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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.index') : route('admin.product.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Products</a></li>
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.create') : route('admin.product.create') }}"><i class="fa fa-plus-square"  aria-hidden="true"></i>Add Product</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>PRODUCT FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-xs-6">
                                <h4>Add Product :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.index') : route('admin.product.index') }}" class="btn btn-primary">Manage Products</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.store', base64_encode(auth()->user()->id)) : route('admin.product.store', base64_encode(auth()->user()->id)) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="brand_id" class="control-label">Select Brand Name</label>
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="">Select Brand Name</option>
                                                <option value="0">No Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="category_id" class="control-label">Select Category Name</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category Name</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sub_category_id" class="control-label">Select Sub-Category Name</label>
                                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                                <option value="">Select Sub-Category Name</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="title" class="control-label">Product Title</label>
                                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeholder="Enter Product Title">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_code" class="control-label">Product Level Code</label>
                                            <input type="text" name="product_code" class="form-control" id="product_code" value="{{ old('product_code') }}" placeholder="Enter Product Level Code">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_model" class="control-label">Product Model</label>
                                            <input type="text" name="product_model" class="form-control" id="product_model" value="{{ old('product_model') }}" placeholder="Enter Product Model">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_size" class="control-label">Product Size</label>
                                            <select name="product_size" id="product_size" class="form-control" style="width: 100%">
                                                <option value="">Select Product Size</option>
                                                <option value="A">All</option>
                                                <option value="S">Small</option>
                                                <option value="M">Medium</option>
                                                <option value="L">Large</option>
                                                <option value="XL">Xtr-Large</option>
                                                <option value="XXL">Double Xtr-Large</option>
                                                <option value="28">28</option>
                                                <option value="30">30</option>
                                                <option value="32">32</option>
                                                <option value="34">34</option>
                                                <option value="36">36</option>
                                                <option value="40">40</option>
                                                <option value="1.0cm">1.0cm</option>
                                                <option value="1.2cm">1.2cm</option>
                                                <option value="1.5cm">1.5cm</option>
                                                <option value="1.8cm">1.8cm</option>
                                                <option value="2.0cm">2.0cm</option>
                                                <option value="2.0cm">28 inch</option>
                                                <option value="2.0cm">30 inch</option>
                                                <option value="2.0cm">32 inch</option>
                                                <option value="2.0cm">38 inch</option>
                                                <option value="2.0cm">42 inch</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="select2-example-tags" class="control-label">Select Multiple Color</label>
{{--                                            <div id="component-colorpicker" class="input-group colorpicker-component">--}}
{{--                                                <input type="text" class="form-control"  name="product_color[]" multiple="multiple" value="0066BA">--}}
{{--                                                <span class="input-group-addon"><i></i></span>--}}
{{--                                            </div>--}}
                                                <select name="product_color[]" id="select2-example-tags" class="form-control select-tag-primary" multiple="multiple" style="width: 100%">
                                                    <option value="#B70000" label="Red">Red</option>
                                                    <option value="#A2CF0D" label="Green">Green</option>
                                                    <option value="#0023DE" label="Blue">Blue</option>
                                                    <option value="#CA0909" label="Meron">Meron</option>
                                                    <option value="#E79627" label="Yellow">Yellow</option>
                                                    <option value="#07090D" label="Barbados">Black</option>
                                                    <option value="#FFFFFF" label="White">White</option>
                                                    <option value="#F5F5F5" label="Off-White">Off-White</option>
                                                    <option value="#ED2258" label="Pink">Pink</option>
                                                    <option value="#00A7E3" label="Sky-Blue">Sky-Blue</option>
                                                    <option value="#665ADB" label="Purple">Purple</option>
                                                    <option value="#4D4D4D" label="Gray">Gray</option>
                                                    <option value="#008A00" label="Lime">Lime</option>
                                                    <option value="#472F2A" label="Chocolate">Chocolate</option>
                                                    <option value="#AF353B" label="Brown">Brown</option>
                                                </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="desc" class="control-label">Product Description</label>
                                            <textarea name="desc" id="summernote_desc"  name="desc" class="form-control">
                                                {{ old('desc') }}
                                            </textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="long_desc" class="control-label">Product Long Description</label>
                                            <textarea name="long_desc" id="summernote_long_desc" class="form-control">
                                                {{ old('long_desc') }}
                                            </textarea>
                                        </div>

                                        <div class="col-md-6 image-gallery">
                                            <label for="images" class="control-label">Product Image</label>
                                            <input type="file" name="image" class="form-control" id="images" onchange="previewImages(this);" style="display: none;">
                                            <input type="button" class="btn btn-primary btn-sm file-click" data-id="images" value="Choose Image">
                                            <div class="images">
                                                <div class="row" id="gallery-with-zoom">
                                                    <a href="" title="">
                                                        <img id="show_images" src="" alt="" />
                                                    </a>
                                                </div>
                                            </div>

                                            <label for="product-range-datepicker" class="control-label">Product Image Date Range</label>
                                            <div class="input-daterange input-group" id="product-range-datepicker">
                                                <input type="text" class="input-sm form-control" name="image_start" />
                                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="input-sm form-control" name="image_end" />
                                            </div>

                                        </div>

                                        <div class="col-md-6 image-gallery">
                                            <label for="gallery" class="control-label">Product Gallery</label>
                                            <input type="file" name="gallery[]" multiple class="product-image" id="gallery" style="display: none;">
                                            <input type="button" class="btn btn-primary btn-sm file-click" data-id="gallery" value="Choose Gallery">
                                            <div class="gallery">
                                                <div class="row" id="gallery-with-zoom">
                                                    <a href="" title="" class="image">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_video_url" class="control-label">Product Video Url</label>
                                            <input type="text" name="product_video_url" class="form-control" id="product_video_url" value="{{ old('product_video_url') }}" placeholder="Enter Product Video Url">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="quantity" class="control-label">Product Quantity</label>
                                            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity') }}" placeholder="Enter Product Quantity">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="original_price" class="control-label">Product Original Price</label>
                                            <input type="number" name="original_price" class="form-control" id="original_price" value="{{ old('original_price') }}" placeholder="Enter Product Original Prices">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="available" class="control-label">Product Availability</label>
                                            <select name="available" id="available" class="form-control">
                                                <option value="">Select a Availability</option>
                                                <option value="in stock">In Stock</option>
                                                <option value="out of stock">Out Of Stock</option>
                                                <option value="stock limit">Stock Limited</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sales_price" class="control-label">Product Sales Price</label>
                                            <input type="number" name="sales_price" class="form-control" id="sales_price" value="{{ old('sales_price') }}" placeholder="Enter Product Sales Price">
                                        </div>

                                        <div class="col-md-12 special-offer">
                                            <div class="col-md-6">
                                                <label for="righticon" class="control-label">Product Special Price</label>
                                                <br>
                                                <div class="radio radio-custom radio-inline radio-success">
                                                    <input type="radio" id="radioCustom1" name="is_special_price" value="yes">
                                                    <label for="radioCustom1">YES</label>
                                                </div>
                                                <div class="radio radio-custom radio-inline radio-danger">
                                                    <input type="radio" id="radioCustom4" name="is_special_price" value="no">
                                                    <label for="radioCustom4">NO</label>
                                                </div>
                                                <div class="special-price-box">
                                                    <div class="col-md-6">
                                                        <label for="special_price" class="control-label">Product Special Price</label>
                                                        <input type="number" name="special_price" class="form-control" id="special_price" value="{{ old('special_price') }}" placeholder="Enter Product Special Price" style="height: 30px;">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="range-datepicker" class="control-label">Special price Date Range</label>
                                                        <div class="input-daterange input-group" id="special-range-datepicker">
                                                            <input type="text" class="input-sm form-control" name="special_start" />
                                                            <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                                            <input type="text" class="input-sm form-control" name="special_end" />
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="righticon" class="control-label">Product Offer Price</label>
                                                <br>
                                                <div class="radio radio-custom radio-inline radio-success">
                                                    <input type="radio" id="radioCustom2" name="is_offer_price" value="yes">
                                                    <label for="radioCustom2">YES</label>
                                                </div>
                                                <div class="radio radio-custom radio-inline radio-danger">
                                                    <input type="radio" id="radioCustom6" name="is_offer_price" value="no">
                                                    <label for="radioCustom6">NO</label>
                                                </div>

                                                <div class="offer-price-box">
                                                    <div class="col-md-6">
                                                        <label for="offer_price" class="control-label">Product Offer Price</label>
                                                        <input type="number" name="offer_price" class="form-control" id="offer_price" value="{{ old('offer_price') }}" placeholder="Enter Product Offer Price" style="height: 30px;">
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="range-datepicker" class="control-label">Offer Date Range</label>
                                                        <div class="input-daterange input-group" id="offer-range-datepicker">
                                                            <input type="text" class="input-sm form-control" name="offer_start" />
                                                            <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                                            <input type="text" class="input-sm form-control" name="offer_end" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="righticon checkboxCustom3 checkboxCustom5" class="control-label">Product Warranty</label>
                                            <br>
                                            <div class="radio radio-custom radio-inline radio-success">
                                                <input type="radio" id="radioCustom3" name="warranty" value="yes">
                                                <label for="radioCustom3">YES</label>
                                            </div>
                                            <div class="radio radio-custom radio-inline radio-danger">
                                                <input type="radio" id="radioCustom5" name="warranty" value="no">
                                                <label for="radioCustom5">NO</label>
                                            </div>

                                            <div class="warranty-box">
                                                <div class="col-md-12">
                                                    <label for="warranty_duration" class="control-label">Warranty Duration</label>
                                                    <input type="text" name="warranty_duration" class="form-control" id="warranty_duration" value="{{ old('warranty_duration') }}" placeholder="Enter Product Warranty Duration">
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="warranty_condition" class="control-label">Product Warranty Condition</label>
                                                    <textarea name="warranty_condition" id="warranty_condition"  name="warranty_condition" class="form-control">
                                                {{ old('warranty_condition') }}
                                            </textarea>
                                                </div>
                                            </div>
                                        </div>

{{--                                        <div class="col-md-6">--}}
{{--                                            <label for="total_sales" class="control-label">Total Sales</label>--}}
{{--                                            <input type="number" name="total_sales" class="form-control" id="total_sales" value="{{ old('total_sales') }}" placeholder="Enter Product Total Sales">--}}
{{--                                        </div>--}}

                                        <div class="col-md-12" style="text-align: center; padding: 20px;">
                                            <label for="righticon" class="control-label">Product Activation : </label>
                                            <div class="status-button">
                                                <div class="checkbox-custom checkbox-inline checkbox-success">
                                                    <input type="checkbox" name="status" id="checkboxCustom3" value="active">
                                                    <label class="check" for="checkboxCustom3">ACTIVE</label>
                                                </div>
                                                <div class="checkbox-custom checkbox-inline checkbox-danger">
                                                    <input type="checkbox" name="status" id="checkboxCustom5" value="inactive">
                                                    <label class="check" for="checkboxCustom5">INACTIVE</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-10 col-md-offset-5">
                                            <button type="submit" class="btn btn-primary">Add Product</button>
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
<!-- Include summernote css/js -->
<script src="{{ asset('assets/admin/vendor/summer-note-textarea/summernote.min.js') }}"></script>

<script>
    //Select2 basic example
    $("#brand_id").select2({
        placeholder: "Select a Brand",
        allowClear: true
    });

    $("#category_id").select2({
        placeholder: "Select a Category",
        allowClear: true
    });

    $("#sub_category_id").select2({
        placeholder: "Select a Sub-Category",
        allowClear: true
    });

    $("#product_size").select2({
        placeholder: "Select a Product Size",
        allowClear: true
    });

    $("#available").select2({
        placeholder: "Select a Availability",
        allowClear: true
    });

    //Single images preview in browser...
    function previewImages(input) {
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

    // Multiple Gallery images preview in browser...
    var galleryPreview = function(input, insertGalleryPreview) {
        var id = $(input).attr('id');
        // console.log(id);
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img id="#show_gallery">')).attr('src', event.target.result).appendTo(insertGalleryPreview);
                    $('#show_'+id).parent().attr('href', event.target.result);
                };

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery').on('change', function () {
        galleryPreview(this, 'div.gallery>div>a');
    });

    //Range Date-Picker example...
    $('#product-range-datepicker').datepicker({
        format: "yyyy/mm/dd",
        weekStart: 1,
        todayBtn: "linked",
        todayHighlight: true
    });

    $('#special-range-datepicker').datepicker({
        format: "yyyy/mm/dd",
        weekStart: 1,
        todayBtn: "linked",
        todayHighlight: true
    });

    $('#offer-range-datepicker').datepicker({
        format: "yyyy/mm/dd",
        weekStart: 1,
        todayBtn: "linked",
        todayHighlight: true
    });

    //Default timepicker example
    $('#default-timepicker').timepicker();

    //Select2 tagging example
    $("#select2-example-tags").select2({
        placeholder: "Select a Color",
        allowClear: true,
        tags: true,
        tokenSeparators: [',']
    });

    //Component Color-Picker example...
    $('#component-colorpicker').colorpicker({});


    // Product Summernote Text-Area js call...
    $('#summernote_desc').summernote({
        placeholder: 'Write Short Description',
        tabsize: 4,
        height: 80,
    });
    $('#summernote_long_desc').summernote({
        placeholder: 'Write Long Description',
        tabsize: 4,
        height: 80,
    });
    $('#warranty_condition').summernote({
        placeholder: 'Write Product Warranty Condition',
        tabsize: 4,
        height: 80,
    });

</script>
@endpush
