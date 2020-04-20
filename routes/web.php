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
        Route::post('store', 'BrandController@store')->name('store');
        Route::get('create', 'BrandController@create')->name('create');


        
    });


});

Route::middleware('auth', 'is_admin')->prefix('super-admin')->namespace('Admin')->name('super-admin.')->group(function () {

    Route::get('dashboard', 'AdminController@index')->name('home');

    // Route::post('logout', 'AdminController@logout')->name('logout');

    Route::prefix('brands')->namespace('Brand')->name('brand.')->group(function () {
        Route::get('/', 'BrandController@index')->name('index');
        Route::get('show', 'BrandController@show')->name('show');
        Route::get('edit', 'BrandController@edit')->name('edit');
        Route::post('store', 'BrandController@store')->name('store');
        Route::get('create', 'BrandController@create')->name('create');
        Route::get('delete', 'BrandController@delete')->name('delete');

        


    });

});
