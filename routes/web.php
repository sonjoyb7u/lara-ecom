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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::namespace('Site')->name('site.')->group(function () {
    Route::get('/', 'SiteController@index')->name('index');
});

// Route::group(['namespace' => 'Auths', 'prefix' => 'admin'], function () {
//     Route::get('login', 'AuthController@showLoginForm')->name('login');
//     Route::get('register', 'AuthController@showRegisterForm')->name('register');
// });

// Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'name' => 'admin.'], function () {
//     Route::get('/home', 'Admin\AdminController@index')->name('home');
// });

Auth::routes();

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'AdminController@admin')->name('home');

    Route::prefix('brands')->namespace('Brand')->name('brand.')->group(function () {
        Route::get('/', 'BrandController@index')->name('index');
        Route::get('show', 'BrandController@show')->name('show');
        Route::post('store/{id}', 'BrandController@store')->name('store');
        Route::get('create', 'BrandController@create')->name('create');
    });

    Route::prefix('categories')->namespace('Category')->name('category.')->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('show', 'CategoryController@show')->name('show');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('store/{user_id}', 'CategoryController@store')->name('store');

    });

});

Route::middleware('auth', 'is_admin')->prefix('super-admin')->namespace('Admin')->name('super-admin.')->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('home');

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

    Route::prefix('categories')->namespace('Category')->name('category.')->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::get('show', 'CategoryController@show')->name('show');
        Route::get('create', 'CategoryController@create')->name('create');
        Route::post('store/{user_id}', 'CategoryController@store')->name('store');
        Route::delete('delete/{category_id}', 'CategoryController@destroy')->name('delete');
        Route::get('edit/{category_id}', 'CategoryController@edit')->name('edit');
        Route::put('update/{category_id}', 'CategoryController@update')->name('update');
        Route::get('status/{category_id}/{category_status}', 'CategoryController@updateStatus')->name('status');
    });
});
