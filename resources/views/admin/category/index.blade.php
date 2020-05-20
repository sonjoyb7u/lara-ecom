@extends('admin.components.admin-master')

@section('title', 'Manage Category | Lara-Ecomm')


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
                    <li><a href="javascript:avoid(0)"><i class="fa fa-list-alt" aria-hidden="true"></i>Category</a></li>
                    <li><a href="javascript:avoid(0)"><i class="fa fa-tasks"></i>Manage Categories</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>CATEGORY LIST</b></h3>
            <div class="panel b-primary bt-md">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Manage Category :</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.create') : route('admin.category.create') }}" class="btn btn-primary">Add Category</a>
                        </div>
                    </div>

                    <!--SEARCHING, ORDENING & PAGING-->
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Added By</th>
                                <th>Category Name</th>
                                <th>Category Slug</th>
                                <th>Category Banner</th>
                                <th>Category Logo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($category->user_id)
                                    {{ auth()->user()->is_admin === 1 ? 'Super Admin' : 'Admin' }}
                                    @else
                                    <p>No User Found</p>
                                    @endif
                                </td>
                                <td>{{ $category->category_name }}</td>
                                <td>{{ $category->category_slug }}</td>
                                <td>
                                    <div class="row" id="gallery-with-zoom">
                                        <a href="{{ asset('uploads/images/category/'.$category->banner) }}" title="" class="image">
                                            <img width="80" height="60" src="{{ asset('uploads/images/category/'.$category->banner) }}" alt="Category Banner">
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <i class="fa {{ $category->logo }}" style="font-size: 25px;"></i>
                                </td>
                                <td>
                                    @if(auth()->user()->is_admin === 1)
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $category->status === 1 ? 'checked' : '' }} id="categoryStatus" data-id="{{ $category->id }}">
                                    @else
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $category->status === 1 ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled>
                                    @endif

                                </td>
                                <td>
                                    {{-- <a class="btn btn-success btn-sm" href=""><i class="fa fa-arrow-circle-o-up"></i></a>
                                    <a class="btn btn-warning btn-sm" href=""><i class="fa fa-arrow-circle-o-down"></i></a>  --}}

                                    <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.category.show') : route('admin.category.show') }}"><i class="fa fa-eye"></i></a>

                                    @if(auth()->user()->is_admin === 1)

                                    <a class="btn btn-info btn-sm" href="{{ route('super-admin.category.edit', base64_encode($category->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                    <span style="display: inline-block">
                                    <form action="{{ route('super-admin.category.delete', base64_encode($category->id)) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button style="margin-top: -10px;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Want To Delete This Category ?')"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                    </span>

                                    @else
                                    <a class="btn btn-info btn-sm" href="javascript:avoid(0)" onclick="return confirm('You have Not Authorized To Access This Action!')"><i class="fa fa-pencil-square-o"></i></a>

                                    <a class="btn btn-danger btn-sm" href="javascript:avoid(0)" onclick="return confirm('You have Not Authorized To Access This Action!')"><i class="fa fa-trash-o"></i></a>

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->

                </div>
            </div>
            </div>
        </div>
    </div>

@endsection
