@extends('admin.components.admin-master')

@section('title', 'Manage Subscriber\'s | Lara-Ecomm')


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
                    <li><a href="{{ route('super-admin.subscriber.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Subscriber</a></li>
                    <li><a href="{{ route('super-admin.subscriber.index') }}"><i class="fa fa-tasks"></i>Manage Subscriber's</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>SUBSCRIBER'S LIST</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div class="row">
                            <div class="col-xs-6">
                                <h4>Manage Subscriber's :</h4>
                            </div>
                        </div>

                        <!--SEARCHING, ORDENING & PAGING-->
                        <div class="table-responsive">
                            <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Subscriber Email Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribers as $subscriber)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subscriber->email }}</td>
                                    <td>
                                        @if(auth()->user()->is_admin === 1)
                                            <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $subscriber->status === 1 ? 'checked' : '' }} id="subscriberStatus" data-id="{{ $subscriber->id }}">
                                        @else
                                            <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $subscriber->status === 'active' ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.subscriber.show', base64_encode($subscriber->id)) : route('admin.subscriber.show', base64_encode($customer->id)) }}"><i class="fa fa-eye"></i></a>

                                        @if(auth()->user()->is_admin === 1)

                                        <a class="btn btn-info btn-sm" href="{{ route('super-admin.subscriber.edit', base64_encode($subscriber->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                        <span style="display: inline-block">
                                        <form action="{{ route('super-admin.subscriber.delete', base64_encode($subscriber->id)) }}" method="post">
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
