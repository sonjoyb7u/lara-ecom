@extends('site.components.site-master')

@section('title', 'HOME || LARA-ECOMM')


@section('left-sidebar')
<!-- ==================== SIDEBAR ======================= -->

    <!-- =================== TOP NAVIGATION =================== -->
    @includeIf('site.components.partials.leftside-category-list')
    <!-- =================== TOP NAVIGATION : END ================== -->

    <!-- ===================== HOT DEALS ========================= -->
    @includeIf('site.components.partials.leftside-hot-deal')
    <!-- ===================== HOT DEALS: END ===================== -->


    <!-- ====================== SPECIAL OFFER ======================== -->
    @includeIf('site.components.partials.leftside-special-offer')
    <!-- ====================== SPECIAL OFFER : END ==================== -->

    <!-- ======================== PRODUCT TAGS ====================== -->
    @includeIf('site.components.partials.leftside-product-tag')
    <!-- ====================== PRODUCT TAGS: END ====================== -->

    <!-- ====================== SPECIAL DEALS ===================== -->

    <!-- ===================== SPECIAL DEALS: END ================= -->

    <!-- ====================== NEWSLETTER ===================== -->

    <!-- =================== NEWSLETTER: END ====================-->

    <!-- ====================== Testimonials ===================== -->
{{--        @includeIf('site.components.partials.leftside-newsletter')--}}
    <!-- ============== Testimonials: END ==================== -->

<!-- ================ SIDEBAR : END ====================== -->
@endsection


<!-- ========================== CONTENT ============================= -->
@section('content')

    <!-- ============= SECTION – HERO ====================== -->
    @includeIf('site.components.partials.content-slider')
    <!-- ============= SECTION – HERO : END ================ -->

    <!-- ===================== SCROLL TABS ===================== -->
    @includeIf('site.components.partials.content-new-product')
    <!-- ============================================== SCROLL TABS : END ============================================== -->

    <!-- ====================== WIDE BANNER PRODUCTS ======================== -->
    @includeIf('site.components.partials.content-wide-banner')
    <!-- /.wide-banners -->
    <!-- ==================== WIDE BANNER PRODUCTS : END ======================= -->

    <!-- ==================== FEATURED PRODUCTS ======================= -->
    @includeIf('site.components.partials.content-featured-product')
    <!-- ==================== FEATURED PRODUCTS : END ======================= -->

    <!-- ====================== WIDE PRODUCTS BANNER ====================== -->
    @includeIf('site.components.partials.content-wide-product')
    <!-- /.wide-product-banners -->
    <!-- ===================== WIDE PRODUCTS BANNER : END =================== -->

    <!-- ==================== BEST SELLER ====================== -->
    @includeIf('site.components.partials.content-best-seller')
    <!-- ==================== BEST SELLER : END ==================== -->

    <!-- ===================== BLOG SLIDER ======================= -->
    @includeIf('site.components.partials.content-blog')
    <!-- ===================== BLOG SLIDER : END ==================== -->

    <!-- ====================== FEATURED PRODUCTS ==================== -->
    @includeIf('site.components.partials.content-featured-product')
    <!-- ===================== FEATURED PRODUCTS : END ====================== -->

@endsection
<!-- ====================== CONTENT : END ========================== -->

