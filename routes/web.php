<?php

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

Route::group(['namespace' => 'Site', 'name'=>'site.'], function () {
    Route::get('/', 'SiteController@index')->name('index');

});

Route::group(['namespace' => 'Admin\Auths', 'prefix' => 'admin'], function () {
    Route::get('login', 'AuthController@showLoginForm')->name('login');
    Route::get('register', 'AuthController@showRegisterForm')->name('register');

});

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'name' => 'admin.'], function () {
    Route::get('/home', 'Admin\AdminController@index')->name('home');

});
