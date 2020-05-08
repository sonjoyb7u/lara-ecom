@extends('admin.components.admin-master')

@section('title', 'Add Slider | Lara-Ecomm')


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
                    <li><a href="javascript:avoid(0)"><i class="fa fa-plus-square"  aria-hidden="true"></i>Add Slider</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-10 col-md-10 col-md-offset-1">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>SLIDER FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-xs-6">
                                <h4>Add Slider :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.slider.index') : route('admin.slider.index') }}" class="btn btn-primary">Manage Sliders</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.slider.store', base64_encode(auth()->user()->id)) : route('admin.slider.store', base64_encode(auth()->user()->id)) }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="message" class="col-sm-4 control-label">Slider Message</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="message" class="form-control" id="message" value="{{ old('message') }}" placeholder="Enter Slider Message">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="col-sm-4 control-label">Slider Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeholder="Enter Slider Title">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_title" class="col-sm-4 control-label">Slider Sub-Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="sub_title" class="form-control" id="sub_title" value="{{ old('sub_title') }}" placeholder="Enter Slider Sub Title">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="col-sm-4 control-label">Slider Image</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="image[]" multiple class="form-control" id="image" value="{{ old('image') }}" placeholder="Choose Slider Image...">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="start" class="col-sm-4 control-label">Slider Start (Date&Time)</label>
                                        <div style="padding-left: 15px; padding-right: 15px;" class="col-sm-8 input-group date" id="datetimepicker">
                                                <input type="text" name="start" class="form-control" value="{{ old('start') }}" placeholder="YYYY-MM-DD HH:MM A" />
                                                <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Slider End (Date&Time)</label>
                                        <div style="padding-left: 15px; padding-right: 15px;" class="col-sm-8 input-group date" id="datetimepicker">
                                            <input type="text" name="end" value="{{ old('end') }}" class="form-control" placeholder="YYYY-MM-DD HH:MM A" />
                                            <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                             </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="url" class="col-sm-4 control-label">Slider Url Link</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="url" class="form-control" id="end" value="{{ old('url') }}" placeholder="Enter Slider Url Link Address">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Add Slider</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
