@extends('admin.components.admin-master')

@section('title', 'Manage Customer\'s | Lara-Ecomm')


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
                    <li><i class="fa fa-home" aria-hidden="true"></i><a href="{{ route('super-admin.home') }}">Dashboard</a></li>
                    <li><a href="{{ route('super-admin.customer.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Customer's</a></li>
                    <li><a href="{{ route('super-admin.customer.index') }}"><i class="fa fa-tasks"></i>Manage Customer's</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>CUSTOMER'S LIST</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Manage Customer's :</h4>
                            </div>
                        </div>

                        <!--SEARCHING, ORDENING & PAGING-->
                        <div class="table-responsive">
                            <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email Address</th>
                                    <th>Customer Mobile No.</th>
                                    <th>Customer Address</th>
                                    <th>Customer Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $customer->name }}
                                    </td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        <img width="80" height="70" src="{{ asset('uploads/images/customer/'.$customer->image) }}" alt="{{ $customer->image }}">
                                    </td>
                                    <td>
                                        @if(auth()->user()->is_admin === 1)
                                            <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $customer->status === 'active' ? 'checked' : '' }} id="customerStatus" data-id="{{ $customer->id }}">
                                        @else
                                            <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $customer->status === 'active' ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.customer.show', base64_encode($customer->id)) : route('admin.customer.show', base64_encode($customer->id)) }}"><i class="fa fa-eye"></i></a>

                                        @if(auth()->user()->is_admin === 1)

                                        <a class="btn btn-info btn-sm" href="{{ route('super-admin.customer.edit', base64_encode($customer->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <span style="display: inline-block">
                                        <form action="{{ route('super-admin.customer.delete', base64_encode($customer->id)) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button style="margin-top: -10px;" type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-trash-o"></i></button>
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
