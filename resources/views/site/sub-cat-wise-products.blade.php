@extends('site.components.site-master')

@section('title', 'Sub Category Wise Products | Lara-Ecomm')

@section('left-sidebar')
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='{{ request()->is('category/*') ? 'active' : '' }}'><a href="{{ route('site.category', $sub_category->category->category_slug) }}">{{ $sub_category->category->category_name }}</a></li>
                    <li class='{{ request()->is('sub-category/*') ? 'active' : '' }}'><a href="{{ route('site.sub-category', $sub_category->sub_category_slug) }}">{{ $sub_category->sub_category_name }}</a></li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>

    <!-- ==================== SIDEBAR ======================= -->

    <!-- =================== TOP NAVIGATION =================== -->
    @includeIf('site.components.partials.leftside-category-list')
    <!-- =================== TOP NAVIGATION : END ================== -->

    <!-- ===================== HOT DEALS ========================= -->
    <div class="sidebar-module-container">
        <div class="sidebar-filter">
            <!-- ====================== PRICE SILDER===================== -->
            <div class="sidebar-widget wow fadeInUp">
                <div class="widget-header">
                    <h4 class="widget-title">Price Slider</h4>
                </div>
                <div class="sidebar-widget-body m-t-10">
                    <div class="price-range-holder">
            <span class="min-max">
                 <span class="pull-left">$200.00</span>
                 <span class="pull-right">$800.00</span>
            </span>
                        <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">

                        <input type="text" class="price-slider" value="" >

                    </div><!-- /.price-range-holder -->
                    <a href="#" class="lnk btn btn-primary">Show Now</a>
                </div><!-- /.sidebar-widget-body -->
            </div><!-- /.sidebar-widget -->
            <!-- ===================== PRICE SILDER : END ======================= -->

            <!-- =================== COLOR ==================== -->
            <div class="sidebar-widget wow fadeInUp">
                <div class="widget-header">
                    <h4 class="widget-title">Colors</h4>
                </div>
                <div class="sidebar-widget-body">
                    <ul class="list">
                        <li><a href="#">Red</a></li>
                        <li><a href="#">Blue</a></li>
                        <li><a href="#">Yellow</a></li>
                        <li><a href="#">Pink</a></li>
                        <li><a href="#">Brown</a></li>
                        <li><a href="#">Teal</a></li>
                    </ul>
                </div><!-- /.sidebar-widget-body -->
            </div><!-- /.sidebar-widget -->
            <!-- ======================= COLOR: END ======================= -->

        </div><!-- /.sidebar-filter -->
    </div><!-- /.sidebar-module-container -->

    <!-- ===================== HOT DEALS: END ===================== -->

    <!-- ======================== PRODUCT TAGS ====================== -->
    @includeIf('site.components.partials.leftside-product-tag')
    <!-- ====================== PRODUCT TAGS: END ====================== -->

    <!-- ====================== Testimonials ===================== -->
    {{--        @includeIf('site.components.partials.leftside-newsletter')--}}
    <!-- ============== Testimonials: END ==================== -->

    <!-- ================ SIDEBAR : END ====================== -->
    <div class="home-banner">
        <img src="{{ asset('assets/site/images/banners/LHS-banner.jpg') }}" alt="Image">
    </div>
</div>
<!-- /.sidemenu-holder -->
@endsection

@section('content')
<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
    <!-- ====================== SECTION – HERO BANNER =================== -->
    <div id="category" class="category-carousel hidden-xs">
        <div class="item">
            <div class="image"> <img src="{{ asset('uploads/images/sub-category/'.$sub_category->banner) }}" alt="{{ $sub_category->banner }}" class="img-responsive"> </div>
            <div class="container-fluid">
                <div class="caption vertical-top text-left">
                    <div class="big-text" style="color: #59B210; font-size: 50px;"> {{ ucwords($sub_category->sub_category_name) }}                     </div>
{{--                        <div class="excerpt hidden-sm hidden-md"> Save up to 49% off </div>--}}
{{--                        <div class="excerpt-normal hidden-sm hidden-md"> Lorem ipsum dolor sit amet, consectetur adipiscing elit </div>--}}
                </div>
                <!-- /.caption -->
            </div>
            <!-- /.container-fluid -->
        </div>

    </div>


    <div class="clearfix filters-container m-t-10">
        <div class="row">
            <div class="col col-sm-6 col-md-2">
                <div class="filter-tabs">
                    <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                        <li class="active"> <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Grid</a> </li>
                        <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i>List</a></li>
                    </ul>
                </div>
                <!-- /.filter-tabs -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <div class="search-result-container ">
        <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
                <div class="category-product">
                    <div class="row">
{{--                        <input type="hidden" name="subCatSlug" value="{{ $slug }}">--}}
                        <input type="hidden" name="sub_cat_id" value="{{ $sub_cat_id }}">
                        <div id="loadSubCatProduct" class="text-center"></div>
                        <!-- /.item -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.category-product -->
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane"  id="list-container">
                <div class="category-product">
{{--                    <input type="hidden" name="subCatSlug" value="{{ $slug }}">--}}
                    <input type="hidden" name="sub_cat_id" value="{{ $sub_cat_id }}">
                    <div id="loadSubCatListProduct" class="text-center"></div>
                    <!-- /.item -->
                </div>
                <!-- /.category-product -->
            </div>
            <!-- /.tab-pane #list-container -->
        </div>
        <!-- /.tab-content -->
        <div class="clearfix filters-container">
            <div class="text-right">
                <div class="pagination-container">
                    <ul class="list-inline list-unstyled">
                        <li class="prev"><a href="#"><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#">1</a></li>
                        <li class="active"><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li class="next"><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                    <!-- /.list-inline -->
                </div>
                <!-- /.pagination-container --> </div>
            <!-- /.text-right -->

        </div>
        <!-- /.filters-container -->

    </div>
    <!-- /.search-result-container -->
</div>
<!-- /.homebanner-holder -->

@endsection



@push('js')
    <script>
        loadSubCatProduct();
        loadSubCatListProduct();
    </script>
@endpush


