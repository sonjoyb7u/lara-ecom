<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUsMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

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
//        return $slug;
        $product_id = Product::where('slug', $slug)->pluck('id');
//        return $product_id;
        $product_detail = Product::with('user', 'brand', 'category', 'subCategory')
            ->where('id', $product_id)
            ->where('status', Product::ACTIVE_STATUS)
            ->first();
//        return $product_detail;
//        return json_decode($product_detail->gallery);
        $sub_cat_id = $product_detail->sub_category_id;
//        return $sub_cat_id;

        $related_subcat_products = Product::with('user', 'brand', 'category', 'subCategory')
                                            ->where('sub_category_id', $sub_cat_id)
                                            ->where('id', '!=', $product_id)
                                            ->where('status', Product::ACTIVE_STATUS)
                                            ->get();
//        return $related_subcat_products;

        return view('site.pages.product-detail', compact('product_detail', 'related_subcat_products'));

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

    public function searchProducts(Request $request) {
        if($request->isMethod('POST')) {
            $search = $request->search;

            $all_search_products = Product::where('title', 'LIKE', '%' . $search . '%')->orwhere('slug', 'LIKE', '%' . $search . '%')->orwhere('desc', 'LIKE', '%' . $search . '%')->orwhere('long_desc', 'LIKE', '%' . $search . '%')->orwhere('sales_price', $search)->orwhere('product_code', $search)->where('status', Product::ACTIVE_STATUS)->get();
//            return $all_search_products;

            return view('site.pages.search-products', compact('all_search_products'));


        }
    }


}
