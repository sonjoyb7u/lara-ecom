@extends('admin.components.admin-master')

@section('title', 'Manage Sub-Category | Lara-Ecomm')


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
                    <li><a href="javascript:avoid(0)"><i class="fa fa-list-alt" aria-hidden="true"></i>Sub-Category</a></li>
                    <li><a href="javascript:avoid(0)"><i class="fa fa-tasks"></i>Manage Sub-Categories</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>SUB-CATEGORY LIST</b></h3>
            <div class="panel b-primary bt-md">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Manage Sub-Category :</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.create') : route('admin.sub-category.create') }}" class="btn btn-primary">Add Sub-Category</a>
                        </div>
                    </div>

                    <!--SEARCHING, ORDENING & PAGING-->
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>User Name</th>
                                <th>Brand Name</th>
                                <th>Category Name</th>
                                <th>Sub-Category Name</th>
                                <th>Sub-Category Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($sub_categories as $sub_category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($sub_category->user_id)
                                    {{ $sub_category->user->name }}
                                    @else
                                    No User Found Yet.
                                    @endif
                                </td>
                                <td>{{ $sub_category->brand->brand_name }}</td>
                                <td>{{ $sub_category->category->category_name }}</td>
                                <td>{{ $sub_category->sub_category_name }}</td>
                                <td>{{ $sub_category->sub_category_slug }}</td>
                                <td>
                                    @if(auth()->user()->is_admin === 1)
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $sub_category->status === 'active' ? 'checked' : '' }} id="subCategoryStatus" data-id="{{ $sub_category->id }}">
                                    @else
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $sub_category->status === 'active' ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.sub-category.show') : route('admin.sub-category.show') }}"><i class="fa fa-eye"></i></a>

                                    @if(auth()->user()->is_admin === 1)

                                    <a class="btn btn-info btn-sm" href="{{ route('super-admin.sub-category.edit', base64_encode($sub_category->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                    <span style="display: inline-block">
                                    <form action="{{ route('super-admin.sub-category.delete', base64_encode($sub_category->id)) }}" method="post">
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
