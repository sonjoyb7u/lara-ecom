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

Route::group(['prefix' => 'admin','namespace' => 'Admin', 'name' =>'admin.'], function() {
    Route::get('/', 'AdminController@index')->name('index');

});
