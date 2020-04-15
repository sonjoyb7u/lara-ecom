
<!-- ============================================== HEADER ============================================== -->
    {{--Header Section Goes Here...--}}
@includeIf('site.components.partials.header')
<!-- ============================================== HEADER : END ============================================== -->


<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">

        @yield('content')
        <!-- /.row -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @includeIf('site.components.partials.brands')
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
</div>
<!-- /#top-banner-and-menu -->


<!-- ============================================================= FOOTER ============================================================= -->
{{--Footer Section Goes here...--}}
@includeIf('site.components.partials.footer')
<!-- ============================================================= FOOTER : END============================================================= -->




