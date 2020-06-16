<div class="left-sidebar">
    <!-- left sidebar HEADER -->
    <div class="left-sidebar-header">
        <div class="left-sidebar-title">Admin Panel | Lara-Ecomm</div>
        <div class="left-sidebar-toggle c-hamburger c-hamburger--htla hidden-xs" data-toggle-class="left-sidebar-collapsed" data-target="html">
            <span></span>
        </div>
    </div>
    <!-- NAVIGATION -->
    <!-- ========================================================= -->
    <div id="left-nav" class="nano">
        <div class="nano-content">
            <nav>
                <ul class="nav nav-left-lines" id="main-nav">


                    <!--HOME-->
                    <li class="{{ request()->is('super-admin/dashboard', 'admin/dashboard') ? 'active-item' : '' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.home') : route('admin.home') }}"><i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span></a></li>

                    <!-- BRANDS SECTION -->
                    <li class="has-child-item {{ request()->is('super-admin/brands','super-admin/brands/*') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/brands', 'admin/brands/*') ? 'open-item active-item' : 'close-item' }}">
                        <a><i class="fa fa-cube" aria-hidden="true"></i><span>BRAND SECTION</span></a>
                        <ul class="nav child-nav level-1">
                            <li class=" {{ request()->is('super-admin/brands/create') ? 'active-item' : '' }} {{ request()->is('admin/brands/create') ? 'active-item' : '' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.brand.create') : route('admin.brand.create') }}">Add Brand</a></li>
                            <li  class=" {{ request()->is('super-admin/brands', 'super-admin/brands/edit/*') ? 'active-item' : '' }} {{ request()->is('admin/brands', 'admin/brands/edit/*') ? 'active-item' : '' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.brand.index') : route('admin.brand.index') }}">Manage Brands</a></li>
                        </ul>
                    </li>

                    <!-- CATEGORY SECTION -->
                    <li class="has-child-item {{ request()->is('super-admin/categories','super-admin/categories/*', 'super-admin/sub-categories', 'super-admin/sub-categories/*') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/categories', 'admin/sub-categories', 'admin/categories/*', 'admin/sub-categories/*') ? 'open-item active-item' : 'close-item' }}">
                        <a><i class="fa fa-sitemap" aria-hidden="true"></i><span>CATEGORY SECTION</span></a>
                        <ul class="nav child-nav level-1">

                            <li class="has-child-item {{ request()->is('super-admin/categories/create', 'super-admin/sub-categories/create') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/categories/create', 'admin/sub-categories/create') ? 'open-item active-item' : 'close-item' }}">
                                <a><i class="fa fa-plus-square"  aria-hidden="true"></i>ADD</a>
                                <ul class="nav child-nav level-2">
                                    <li class="{{ request()->is('super-admin/categories/create') ? 'active-item' : 'close-item' }} {{ request()->is('admin/categories/create') ? 'active-item' : 'close-item' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.create') : route('admin.category.create') }}">Add Category</a></li>
                                    <li class="{{ request()->is('super-admin/sub-categories/create') ? 'active-item' : 'close-item' }} {{ request()->is('admin/sub-categories/create') ? 'active-item' : 'close-item' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.create') : route('admin.sub-category.create') }}">Add Sub-Category</a></li>
                                </ul>
                            </li>
                            <li class="has-child-item {{ request()->is('super-admin/categories', 'super-admin/sub-categories', 'super-admin/categories/edit/*', 'super-admin/sub-categories/edit/*') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/categories', 'admin/categories/edit/*') ? 'open-item active-item' : 'close-item' }}">
                                <a><i class="fa fa-tasks"></i>MANAGE</a>

                                <ul class="nav child-nav level-2">
                                    <li  class="{{ request()->is('super-admin/categories','super-admin/categories/edit/*') ? 'active-item' : 'close-item' }} {{ request()->is('admin/categories', 'admin/categories/edit/*') ? 'active-item' : 'close-item' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.index') : route('admin.category.index') }}">Manage Categories</a></li>
                                    <li  class="{{ request()->is('super-admin/sub-categories','super-admin/sub-categories/edit/*') ? 'active-item' : 'close-item' }} {{ request()->is('admin/sub-categories', 'admin/sub-categories/edit/*') ? 'active-item' : 'close-item' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.index') : route('admin.sub-category.index') }}">Manage Sub-Categories</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <!-- SLIDER SECTION -->
                    <li class="has-child-item {{ request()->is('super-admin/sliders','super-admin/sliders/*') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/sliders', 'admin/sliders/*') ? 'open-item active-item' : 'close-item' }}">
                        <a><i class="fa fa-cube" aria-hidden="true"></i><span>SLIDER SECTION</span></a>
                        <ul class="nav child-nav level-1">
                            <li class="{{ request()->is('super-admin/sliders/create') ? 'active-item' : '' }} {{ request()->is('admin/sliders/create') ? 'active-item' : '' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.slider.create') : route('admin.slider.create') }}">Add Slider</a></li>
                            <li  class="{{ request()->is('super-admin/sliders', 'super-admin/sliders/edit/*') ? 'active-item' : '' }} {{ request()->is('admin/sliders', 'admin/sliders/edit/*') ? 'active-item' : '' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.slider.index') : route('admin.slider.index') }}">Manage Sliders</a></li>
                        </ul>
                    </li>

                    <!-- PRODUCT SECTION -->
                    <li class="has-child-item {{ request()->is('super-admin/products','super-admin/products/*') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/products', 'admin/products/*') ? 'open-item active-item' : 'close-item' }}">
                        <a><i class="fa fa-cube" aria-hidden="true"></i><span>PRODUCT SECTION</span></a>
                        <ul class="nav child-nav level-1">
                            <li class="{{ request()->is('super-admin/products/create') ? 'active-item' : '' }} {{ request()->is('admin/products/create') ? 'active-item' : '' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.create') : route('admin.product.create') }}">Add Product</a></li>
                            <li  class="{{ request()->is('super-admin/products', 'super-admin/products/edit/*') ? 'active-item' : '' }} {{ request()->is('admin/products', 'admin/products/edit/*') ? 'active-item' : '' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.product.index') : route('admin.product.index') }}">Manage Products</a></li>
                        </ul>
                    </li>

                    <!-- ORDER SECTION -->
                    <li class="has-child-item {{ request()->is('super-admin/orders','super-admin/orders/*') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/orders', 'admin/orders/*') ? 'open-item active-item' : 'close-item' }}">
                        <a><i class="fa fa-cube" aria-hidden="true"></i><span>ORDER SECTION</span></a>
                        <ul class="nav child-nav level-1">
                            <li  class="{{ request()->is('super-admin/orders', 'super-admin/orders/edit/*') ? 'active-item' : '' }} {{ request()->is('admin/orders', 'admin/orders/edit/*') ? 'active-item' : '' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.order.index') : route('admin.order.index') }}">Manage Orders</a></li>
                        </ul>
                    </li>


                </ul>
            </nav>
        </div>
    </div>
</div>
