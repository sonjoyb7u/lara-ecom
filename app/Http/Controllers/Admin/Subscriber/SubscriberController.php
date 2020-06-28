<?php

namespace App\Http\Controllers\Admin\Subscriber;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index() {
        $subscribers = NewsletterSubscriber::latest()->get();
//        return $subscribers;
        return view('admin.subscriber.index', compact('subscribers'));
    }
}
