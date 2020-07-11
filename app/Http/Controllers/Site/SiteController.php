<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Customer;
use App\Models\CustomerReview;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class SiteController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sliders = Slider::with('user')->orderBy('id', 'asc')
            ->where('start', '<=', date('Y-m-d h:i:s'))
            ->where('end', '>=', date('Y-m-d h:i:s'))
            ->where('status', Slider::ACTIVE_STATUS)
            ->get();

        // All Products Show on Home page...
        $products = Product::with('user', 'brand', 'category', 'subCategory')->where('status', Product::ACTIVE_STATUS)->latest()->get();
//        return $products;

        // Featured Products show on Home page...
        $featured_products = Product::with('user', 'brand', 'category', 'subCategory')->where('is_featured', Product::FEATURED)->where('status', Product::ACTIVE_STATUS)->latest()->get();

        // New Arriaval Products show on Home page...
        $new_arriaval_products = Product::with('user', 'brand', 'category', 'subCategory')->where('is_new', Product::NEW_ARRIVAL)->where('status', Product::ACTIVE_STATUS)->latest()->get();

        return view('site.index', compact('sliders', 'products', 'featured_products', 'new_arriaval_products'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function brandWiseProduct($slug)
    {
        $brand_id = Brand::where('brand_slug', $slug)->pluck('id');
//        return $brand_id;
        $brand = Brand::where('id', $brand_id)
            ->where('status', Brand::ACTIVE_BRAND)
            ->first();
//        return $brand;
        $brand_wise_products = Product::where('brand_id', $brand_id)->get();
//        return $brand_wise_products;

        return view('site.pages.brand-wise-products', compact('brand', 'brand_wise_products'));

    }


    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function catWiseProduct($slug)
    {
        $category_id = Category::where('category_slug', $slug)->pluck('id');
//        return $category_id;
        $category = Category::where('category_slug', $slug)->first();
//        return $category->category_name;

        $cat_wise_products = Product::with('user', 'brand', 'category', 'subCategory')
            ->where('category_id', $category_id)
            ->where('status', Product::ACTIVE_STATUS)
            ->get();
//        return $cat_wise_products;

        return view('site.pages.cat-wise-products', compact('category', 'cat_wise_products'));

    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subCatWiseProduct($slug)
    {
        $sub_cat_id = SubCategory::where('sub_category_slug', $slug)->pluck('id');
//        return $sub_cat_id;
        $sub_category = SubCategory::with('user', 'category', 'products')
            ->where('sub_category_slug', $slug)
            ->first();
//        return $sub_category;

        return view('site.pages.sub-cat-wise-products', compact('sub_cat_id', 'sub_category'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadSubCatProduct(Request $request)
    {
        $sub_cat_id = json_decode($request->sub_cat_id);
//        return $sub_cat_id;
//        $sub_cat_id = SubCategory::where('sub_category_slug', $request->slug)->pluck('id');
//        return $id;
        if ($request->ajax()) {
            if ($request->id && $sub_cat_id) {
//                return "1";
                $products = Product::with('user', 'brand', 'category', 'subCategory')->where('sub_category_id', $sub_cat_id)->where('id', '<', $request->id)->orderBy('id', 'DESC')->limit(4)->get();

            } else {
//                return "0";
                $products = Product::with('user', 'brand', 'category', 'subCategory')->where('sub_category_id', $sub_cat_id)->orderBy('id', 'DESC')->limit(4)->get();

            }

        }
        return view('site.pages.load-sub-cat-grid-product', compact('products'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadSubCatListProduct(Request $request)
    {
        $sub_cat_id = json_decode($request->sub_cat_id);
//        return $sub_cat_id;
//        $sub_cat_id = SubCategory::where('sub_category_slug', $request->slug)->pluck('id');
//        return $id;
        if ($request->ajax()) {
            if ($request->id && $sub_cat_id) {
//                return "1";
                $products = Product::with('user', 'brand', 'category', 'subCategory')->where('sub_category_id', $sub_cat_id)->where('id', '<', $request->id)->orderBy('id', 'DESC')->limit(4)->get();

            } else {
//                return "0";
                $products = Product::with('user', 'brand', 'category', 'subCategory')->where('sub_category_id', $sub_cat_id)->orderBy('id', 'DESC')->limit(4)->get();

            }

        }
        return view('site.pages.load-sub-cat-list-product', compact('products'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function productDetail($slug)
    {
        $product_id = Product::where('slug', $slug)->pluck('id');
//        return $product_id;
        $product_detail = Product::with('user', 'brand', 'category', 'subCategory', 'reviews')
                            ->where('id', $product_id)
                            ->where('status', Product::ACTIVE_STATUS)
                            ->first();
//        return $product_detail->id;
//        return json_decode($product_detail->gallery);

        $customer_reviews = CustomerReview::with('customer')->where('product_id', $product_detail->id)->where('status', CustomerReview::VISIBLE_STATUS)->latest()->get();
//        return $customer_reviews;
        $count_order_item = OrderItem::with('order')->where('product_id', '=', $product_detail->id)->count();
//        return $count_order_item;


        $sub_cat_id = $product_detail->sub_category_id;
        $related_subcat_products = Product::with('user', 'brand', 'category', 'subCategory')
                                    ->where('sub_category_id', $sub_cat_id)
                                    ->where('id', '!=', $product_id)
                                    ->where('status', Product::ACTIVE_STATUS)
                                    ->get();
//        return $related_subcat_products;

        return view('site.pages.product-detail', compact('product_detail', 'related_subcat_products', 'customer_reviews', 'count_order_item'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function reviewStore(Request $request) {
        $this->validate($request, [
            'product' => 'required',
            'rating' => 'required',
            'message' => 'required',
        ]);

        $customer_review = CustomerReview::create([
            'customer_id'=>Session::get('cuStOmArId'),
            'product_id'=>$request->product,
            'rating'=>$request->rating,
            'message'=>$request->message,
        ]);
        if($customer_review) {
            getMessage('success', 'Your Rating and Review has been sent.');
            return redirect()->back();
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderTrack() {
        return view('site.pages.order-tracker');
    }

    public function orderTrackCheck(Request $request) {
//        return $request->all();
        $this->validate($request, [
            'order_id' => 'required',
        ]);
        $order_status = Order::with('payment')->where('id', $request->order_id)->get();
        if($order_status) {
            return view('site.pages.order-tracker-status', compact('order_status'));

        } else {
            getMessage('danger', 'Your Order Number is Invalid, please valid Info!');
            return redirect()->back();
        }

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function faq()
    {
        return view('site.page-error.faq');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function termsCondition()
    {
        return view('site.page-error.terms-condition');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactUs()
    {
        return view('site.pages.contact-us');
    }

    /**
     * @param ContactUsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMail(ContactUsRequest $request)
    {
//        $from_email = config("mail.from['address']", $request->email);
//        return $from_email;

        $contact_us_info_detail = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'address' => $request->address,
            'message' => $request->message,
        ];
//        return $contact_us_info_detail;
        $contact_info = ContactUs::create($contact_us_info_detail);
        if($contact_info) {
            Mail::to('lara.ecomm@gmail.com')->send(new ContactUsMail($contact_us_info_detail));

            getMessage('success', 'Success, Your Message Has Been Sent Success, Thanks for get in touch and contact soon.');
            Toastr::success('Your Message Has Been Sent Success, Thanks for get in touch and contact soon.', 'Success');
            return redirect()->back();
        } else {
            getMessage('danger', 'Failed, Your Message Has Not Been Sent.');
            Toastr::success('Your Message Has Not Been Sent.', 'Failed');
            return redirect()->back();
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function searchGetProducts(Request $request) {
        if($request->isMethod('GET')) {
            $this->validate($request, [
                'search' => 'required',
            ]);
            $search = $request->search;
            $all_search_products = Product::where('title', 'LIKE', '%' . $search . '%')->orWhere('slug', 'LIKE', '%' . $search . '%')->orWhere('desc', 'LIKE', '%' . $search . '%')->orWhere('long_desc', 'LIKE', '%' . $search . '%')->orWhere('sales_price', $search)->orWhere('product_code', $search)->orWhere('status', Product::ACTIVE_STATUS)->select('id', 'title', 'slug', 'image', 'image_start', 'image_end', 'sales_price', 'special_price', 'special_start', 'special_end')->get();

            return view('site.pages.search-products', compact('all_search_products'));


        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function searchPostProducts(Request $request) {
        if($request->isMethod('POST')) {
            $this->validate($request, [
                'search' => 'required',
            ]);
            $search = $request->search;
            $all_search_products = Product::where('title', 'LIKE', '%' . $search . '%')->select('id', 'title', 'slug', 'image', 'image_start', 'image_end', 'sales_price', 'special_price', 'special_start', 'special_end')->take(5)->get();

            return view('site.pages.search-result', compact('all_search_products'));

        }
    }


}
