<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $brands = Brand::where('level', Brand::TOP_BRAND)
            ->where('status', Brand::ACTIVE_BRAND)
            ->get();
        $categories = Category::with('user', 'subCategories', 'products')->get();
//        return $categories;

//      Left side New Special Deal products showing...
        $no_special_price = null;
        $special_deal_products = Product::with('user', 'brand', 'category', 'subCategory')
            ->where('status', Product::ACTIVE_STATUS)
            ->where('special_price', '<>', $no_special_price)
            ->latest()
            ->get();
//        return $special_deal_products;

        //Left side New products showing...
        $new_special_products = Product::with('user', 'brand', 'category', 'subCategory')
            ->where('status', Product::ACTIVE_STATUS)
            ->limit(10)
            ->latest()
            ->get();
//        return $new_special_products;

        View::share(['brands' => $brands, 'categories' => $categories, 'new_special_products' => $new_special_products, 'special_deal_products' => $special_deal_products]);
    }
}
