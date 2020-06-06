<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * FRONT-SITE route...
 */
Route::namespace('Site')->name('site.')->group(function () {
    Route::get('/', 'SiteController@index')->name('index');
    // Brand Wise Product Founding Route...
    Route::get('brand/{slug}', 'SiteController@brandWiseProduct')->name('brand');
    // Category Wise Product Founding Route...
    Route::get('category/{slug}', 'SiteController@catWiseProduct')->name('category');
    // Sub Category Wise Product Founding Route...
    Route::get('sub-category/{slug}', 'SiteController@subCatWiseProduct')->name('sub-category');
    // Single product Detail Route...
    Route::get('product-detail/{slug}', 'SiteController@productDetail')->name('product-detail');
    // Fetch Sub Category Grid style product using Ajax Route...
    Route::post('load-subcat-product', 'SiteController@loadSubCatProduct')->name('load-subcat-product');
    // Fetch Sub Category List style product using Ajax Route...
    Route::post('load-subcat-list-product', 'SiteController@loadSubCatListProduct')->name('load-subcat-list-product');
    // Shopping Cart Item CRUD route...
    Route::group(['prefix'=>'cart', 'namespace'=>'Cart', 'as'=>'cart.'], function () {
        Route::get('show', 'CartController@index')->name('show');
        Route::post('add', 'CartController@addCart')->name('add');
        Route::post('delete', 'CartController@deleteCart')->name('delete');
        Route::post('update', 'CartController@updateCart')->name('update');
//        Route::post('update-grand-totel-price', 'CartController@updateGrandTotalPrice');
    });

});


/**
 * PRACTICE and TESTING route define...
 */
Route::get('fetch-cat-data', 'Practice\PracticeTestController@fatchCatData')->name('fetch-cat-data');
Route::post('fetch-cat-data', 'Practice\PracticeTestController@loadCatData')->name('fetch-cat-data');

/**
 * DEFAULT AUTHENTICATE route...
 */
Auth::routes();

/**
 * NORMAL ADMIN AUTHENTICATE LOGIN WITH SECTION WISE AUTHORIZED route...
 */
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    /**
     * NORMAL ADMIN DASHBOARD route...
     */
    Route::get('dashboard', 'AdminController@admin')->name('home');

    /**
     * NORMAL ADMIN BRAND route...
     */
    Route::prefix('brands')->namespace('Brand')->name('brand.')->group(function () {
        Route::get('/', 'BrandController@index')->name('index');
        Route::get('show', 'BrandController@show')->name('show');
        Route::post('store/{id}', 'BrandController@store')->name('store');
        Route::get('create', 'BrandController@create')->name('create');
    });

    /**
     * NORMAL ADMIN CATEGORY route...
     */
    Route::prefix('categories')->namespace('Category')->name('category.')->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('show', 'CategoryController@show')->name('show');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('store/{user_id}', 'CategoryController@store')->name('store');
    });

    /**
     * NORMAL ADMIN SUB-CATEGORY route...
     */
    Route::prefix('sub-categories')->namespace('Category')->name('sub-category.')->group(function () {
        Route::get('/', 'SubCategoryController@index')->name('index');
        Route::get('show', 'SubCategoryController@show')->name('show');
        Route::get('create', 'SubCategoryController@create')->name('create');
        Route::post('store/{user_id}', 'SubCategoryController@store')->name('store');
    });

    /**
     * NORMAL ADMIN SLIDER route...
     */
    Route::prefix('sliders')->namespace('Slider')->name('slider.')->group(function () {
        Route::get('/', 'SliderController@index')->name('index');
        Route::get('show', 'SliderController@show')->name('show');
        Route::get('create', 'SliderController@create')->name('create');
        Route::post('store/{user_id}', 'SliderController@store')->name('store');
    });

    /**
     * NORMAL ADMIN PRODUCTS route...
     */
    Route::prefix('products')->namespace('Product')->name('product.')->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('show', 'ProductController@show')->name('show');
        Route::get('create', 'ProductController@create')->name('create');
        Route::post('store/{user_id}', 'ProductController@store')->name('store');
    });
});

/**
 * SUPER ADMIN AUTHENTICATE LOGIN WITH SECTION WISE AUTHORIZED route...
 */
