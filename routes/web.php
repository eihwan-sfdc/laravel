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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/product/{id}', 'PiController@product');
Route::get('/content/{id}', 'PiController@content');
Route::get('/banner/{id}', 'PiController@banner');
Route::get('/custom_activity', 'CustomActivityController@index');
Route::get('/pi/product/updateItem', 'PiController@product_updateItem');
Route::get('/pi/content/updateItem', 'PiController@content_updateItem');
Route::get('/pi/banner/updateItem', 'PiController@banner_updateItem');
