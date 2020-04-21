<div class="left-sidebar">
    <!-- left sidebar HEADER -->
    <div class="left-sidebar-header">
        <div class="left-sidebar-title">Navigation</div>
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
                        <a><i class="fa fa-list-alt" aria-hidden="true"></i><span>BRAND SECTION</span></a>
                        <ul class="nav child-nav level-1">
                            <li class=" {{ request()->is('super-admin/brands/create') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/brands/create') ? 'open-item active-item' : 'close-item' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.brand.create') : route('admin.brand.create') }}"><i class="fa fa-plus-square"  aria-hidden="true"></i>Add Brand</a></li>
                            <li  class=" {{ request()->is('super-admin/brands','super-admin/brands/*') ? 'open-item active-item' : 'close-item' }} {{ request()->is('admin/brands', 'admin/brands/*') ? 'open-item active-item' : 'close-item' }}"><a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.brand.index') : route('admin.brand.index') }}"><i class="fa fa-tasks"></i>Manage Brands</a></li>
                            
                            {{-- <li class="has-child-item close-++++++++++item">
                                <a>Notifications</a>
                                <ul class="nav child-nav level-2 ">
                                    <li><a href="ui-elements_notifications-pnotify.html">PNotify</a></li>
                                    <li><a href="ui-elements_notifications-toastr.html">Toastr</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
