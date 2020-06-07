@extends('site.components.site-master')

@section('title', 'Contact Us | Lara-Ecomm')

@push('css')
    <style>
        .support_desc h3, .plans h3, .domain_registration h3 {
            font-size:25px;
        }
        .support_desc {
            width:70%;
        }
        .support img{
            margin-left:3%;
        }

        /** contact-form **/

        .contact-form input[type="text"],.contact-form textarea{
            width:97%;
        }
        .contact-us-btn {
            padding: 20px;

        }
        /** End contact-form **/


        .company_address p{
            font-size:0.8125em;
            color:#757575;
            padding:0.2em 0;
            font-family :Arial, Helvetica, sans-serif;
        }
        .company_address p span{
            text-decoration:underline;
            color:#444;
            cursor:pointer;
        }
    </style>
@endpush

@section('breadcrumb')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ route('site.index') }}">Home</a></li>
                    <li class='{{ request()->is('contact-us') ? 'active' : '' }}'><a href="{{ route('site.contact-us') }}">Contact Us</a></li>
                </ul>
            </div>
            <!-- /.breadcrumb-inner -->
        </div>
        <!-- /.container -->
    </div>
@endsection

@section('content')
    <div class="main">
        <div class="content">
            <div class="support">
                <div class="support_desc">
                    <h3>Live Support</h3>
                    <p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
                    <p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
                </div>
                <img src="web/images/contact.png" alt="" />
                <div class="clear"></div>
            </div>
            <div class="section group">
                <div class="col-sm-8 col-md-8">
                    <div class="contact-form">
                        <h2>Contact Us</h2>

                        @includeIf('messages.show-message')

                        <form action="{{ route('site.contact-us.send-mail') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <span><label for="to">To</label></span>
                                <span><input class="form-control" name="to" id="to" type="text" value="{{ old('to') }}" placeholder="Enter Sender Mail"></span>
                            </div>
                            <div class="form-group">
                                <span><label for="name">NAME</label></span>
                                <span><input class="form-control" name="name" id="name" type="text" value="{{ old('name') }}" placeholder="Enter Name"></span>
                            </div>
                            <div class="form-group">
                                <span><label for="email">E-MAIL</label></span>
                                <span><input class="form-control" name="email" id="email" type="text" value="{{ old('email') }}" placeholder="Enter Email Address"></span>
                            </div>
                            <div class="form-group">
                                <span><label for="subject">SUBJECT</label></span>
                                <span><input class="form-control" name="subject" id="subject" type="text" value="{{ old('subject') }}" placeholder="Enter Subject"></span>
                            </div>
                            <div class="form-group">
                                <span><label for="phone">MOBILE.NO</label></span>
                                <span><input class="form-control" name="phone" id="ohone" type="text" value="{{ old('phone') }}" placeholder="Enter Phone Number"></span>
                            </div>
                            <div class="form-group">
                                <span><label for="message">Message</label></span>
                                <span><textarea class="form-control" name="message" id="message"> {{ old('message') }}</textarea></span>
                            </div>
                            <div class="clearfix pull-right contact-us-btn">
                                <span><button class="btn-upper btn btn-primary" type="submit">Send Message</button></span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="company_address">
                        <h2>Company Information :</h2>
                        <p>799/A, 1 No Lane; Dhumpara,</p>
                        <p>Chittagong Wasa, Chittagong</p>
                        <p>BANGLADESH</p>
                        <p>Phone:(+880) 222 666</p>
                        <p>Fax: (000) 000 00 00 0</p>
                        <p>Email: <span>sonjoy.john@gmail.com</span></p>
                        <p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
