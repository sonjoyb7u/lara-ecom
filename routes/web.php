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
});

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
        Route::put('update/{slider_id}', 'SliderController@update')->name('update');
        Route::get('status/{slider_id}/{slider_status}', 'SliderController@updateStatus')->name('status');
    });
});
