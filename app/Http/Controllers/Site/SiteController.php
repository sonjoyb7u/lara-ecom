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

        View::share(['brands'=>$brands, 'categories'=>$categories]);
    }

    public function index()
    {
        $sliders = Slider::with('user')->orderBy('id', 'asc')
            ->where('start', '<=', date('Y-m-d h:i:s'))
            ->where('end', '>=', date('Y-m-d h:i:s'))
            ->where('status', Slider::ACTIVE_STATUS)
            ->get();

        return view('site.index', compact( 'sliders'));
    }

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
//        return $products;

        return view('site.cat-wise-products', compact( 'category', 'cat_wise_products'));

    }

    public function subCatWiseProduct($slug)
    {
        $sub_cat_id = SubCategory::where('sub_category_slug', $slug)->pluck('id');
//        return $sub_cat_id;
        $sub_category = SubCategory::with('user', 'category', 'products')
                    ->where('sub_category_slug', $slug)
                    ->first();
//        return $sub_category;

        $products = Product::with('user', 'brand', 'category', 'subCategory')
                            ->where('sub_category_id', $sub_cat_id)
                            ->where('status', Product::ACTIVE_STATUS)
                            ->get();
//        return $products;

        return view('site.sub-cat-wise-products', compact( 'sub_cat_id', 'sub_category', 'products'));

    }

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
        $related_subcat_products = Product::with('user', 'brand', 'category', 'subCategory')                                           ->where('sub_category_id', $sub_cat_id)
                                            ->where('id', '!=', $product_id)
                                            ->where('status', Product::ACTIVE_STATUS)
                                            ->get();
//        return $products;

        return view('site.product-detail', compact( 'product_detail', 'related_subcat_products'));

    }

}