Route::middleware('auth', 'is_admin')->prefix('super-admin')->namespace('Admin')->name('super-admin.')->group(function () {
    /**
     * SUPER ADMIN DASHBOARD route...
     */
    Route::get('dashboard', 'AdminController@index')->name('home');

    /**
     * SUPER ADMIN BRAND route...
     */
    Route::prefix('brands')->namespace('Brand')->name('brand.')->group(function () {
        Route::get('/', 'BrandController@index')->name('index');
        Route::get('show', 'BrandController@show')->name('show');
        Route::get('create', 'BrandController@create')->name('create');
        Route::post('store/{user_id}', 'BrandController@store')->name('store');
        Route::delete('delete/{brand_id}', 'BrandController@destroy')->name('delete');
        Route::get('edit/{brand_id}', 'BrandController@edit')->name('edit');
        Route::put('update/{brand_id}', 'BrandController@update')->name('update');
        Route::get('status/{brand_id}/{brand_status}', 'BrandController@updateStatus')->name('status');
    });

    /**
     * SUPER ADMIN CATEGORY route...
     */
    Route::prefix('categories')->namespace('Category')->name('category.')->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('show', 'CategoryController@show')->name('show');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('store/{user_id}', 'CategoryController@store')->name('store');
        Route::delete('delete/{category_id}', 'CategoryController@destroy')->name('delete');
        Route::get('edit/{category_id}', 'CategoryController@edit')->name('edit');
        Route::put('update/{category_id}/{user_id}', 'CategoryController@update')->name('update');
        Route::get('status/{category_id}/{category_status}', 'CategoryController@updateStatus')->name('status');
    });

    /**
     * SUPER ADMIN SUB-CATEGORY route...
     */
    Route::prefix('sub-categories')->namespace('Category')->name('sub-category.')->group(function () {
        Route::get('/', 'SubCategoryController@index')->name('index');
        Route::get('show', 'SubCategoryController@show')->name('show');
        Route::get('create', 'SubCategoryController@create')->name('create');
        Route::post('store/{user_id}', 'SubCategoryController@store')->name('store');
        Route::delete('delete/{sub_category_id}', 'SubCategoryController@destroy')->name('delete');
        Route::get('edit/{sub_category_id}', 'SubCategoryController@edit')->name('edit');
        Route::put('update/{sub_category_id}/{user_id}', 'SubCategoryController@update')->name('update');
        Route::get('status/{sub_category_id}/{sub_category_status}', 'SubCategoryController@updateStatus')->name('status');
    });

    /**
     * SUPER ADMIN SLIDER route...
     */
    Route::prefix('sliders')->namespace('Slider')->name('slider.')->group(function () {
        Route::get('/', 'SliderController@index')->name('index');
        Route::get('show', 'SliderController@show')->name('show');
        Route::get('create', 'SliderController@create')->name('create');
        Route::post('store/{user_id}', 'SliderController@store')->name('store');
        Route::delete('delete/{slider_id}', 'SliderController@destroy')->name('delete');
        Route::get('edit/{slider_id}', 'SliderController@edit')->name('edit');
        Route::put('update/{slider_id}/{user_id}', 'SliderController@update')->name('update');
        Route::get('status/{slider_id}/{slider_status}', 'SliderController@updateStatus')->name('status');
    });

    /**
     * SUPER ADMIN PRODUCTS route...
     */
    Route::prefix('products')->namespace('Product')->name('product.')->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('show', 'ProductController@show')->name('show');
        Route::get('create', 'ProductController@create')->name('create');
        Route::post('store/{user_id}', 'ProductController@store')->name('store');
        Route::delete('delete/{product_id}', 'ProductController@destroy')->name('delete');
        Route::get('edit/{product_id}', 'ProductController@edit')->name('edit');
        Route::put('update/{product_id}/{user_id}', 'ProductController@update')->name('update');
        Route::get('status/{product_id}/{product_status}', 'ProductController@updateStatus')->name('status');
        Route::get('find-cat-wise-subcat/{cat_id}', 'ProductController@findCatWiseSubCat');
        Route::get('update-original-price/{id}/{price}', 'ProductController@updateOriginalPrice');
        Route::post('update-sales-price', 'ProductController@updateSalesPrice');
        Route::get('update-special-price/{id}/{price}', 'ProductController@updateSpecialPrice');
        Route::get('update-offer-price/{id}/{price}', 'ProductController@updateOfferPrice');
    });
});
