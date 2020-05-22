<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index() {
        $brands = Brand::where('level', Brand::TOP_BRAND)
                        ->where('status', Brand::ACTIVE_BRAND)
                        ->get();
        $categories = Category::with('user', 'subCategories')->get();
        $sliders = Slider::with('user')->orderBy('id', 'asc')
            ->where('start', '<=', date('Y-m-d h:i:s'))
            ->where('end', '>=', date('Y-m-d h:i:s'))
            ->where('status', Slider::ACTIVE_STATUS)
            ->get();

        return view('site.index', compact('brands', 'sliders', 'categories'));
    }

    public function catWiseProduct($slug) {
        $brands = Brand::where('level', Brand::TOP_BRAND)
            ->where('status', Brand::ACTIVE_BRAND)
            ->get();
        $categories = Category::with('user', 'subCategories')->get();

        $category_id = Category::where('category_slug', $slug)->pluck('id');
//        return $category_id;
        $category = Category::with('user', 'subCategories')
                            ->where('category_slug', $slug)
                            ->get();
//        return $category;

        $cat_products = Product::with('user', 'brand', 'category', 'subCategory')
                            ->where('category_id', $category_id)
                            ->where('status', Product::ACTIVE_STATUS)
                            ->get();
//        return $products;

        return view('site.cat-wise-products', compact('brands', 'categories',  'category', 'cat_products'));

    }

    public function subCatWiseProduct($slug) {
        $brands = Brand::where('level', Brand::TOP_BRAND)
                        ->where('status', Brand::ACTIVE_BRAND)
                        ->get();
        $categories = Category::with('user', 'subCategories')->get();
        $sub_cat_id = SubCategory::where('sub_category_slug', $slug)->pluck('id');
//        return $sub_cat_id;
        $sub_category = SubCategory::with('user', 'category', 'products')
                    ->where('sub_category_slug', $slug)
                    ->get();
//        return $sub_category;

        $products = Product::with('user', 'brand', 'category', 'subCategory')
                            ->where('sub_category_id', $sub_cat_id)
                            ->where('status', Product::ACTIVE_STATUS)
                            ->get();
//        return $products;

        return view('site.sub-cat-wise-products', compact('brands','categories', 'sub_cat_id', 'sub_category', 'products'));

    }

}
