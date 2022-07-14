<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;


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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('auth');
Route::get('/home', [PageController::class, 'home'])->name('home')->middleware('checklogin');
Route::get('/products', [PageController::class, 'products'])->name('product')->middleware('checklogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/products/addproduct', [OrderController::class, 'addToCart'])->name('addtocart')->middleware('checklogin');
Route::post('/products/removeproduct', [OrderController::class, 'removeFromCart'])->name('removefromcart')->middleware('checklogin');
Route::get('/order', [PageController::class, 'order'])->name('order')->middleware('checklogin');
Route::post('/order/buy', [OrderController::class, 'payment'])->name('pay')->middleware('checklogin');
Route::get('/orderhistory', function(){return view('orderHistory');})->name('orderhistory')->middleware('checklogin');
Route::get('/products/details/{product}', [ProductDetailController::class, 'getProductPage'])->name('productdetail')->middleware('checklogin');
Route::post('/searching', [SearchController::class, 'showSearch'])->name('showSearch')->middleware('checklogin');
Route::get('/search', [SearchController::class, 'showSearch'])->name('search')->middleware('checklogin');
