<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ConfirmationController;


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

Route::get('/category/{name}', [ProductController::class, 'category']);
Route::get('/detail/{product_id}', [ProductController::class, 'detail']);

Route::post('/product/add_to_cart', [ProductController::class, 'add_to_cart'])->middleware('auth');
Route::post('/product/add_to_wishlist', [ProductController::class, 'add_to_wishlist'])->middleware('auth');

Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::post('/cart/delete', [CartController::class, 'delete'])->middleware('auth');
Route::post('/checkout', [OrderController::class, 'checkout'])->middleware('auth');
Route::get('/confirmation/{order_id}', [ConfirmationController::class, 'index'])->middleware('auth');

Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('auth');
Route::post('/wishlist/delete', [WishlistController::class, 'delete'])->middleware('auth');

Route::get('/static', function () {
    return view('static');
});

Route::get('/static-page-a', function () {
    return view('static-a');
});
Route::get('/static-page-b', function () {
    return view('static-b');
});
Route::get('/static-page-c', function () {
    return view('static-c');
});

Route::post('/email-signin', [DummyController::class, 'email_signin']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'basicauth'], function() {
    //ここにBasic認証をかけたいルーティングの設定を記述して下さい
    //例
    Route::get('tokenized', 'TokenizedSendingController@gettest');
});