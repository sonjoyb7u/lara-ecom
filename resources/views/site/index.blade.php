@extends('site.components.site-master')

@section('title', 'HOME || LARA-ECOMM')


@section('left-sidebar')
<div class="col-xs-12 col-sm-12 col-md-3 sidebar">
    <!-- ==================== SIDEBAR ======================= -->

    <!-- =================== TOP NAVIGATION =================== -->
    @includeIf('site.components.partials.leftside-category-list')
    <!-- =================== TOP NAVIGATION : END ================== -->

    <!-- ===================== HOT DEALS ========================= -->
    @includeIf('site.components.partials.leftside-hot-deal')
    <!-- ===================== HOT DEALS: END ===================== -->

    <!-- ====================== SPECIAL OFFER ======================== -->
    @includeIf('site.components.partials.leftside-new-product')
    <!-- ====================== SPECIAL OFFER : END ==================== -->

    <!-- ======================== PRODUCT TAGS ====================== -->

    <!-- ====================== PRODUCT TAGS: END ====================== -->

    <!-- ====================== SPECIAL DEALS ===================== -->
    @includeIf('site.components.partials.leftside-special-deals')
    <!-- ===================== SPECIAL DEALS: END ================= -->

    <!-- ====================== NEWSLETTER ===================== -->
    @includeIf('site.components.partials.leftside-newsletter')
    <!-- =================== NEWSLETTER: END ====================-->

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


<!-- ========================== CONTENT ============================= -->
@section('content')
<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
    <!-- ============= SECTION – HERO ====================== -->
    @includeIf('site.components.partials.content-slider')
    <!-- ============= SECTION – HERO : END ================ -->

    <!-- ===================== SCROLL TABS ===================== -->
    @includeIf('site.components.partials.content-new-product')
    <!-- ============================================== SCROLL TABS : END ============================================== -->

    <!-- ====================== WIDE PRODUCTS BANNER ====================== -->
    @includeIf('site.components.partials.content-wide-product')
    <!-- /.wide-product-banners -->
    <!-- ===================== WIDE PRODUCTS BANNER : END =================== -->

    <!-- ==================== FEATURED PRODUCTS ======================= -->
    @includeIf('site.components.partials.content-featured-product')
    <!-- ==================== FEATURED PRODUCTS : END ======================= -->

    <!-- ==================== BEST SELLER ====================== -->
    @includeIf('site.components.partials.content-best-seller')
    <!-- ==================== BEST SELLER : END ==================== -->

    <!-- ===================== BLOG SLIDER ======================= -->

    <!-- ===================== BLOG SLIDER : END ==================== -->

    <!-- ====================== FEATURED PRODUCTS ==================== -->
    @includeIf('site.components.partials.content-new-arrival')
    <!-- ===================== FEATURED PRODUCTS : END ====================== -->
</div>
<!-- /.homebanner-holder -->
@endsection
<!-- ====================== CONTENT : END ========================== -->

