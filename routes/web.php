<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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
Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::post('/checkout', [OrderController::class, 'checkout'])->middleware('auth');
Route::get('/checkout_complete', function(){
    return view('checkout_complete');
});

Route::post('/product/add_to_cart', [ProductController::class, 'add_to_cart'])->middleware('auth');
Route::post('/product/add_to_wishlist', [ProductController::class, 'add_to_wishlist'])->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'basicauth'], function() {
    Route::get('/basic-auth-test', function () {
        return view('welcome');
    });
});
