@extends('admin.components.admin-master')

@section('title', 'Edit Slider | Lara-Ecomm')


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
                    <li><a href="javascript:avoid(0)"><i class="fa fa-edit"  aria-hidden="true"></i>Edit Slider</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-8 col-md-8 col-md-offset-2">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>SLIDER FORM</b></h3>
                <div class="panel b-primary bt-md">
                    <div class="panel-content">
                        <div style="margin-bottom: 15px;" class="row">
                            <div class="col-xs-6">
                                <h4>Edit Slider :</h4>
                            </div>
                            <div class="col-xs-6 text-right">
                                <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.slider.index') : route('admin.slider.index') }}" class="btn btn-primary">Manage Sliders</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <form class="form-horizontal" action="{{ auth()->user()->is_admin === 1 ? route('super-admin.slider.update', [base64_encode($slider_detail->id), base64_encode(auth()->user()->id)]) : route('admin.slider.update', [base64_encode($slider_detail->id), base64_encode(auth()->user()->id)]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="message" class="col-sm-4 control-label">Slider Message</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="message" class="form-control" id="message" value="{{ $slider_detail->message }}">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="col-sm-4 control-label">Slider Title</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="title" class="form-control" id="title" value="{{ $slider_detail->title }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub-title" class="col-sm-4 control-label">Slider Sub-Title</label>
                                        <div class="col-sm-8">
                                            <textarea name="sub_title" id="sub_title" cols="30" rows="4" class="form-control">
                                                {{ $slider_detail->sub_title }}
                                            </textarea>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="col-sm-4 control-label">Category Image</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="image" class="form-control" id="image">
                                            <span><img width="120" height="70" src="{{ asset('uploads/images/slider/'.$slider_detail->image) }}" alt=""></span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="start" class="col-sm-4 control-label">Slider Start (Date&Time)</label>
                                        <div style="padding-left: 15px; padding-right: 15px;" class="col-sm-8 input-group date" id="datetimepicker">
                                            <input type="text" name="start" class="form-control" value="{{ $slider_detail->start }}" />
                                            <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Slider End (Date&Time)</label>
                                        <div style="padding-left: 15px; padding-right: 15px;" class="col-sm-8 input-group date" id="datetimepicker">
                                            <input type="text" name="end" class="form-control" value="{{ $slider_detail->end }}" />
                                            <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                             </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="url" class="col-sm-4 control-label">Slider Url Link</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="url" class="form-control" id="end" value="{{ $slider_detail->url }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button type="submit" class="btn btn-primary">Update Slider</button>
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
