<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            @foreach($categories as $category)
                @if(count($category->subCategories) > 0)
                <li class="dropdown menu-item">
                    <a href="{{ route('site.category', $category->category_slug) }}" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa {{ $category->logo }}" aria-hidden="true"></i>{{ $category->category_name }}</a>
                    <ul class="dropdown-menu mega-menu">
                        <li class="yamm-content">
                            <div class="row">
                                @foreach($category->subCategories as $sub_category)
                                    <div class="col-sm-4 col-md-4">
                                        <ul>
                                            <li>
                                                <a href="{{ route('site.sub-category', $sub_category->sub_category_slug) }}">{{ $sub_category->sub_category_name }}</a>
                                            </li>
                                        </ul>
{{--                                    <a href="{{ route('site.sub-category', $sub_category->sub_category_slug) }}">{{ $sub_category->sub_category_name }}</a>--}}
                                    </div><!-- /.col -->
                                @endforeach

                            </div><!-- /.row -->
                            <div class="dropdown-banner-holder">
                                <a href="#">
                                    <img alt="{{ $category->banner }}" src="{{ asset('uploads/images/category/'.$category->banner) }}" style="width: 180px; height: 200px;" />
                                </a>
                            </div>
                        </li><!-- /.yamm-content -->
                    </ul><!-- /.dropdown-menu -->
                </li><!-- /.menu-item -->
                @else
                    <li>
                        <a href="{{ route('site.category', $category->category_slug) }}"><i class="icon fa {{ $category->logo }}"></i>{{ $category->category_name }}</a>
                    </li>
                @endif
            @endforeach

        </ul><!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->
