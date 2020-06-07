<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class SiteController extends Controller
{
    public function __construct()
    {
        $brands = Brand::where('level', Brand::TOP_BRAND)
            ->where('status', Brand::ACTIVE_BRAND)
            ->get();
        $categories = Category::with('user', 'subCategories')->get();

//      Left side New Special Deal products showing...
        $no_special_price = null;
        $special_deal_products = Product::with('user', 'brand', 'category', 'subCategory')
            ->where('status',Product::ACTIVE_STATUS)
            ->where('special_price', '<>', $no_special_price)
            ->latest()
            ->get();
//        return $special_deal_products;

        //Left side New products showing...
        $new_special_products = Product::with('user', 'brand', 'category', 'subCategory')
                                ->where('status',Product::ACTIVE_STATUS)
                                ->limit(10)
                                ->latest()
                                ->get();
//        return $new_special_products;

        View::share(['brands'=>$brands, 'categories'=>$categories, 'new_special_products'=>$new_special_products,  'special_deal_products'=>$special_deal_products]);
    }

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

        return view('site.index', compact( 'sliders', 'products', 'featured_products', 'new_arriaval_products'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function brandWiseProduct($slug) {
        $brand_id = Brand::where('brand_slug', $slug)->pluck('id');
//        return $brand_id;

        $brand = Brand::where('id', $brand_id)
            ->where('status', Brand::ACTIVE_BRAND)
            ->first();
//        return $brand;

        $brand_wise_products = Product::where('brand_id', $brand_id)->get();
//        return $brand_wise_products;

        return view('site.brand-wise-products', compact('brand', 'brand_wise_products'));

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

        return view('site.cat-wise-products', compact( 'category', 'cat_wise_products'));

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

        return view('site.sub-cat-wise-products', compact( 'sub_cat_id', 'sub_category'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadSubCatProduct(Request $request) {
        $sub_cat_id = json_decode($request->sub_cat_id);
//        return $sub_cat_id;
//        $sub_cat_id = SubCategory::where('sub_category_slug', $request->slug)->pluck('id');
//        return $id;
        if($request->ajax()) {
            if($request->id && $sub_cat_id) {
//                return "1";
                $products = Product::with('user', 'brand', 'category', 'subCategory')->where('sub_category_id', $sub_cat_id)->where('id', '<', $request->id)->orderBy('id', 'DESC')->limit(4)->get();

            } else {
//                return "0";
                $products = Product::with('user', 'brand', 'category', 'subCategory') ->where('sub_category_id', $sub_cat_id)->orderBy('id', 'DESC')->limit(4)->get();

            }

        }
        return view('site.load-sub-cat-grid-product', compact('products'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadSubCatListProduct(Request $request) {
        $sub_cat_id = json_decode($request->sub_cat_id);
//        return $sub_cat_id;
//        $sub_cat_id = SubCategory::where('sub_category_slug', $request->slug)->pluck('id');
//        return $id;
        if($request->ajax()) {
            if($request->id && $sub_cat_id) {
//                return "1";
                $products = Product::with('user', 'brand', 'category', 'subCategory')->where('sub_category_id', $sub_cat_id)->where('id', '<', $request->id)->orderBy('id', 'DESC')->limit(4)->get();

            } else {
//                return "0";
                $products = Product::with('user', 'brand', 'category', 'subCategory') ->where('sub_category_id', $sub_cat_id)->orderBy('id', 'DESC')->limit(4)->get();

            }

        }
        return view('site.load-sub-cat-list-product', compact('products'));
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

        $related_subcat_products = Product::with('user', 'brand', 'category', 'subCategory')                             ->where('sub_category_id', $sub_cat_id)
                                            ->where('id', '!=', $product_id)
                                            ->where('status',Product::ACTIVE_STATUS)
                                            ->get();
//        return $related_subcat_products;

        return view('site.product-detail', compact( 'product_detail', 'related_subcat_products'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function faqContent() {
        return view('site.components.partials.faq');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function helpCenterContent() {
        return view('site.components.partials.help-center');
    }

    public function contactUs() {
        return view('site.pages.contact-us');
    }


}
