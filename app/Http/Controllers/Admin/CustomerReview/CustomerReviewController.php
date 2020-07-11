<?php

namespace App\Http\Controllers\Admin\CustomerReview;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $customer_reviews = CustomerReview::with('customer', 'product')->latest()->get();
        return view('admin.customer-review.index', compact('customer_reviews'));

    }

    /**
     * @param $customer_review_id
     * @param $customer_review_status
     */
    public function updateStatus($customer_review_id, $customer_review_status)
    {
        $review_detail = CustomerReview::find($customer_review_id);
        $review_detail->status = $customer_review_status;

        $review_detail->save();

    }

    
}
