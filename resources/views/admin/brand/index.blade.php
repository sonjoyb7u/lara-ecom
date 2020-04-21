@extends('admin.components.admin-master')

@section('title', 'Manage Brands | Lara-Ecomm')


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
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="javascript:avoid(0)">Dashboard</a></li>
                    <li><a href="javascript:avoid(0)"><i class="fa fa-list-alt" aria-hidden="true"></i>Brand</a></li>
                    <li><a href="javascript:avoid(0)"><i class="fa fa-tasks"></i>Manage Brands</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>BRAND LIST</b></h3>
            <div class="panel b-primary bt-md">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Manage Brand :</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.brand.create') : route('admin.brand.create') }}" class="btn btn-primary">Add Brand</a>
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
                                <th>Brand Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($brand->user_id)
                                    {{ $brand->user->name }}
                                    @else
                                    No User Found Yet.
                                    @endif 
                                </td>
                                <td>{{ $brand->brand_name }}</td>
                                <td>{{ $brand->brand_slug }}</td>
                                <td>
                                    @if(auth()->user()->is_admin === 1)
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $brand->status === 1 ? 'checked' : '' }} id="brandStatus" data-id="{{ $brand->id }}">
                                    @else
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $brand->status === 1 ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled>
                                    @endif

                                </td>
                                <td>
                                    {{-- <a class="btn btn-success btn-sm" href=""><i class="fa fa-arrow-circle-o-up"></i></a>
                                    <a class="btn btn-warning btn-sm" href=""><i class="fa fa-arrow-circle-o-down"></i></a>  --}}

                                    <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.brand.show') : route('admin.brand.show') }}"><i class="fa fa-eye"></i></a>

                                    @if(auth()->user()->is_admin === 1)

                                    <a class="btn btn-info btn-sm" href="{{ route('super-admin.brand.edit', base64_encode($brand->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                    <span style="display: inline-block">
                                    <form action="{{ route('super-admin.brand.delete', base64_encode($brand->id)) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button style="margin-top: -10px;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Want To Delete This Brand ?')"><i class="fa fa-trash-o"></i></button>
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