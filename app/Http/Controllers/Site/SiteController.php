<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index() {
        $categories = Category::with('subCategories')
                        ->where('status', Category::ACTIVE_STATUS)
                        ->get();
        $sliders = Slider::with('user')->orderBy('id', 'asc')
            ->where('start', '<=', date('Y-m-d h:i:s'))
            ->where('end', '>=', date('Y-m-d h:i:s'))
            ->where('status', Slider::ACTIVE_STATUS)
            ->get();

        return view('site.index', compact('sliders', 'categories'));
    }

    public function catWiseProduct($slug) {
        $category_id = Category::where('category_slug', $slug)->select('id')->get();
        return $category_id;
    }

    public function subCatWiseProduct($slug) {
        $sub_cat_id = SubCategory::where('sub_category_slug', $slug)->pluck('id');
//        return $sub_cat_id;
        $products = Product::find($sub_cat_id);
//        return $Products;

        return view('site.sub_cat_wise_products', compact('products'));
    }

}
