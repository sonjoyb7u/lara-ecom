@extends('admin.components.admin-master')

@section('title', 'Edit Product | Lara-Ecomm')

@push('css')
    <style>
        .images img{
            max-width:100px;
            height: 80px;
        }
        .gallery img{
            max-width:100px;
            height: 80px;
        }
        .product-image {
            padding:10px;
        }
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
                    <li><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.edit', base64_encode($product_detail->id)) : route('admin.product.edit', base64_encode($product_detail->id)) }}"><i class="fa fa-edit"  aria-hidden="true"></i>Edit Product</a></li>
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
                                <h4>Edit Product :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.index') : route('admin.product.index') }}" class="btn btn-primary">Manage Products</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.update', [base64_encode($product_detail->id), base64_encode($product_detail->user_id)]) : route('admin.product.update', [base64_encode($product_detail->id), base64_encode($product_detail->user_id)]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="brand_id" class="control-label">Select Brand Name</label>
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option value="">Select Brand Name</option>
                                                <option value="0">No Brand</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $brand->id === $product_detail->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="category_id" class="control-label">Select Category Name</label>
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option value="">Select Category Name</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id === $product_detail->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sub_category_id" class="control-label">Select Sub-Category Name</label>
                                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                                <option value="">Select Sub-Category Name</option>
                                                @foreach($cat_wise_subcats as $sub_cat)
                                                    <option value="{{ $sub_cat->id }}">{{ $sub_cat->sub_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="title" class="control-label">Product Title</label>
                                            <input type="text" name="title" class="form-control" id="title" value="{{ $product_detail->title }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_code" class="control-label">Product Level Code</label>
                                            <input type="text" name="product_code" class="form-control" id="product_code" value="{{ $product_detail->product_code }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_model" class="control-label">Product Model</label>
                                            <input type="text" name="product_model" class="form-control" id="product_model" value="{{ $product_detail->product_model }}" placeholder="Enter Product Model">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_size" class="control-label">Product Size</label>
                                            <select name="product_size" id="product_size" class="form-control" style="width: 100%">
                                                <option value="">Select Product Size</option>
                                                <option value="S" {{ $product_detail->product_size === 'S' ? 'selected' : '' }}>Small</option>
                                                <option value="M" {{ $product_detail->product_size === 'M' ? 'selected' : '' }}>Medium</option>
                                                <option value="L" {{ $product_detail->product_size === 'L' ? 'selected' : '' }}>Large</option>
                                                <option value="XL" {{ $product_detail->product_size === 'XL' ? 'selected' : '' }}>Xtr-Large</option>
                                                <option value="XXL" {{ $product_detail->product_size === 'XXL' ? 'selected' : '' }}>Double Xtr-Large</option>
                                                <option value="28" {{ $product_detail->product_size === '28' ? 'selected' : '' }}>28</option>
                                                <option value="30" {{ $product_detail->product_size === '30' ? 'selected' : '' }}>30</option>
                                                <option value="32" {{ $product_detail->product_size === '32' ? 'selected' : '' }}>32</option>
                                                <option value="34" {{ $product_detail->product_size === '34' ? 'selected' : '' }}>34</option>
                                                <option value="36" {{ $product_detail->product_size === '' ? 'selected' : '' }}>36</option>
                                                <option value="40" {{ $product_detail->product_size === '40' ? 'selected' : '' }}>40</option>
                                                <option value="1.0cm" {{ $product_detail->product_size === '1.0cm' ? 'selected' : '' }}>1.0cm</option>
                                                <option value="1.2cm" {{ $product_detail->product_size === '1.2cm' ? 'selected' : '' }}>1.2cm</option>
                                                <option value="1.5cm" {{ $product_detail->product_size === '1.5cm' ? 'selected' : '' }}>1.5cm</option>
                                                <option value="1.8cm" {{ $product_detail->product_size === '1.8cm' ? 'selected' : '' }}>1.8cm</option>
                                                <option value="2.0cm" {{ $product_detail->product_size === '2.0cm' ? 'selected' : '' }}>2.0cm</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="select2-example-tags" class="control-label">Select Multiple Color</label>
                                            <select name="product_color[]" id="select2-example-tags" class="form-control select-tag-primary" multiple="multiple" style="width: 100%">
{{--                                                @php--}}
{{--                                                    $product_colors = json_decode($product_detail->product_color)--}}
{{--                                                @endphp--}}
{{--                                                @if(!empty($product_colors))--}}
{{--                                                    @foreach($product_colors as $product_color)--}}
{{--                                                        <option value="{{ $product_color }}" label="Red" {{ $product_color === ['#B70000', '#A2CF0D', '#A2CF0D', '#0023DE', '#CA0909', '#E79627', '#07090D', '#FFFFFF', '#F5F5F5', '#ED2258', '#00A7E3', '#665ADB', '#4D4D4D', '#008A00'] ? 'selected' : '' }}>{{ $product_color }}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                @endif--}}
                                                <option value="#B70000" label="Red" {{ $product_detail->product_color === '#B70000' ? 'selected' : '' }}>Red</option>
                                                <option value="#A2CF0D" label="Green" {{ $product_detail->product_color === '#A2CF0D' ? 'selected' : '' }}>Green</option>
                                                <option value="#0023DE" label="Blue" {{ $product_detail->product_color === '#0023DE' ? 'selected' : '' }}>Blue</option>
                                                <option value="#CA0909" label="Meron" {{ $product_detail->product_color === '#CA0909' ? 'selected' : '' }}>Meron</option>
                                                <option value="#E79627" label="Yellow" {{ $product_detail->product_color === '#E79627' ? 'selected' : '' }}>Yellow</option>
                                                <option value="#07090D" label="Black" {{ $product_detail->product_color === '#07090D' ? 'selected' : '' }}>Black</option>
                                                <option value="#FFFFFF" label="White" {{ $product_detail->product_color === '#FFFFFF' ? 'selected' : '' }}>White</option>
                                                <option value="#F5F5F5" label="Off-White" {{ $product_detail->product_color === '#F5F5F5' ? 'selected' : '' }}>Off-White</option>
                                                <option value="#ED2258" label="Pink" {{ $product_detail->product_color === '#ED2258' ? 'selected' : '' }}>Pink</option>
                                                <option value="#00A7E3" label="Sky-Blue" {{ $product_detail->product_color === '#00A7E3' ? 'selected' : '' }}>Sky-Blue</option>
                                                <option value="#665ADB" label="Purple" {{ $product_detail->product_color === '#665ADB' ? 'selected' : '' }}>Purple</option>
                                                <option value="#4D4D4D" label="Gray" {{ $product_detail->product_color === '#4D4D4D' ? 'selected' : '' }}>Gray</option>
                                                <option value="#008A00" label="Lime" {{ $product_detail->product_color === '#008A00' ? 'selected' : '' }}>Lime</option>
                                                <option value="#472F2A" label="Chocolate" {{ $product_detail->product_color === '#472F2A' ? 'selected' : '' }}>Chocolate</option>
                                                <option value="#AF353B" label="Brown" {{ $product_detail->product_color === '#AF353B' ? 'selected' : '' }}>Brown</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="desc" class="control-label">Product Description</label>
                                            <textarea name="desc" id="summernote_desc"  name="desc" class="form-control">
                                                {{ $product_detail->desc }}
                                            </textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="long_desc" class="control-label">Product Long Description</label>
                                            <textarea name="long_desc" id="summernote_long_desc" class="form-control">
                                                {{ $product_detail->long_desc }}
                                            </textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="images" class="control-label">Product Image</label>
                                            <input type="file" name="image[]" multiple class="form-control product-image" id="images" onchange="readImageURL(this);" >
                                            <div class="images">
                                                @php
                                                    $images = json_decode($product_detail->image);
                                                @endphp
                                                @if($images)
                                                    @foreach($images as $image)
                                                        <img id="showImage" src="{{ asset('uploads/images/product/images/' . $image) }}" alt="{{ $image }}" />
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="gallery" class="control-label">Product Gallery</label>
                                            <input type="file" name="gallery[]" multiple class="form-control product-image" id="gallery" onchange="readGalleryURL(this);">
                                            <div class="gallery">
                                                @php
                                                    $gallery_images = json_decode($product_detail->gallery);
                                                @endphp
                                                @if($gallery_images)
                                                    @foreach($gallery_images as $gallery_image)
                                                        <img id="showGalleries" src="{{ asset('uploads/images/product/gallery-images/' . $gallery_image) }}" alt="{{ $gallery_image }}" />
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product-range-datepicker" class="control-label">Product Image Date Range</label>
                                            <div class="input-daterange input-group" id="product-range-datepicker">
                                                <input type="text" class="input-sm form-control" name="image_start" value="{{ date($product_detail->image_start) }}" />
                                                <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="input-sm form-control" name="image_end" value="{{ date($product_detail->image_end) }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="product_video_url" class="control-label">Product Video Url</label>
                                            <input type="text" name="product_video_url" class="form-control" id="product_video_url" value="{{ $product_detail->product_video_url }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="righticon checkboxCustom3 checkboxCustom5" class="control-label">Product Warranty</label>
                                            <br>
                                            <div class="radio radio-custom radio-inline radio-success">
                                                <input type="radio" id="radioCustom3" name="warranty" value="yes" {{ $product_detail->warranty === 'yes' ? 'checked' : '' }}>
                                                <label for="radioCustom3">YES</label>
                                            </div>
                                            <div class="radio radio-custom radio-inline radio-danger">
                                                <input type="radio" id="radioCustom5" name="warranty" value="no"  {{ $product_detail->warranty === 'no' ? 'checked' : '' }}>
                                                <label for="radioCustom5">NO</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="quantity" class="control-label">Product Quantity</label>
                                            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ $product_detail->quantity }}">
                                        </div>

                                        <div class="warranty-box">
                                            <div class="col-md-6">
                                                <label for="warranty_duration" class="control-label">Warranty Duration</label>
                                                <input type="text" name="warranty_duration" class="form-control" id="warranty_duration" value="{{ $product_detail->warranty_duration }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label for="warranty_condition" class="control-label">Product Warranty Condition</label>
                                                <textarea name="warranty_condition" id="warranty_condition"  name="warranty_condition" class="form-control">
                                                {{ $product_detail->warranty_condition }}
                                            </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="original_price" class="control-label">Product Original Price</label>
                                            <input type="number" name="original_price" class="form-control" id="original_price" value="{{ $product_detail->original_price }}" placeholder="Enter Product Original Prices">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sales_price" class="control-label">Product Sales Price</label>
                                            <input type="number" name="sales_price" class="form-control" id="sales_price" value="{{ $product_detail->sales_price }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="righticon" class="control-label">Product Special Price</label>
                                            <br>
                                            <div class="radio radio-custom radio-inline radio-success">
                                                <input type="radio" id="radioCustom1" name="is_special_price" value="yes" {{ $product_detail->is_special_price === 'yes' ? 'checked' : '' }}>
                                                <label for="radioCustom1">YES</label>
                                            </div>
                                            <div class="radio radio-custom radio-inline radio-danger">
                                                <input type="radio" id="radioCustom4" name="is_special_price" value="no" {{ $product_detail->is_special_price === 'no' ? 'checked' : '' }}>
                                                <label for="radioCustom4">NO</label>
                                            </div>
                                            <div class="special-price-box">
                                                <div class="col-md-6">
                                                    <label for="special_price" class="control-label">Product Special Price</label>
                                                    <input type="number" name="special_price" class="form-control" id="special_price" value="{{ $product_detail->special_price }}" style="height: 30px;">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="range-datepicker" class="control-label">Special price Date Range</label>
                                                    <div class="input-daterange input-group" id="special-range-datepicker">
                                                        <input type="text" class="input-sm form-control" name="special_start" value="{{ $product_detail->special_start }}" />
                                                        <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="input-sm form-control" name="special_end" value="{{ $product_detail->special_end }}" />
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="righticon" class="control-label">Product Offer Price</label>
                                            <br>
                                            <div class="radio radio-custom radio-inline radio-success">
                                                <input type="radio" id="radioCustom2" name="is_offer_price" value="yes" {{ $product_detail->is_offer_price === 'yes' ? 'checked' : '' }}>
                                                <label for="radioCustom2">YES</label>
                                            </div>
                                            <div class="radio radio-custom radio-inline radio-danger">
                                                <input type="radio" id="radioCustom6" name="is_offer_price" value="no" {{ $product_detail->is_offer_price === 'no' ? 'checked' : '' }}>
                                                <label for="radioCustom6">NO</label>
                                            </div>

                                            <div class="offer-price-box">
                                                <div class="col-md-6">
                                                    <label for="offer_price" class="control-label">Product Offer Price</label>
                                                    <input type="number" name="offer_price" class="form-control" id="offer_price" value="{{ $product_detail->offer_price }}" style="height: 30px;">
                                                </div>

                                                <div class="col-sm-6">
                                                    <label for="range-datepicker" class="control-label">Offer Date Range</label>
                                                    <div class="input-daterange input-group" id="offer-range-datepicker">
                                                        <input type="text" class="input-sm form-control" name="offer_start" value="{{ $product_detail->offer_start }}" />
                                                        <span class="input-group-addon x-primary"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" class="input-sm form-control" name="offer_end" value="{{ $product_detail->offer_end }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

{{--                                        <div class="col-md-6">--}}
{{--                                            <label for="total_sales" class="control-label">Total Sales</label>--}}
{{--                                            <input type="number" name="total_sales" class="form-control" id="total_sales" value="{{ old('total_sales') }}" placeholder="Enter Product Total Sales">--}}
{{--                                        </div>--}}

                                        <div class="col-md-6">
                                            <label for="available" class="control-label">Product Availability</label>
                                            <select name="available" id="available" class="form-control">
                                                <option value="">Select a Availability</option>
                                                <option value="in stock" {{ $product_detail === 'in stock' ? 'selected' : '' }}>In Stock</option>
                                                <option value="out of stock" {{ $product_detail === 'out of stock' ? 'selected' : '' }}>Out Of Stock</option>
                                                <option value="stock limite" {{ $product_detail === 'stock limite' ? 'selected' : '' }}>Stock Limited</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12" style="text-align: center; padding: 20px;">
                                            <label for="righticon" class="control-label">Product Activation : </label>
                                            <div class="status-button">
                                                <div class="checkbox-custom checkbox-inline checkbox-success">
                                                    <input type="checkbox" name="status" id="checkboxCustom3" value="active" {{ $product_detail->status === 'active' ? 'checked' : '' }}>
                                                    <label class="check" for="checkboxCustom3">ACTIVE</label>
                                                </div>
                                                <div class="checkbox-custom checkbox-inline checkbox-danger">
                                                    <input type="checkbox" name="status" id="checkboxCustom5" value="inactive" {{ $product_detail->status === 'inactive' ? 'checked' : '' }}>
                                                    <label class="check" for="checkboxCustom5">INACTIVE</label>
                                                </div>
                                            </div>
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

@push('js')
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

        //single images preview in browser...
        function readImageURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                $('#showImage').slideUp();
                reader.onload = function (e) {
                    $('#showImage').attr('src', e.target.result);
                    $('#showImage').slideDown();
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        //single images preview in browser...
        // function readGalleryURL(input) {
        //     if (input.files && input.files[0]) {
        //         var ImageCount = input.files.length;
        //         for (i = 0; i < ImageCount; i++) {
        //             var reader = new FileReader();
        //
        //             $('#showGalleries').slideUp();
        //             reader.onload = function (e) {
        //                 $('#showGalleries').attr('src', e.target.result);
        //                 $('#showGalleries').slideDown();
        //             };
        //
        //             reader.readAsDataURL(input.files[i]);
        //         }
        //
        //     }
        // }

        // Multiple images preview in browser...
        var galleryPreview = function(input, placeToInsertGalleryPreview) {

            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertGalleryPreview);
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#gallery').on('change', function () {
            galleryPreview(this, 'div.gallery');
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

        //Product Summernote Text-Area js call...
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
