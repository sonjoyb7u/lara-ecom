@extends('admin.components.admin-master')

@section('title', 'Manage Sliders | Lara-Ecomm')


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
                    <li><a href="javascript:avoid(0)"><i class="fa fa-list-alt" aria-hidden="true"></i>Slider</a></li>
                    <li><a href="javascript:avoid(0)"><i class="fa fa-tasks"></i>Manage Sliders</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>SLIDER LIST</b></h3>
            <div class="panel b-primary bt-md">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Manage Slider :</h4>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.slider.create') : route('admin.slider.create') }}" class="btn btn-primary">Add Slider</a>
                        </div>
                    </div>

                    <!--SEARCHING, ORDENING & PAGING-->
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Added By</th>
                                <th>Slider Message</th>
                                <th>Slider Title</th>
                                <th>Slider Sub-title</th>
                                <th>Slider Image</th>
                                <th>Slider Start To End (Date&Time)</th>
                                <th>Slider URL</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($slider->user_id)
                                    {{ $slider->user->is_admin === 1 ? 'Super Admin' : 'Admin' }}
                                    @else
                                    No User Found Yet.
                                    @endif
                                </td>
                                <td>{{ $slider->message }}</td>
                                <td>{{ substr($slider->title, 0, 20) }}</td>
                                <td>{{ substr($slider->sub_title, 0, 25) }}</td>
                                <td>
                                    <img width="120" height="60" src="{{ asset('uploads/images/slider/'.$slider->image) }}" alt="{{ $slider->image }}">
                                </td>
                                <td>{{ $slider->start . '  >>>  ' . $slider->end }}</td>
                                <td>
                                    <a target="_blank" href="{{ $slider->url }}" class="btn btn-primary btn-sm">Go To Link</a>
                                </td>
                                <td>
                                    @if(auth()->user()->is_admin === 1)
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $slider->status === 'active' ? 'checked' : '' }} id="sliderStatus" data-id="{{ $slider->id }}">
                                    @else
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Active" data-off="Inactive" {{ $slider->status === 'active' ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.slider.show') : route('admin.slider.show') }}"><i class="fa fa-eye"></i></a>

                                    @if(auth()->user()->is_admin === 1)

                                    <a class="btn btn-info btn-sm" href="{{ route('super-admin.slider.edit', base64_encode($slider->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                    <span style="display: inline-block">
                                    <form action="{{ route('super-admin.slider.delete', base64_encode($slider->id)) }}" method="post">
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
