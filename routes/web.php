<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
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
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/authenticate', [LoginController::class, 'authenticate'])->name('auth');
Route::group(['middleware' => ['checklogin']], function () {
  Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('/products', [PageController::class, 'products'])->name('product');
  Route::post('/products/addproduct', [OrderController::class, 'addToCart'])->name('addtocart');
  Route::post('/products/removeproduct', [OrderController::class, 'removeFromCart'])->name('removefromcart');
  Route::get('/order', [PageController::class, 'order'])->name('order');
  Route::post('/order/buy', [OrderController::class, 'payment'])->name('pay');
  Route::get('/orderhistory', function(){return view('orderHistory');})->name('orderhistory');
  Route::get('/products/details/{product}', [ProductDetailController::class, 'getProductPage'])->name('productdetail');
  Route::post('/searching', [SearchController::class, 'showSearch'])->name('showSearch');
  Route::get('/search', [SearchController::class, 'showSearch'])->name('search');
  Route::get('profile/{name}', [ProfileController::class, 'profile'])->name('profile');
});
Route::get('/resize', [FileController::class, 'resize']);
Route::post('/image-resize', [FileController::class, 'imgResize'])->name('img-resize');
