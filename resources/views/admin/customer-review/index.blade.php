@extends('admin.components.admin-master')

@section('title', 'Manage Customer Reviews | Lara-Ecomm')


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
                    <li><a href="{{ route('super-admin.customer-review.index') }}"><i class="fa fa-list-alt" aria-hidden="true"></i>Review</a></li>
                    <li><a href="{{ route('super-admin.customer-review.index') }}"><i class="fa fa-tasks"></i>Manage Review's</a></li>
                </ul>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <div class="row animated fadeInUp">
            <div class="col-sm-12 col-md-12">
                @includeIf('messages.show-message')
                <h3 class="section-subtitle"><b>REVIEW LIST</b></h3>
            <div class="panel b-primary bt-md">
                <div class="panel-content">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>Manage Review's :</h4>
                        </div>
                        <div class="col-xs-6 text-right">
{{--                            <a href="{{ auth()->user()->is_admin === 1 ? route('super-admin.customer-review.create') : route('admin.customer-review.create') }}" class="btn btn-primary">Add Review</a>--}}
                        </div>
                    </div>

                    <!--SEARCHING, ORDENING & PAGING-->
                    <div class="table-responsive">
                        <table id="basic-table" class="data-table table table-bordered table-striped nowrap table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>customer Name</th>
                                <th>customer Email</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Review Message</th>
                                <th>Review Rating</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($customer_reviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $review->customer->name }}</td>
                                <td>{{ $review->customer->email }}</td>
                                <td>{{ $review->product->title }}</td>
                                <td>
                                    <img width="100" height="80" src="{{ asset('uploads/images/product/images/'.$review->product->image) }}" alt="{{ $review->product->image }}">
                                </td>
                                <td>{{ substr($review->message, 0, 20) . '... ...' }}</td>
                                <td>
                                    <span class="badge {{ randomRatingColor($review->rating) }}">
                                        {{ $review->rating }}&nbsp;-&nbsp;<i class="fa fa-star"></i>
                                    </span>

                                </td>
                                <td>
                                    @if(auth()->user()->is_admin === 1)
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Visible" data-off="Hidden" {{ $review->status === 'visible' ? 'checked' : '' }} id="customerReviewStatus" data-id="{{ $review->id }}">
                                    @else
                                    <input type="checkbox" data-toggle="toggle" data-size="mini" data-onstyle="success" data-on="Visible" data-off="Hidden" {{ $review->status === 'visible' ? 'checked' : '' }} onclick="return confirm('You have Not Authorized To Access This Action!')" disabled>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ auth()->user()->is_admin === 1 ? route('super-admin.customer-review.show', base64_encode($review->id)) : route('admin.customer-review.show') }}"><i class="fa fa-eye"></i></a>

                                    @if(auth()->user()->is_admin === 1)

                                    <a class="btn btn-info btn-sm" href="{{ route('super-admin.customer-review.edit', base64_encode($review->id)) }}"><i class="fa fa-pencil-square-o"></i></a>
                                    <span style="display: inline-block">
                                    <form action="{{ route('super-admin.customer-review.delete', base64_encode($review->id)) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button style="margin-top: -10px;" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Want To Delete This Customer Review ?')"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                    </span>

                                    @else
                                    <a class="btn btn-info btn-sm" href="javascript:avoid(0)" onclick="return confirm('You have Not Authorized To Access This Action!')" disabled=""><i class="fa fa-pencil-square-o"></i></a>

                                    <a class="btn btn-danger btn-sm" href="javascript:avoid(0)" onclick="return confirm('You have Not Authorized To Access This Action!')" disabled=""><i class="fa fa-trash-o"></i></a>
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
