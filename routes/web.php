<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
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
  Route::post('/searchcat', [SearchController::class, 'showCategorySearch'])->name('searchcat');
  Route::get('profile/user/{name}', [ProfileController::class, 'profile'])->name('profile');
  Route::post('profile/updatemail', [ProfileConrtoller::class, 'updateEmail'])->name('updateEmail');
  Route::get('/settings', [PageController::class, 'settings'])->name('settings');
  Route::post('/settings/reset', [SettingsController::class, 'resetPassword'])->name('reset');
  Route::group(['middleware' => ['checkrole']], function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('admin');
    Route::post('/dashboard/newproduct', [AdminController::class, 'addProduct'])->name('newproduct');
    Route::post('/products/details/update', [ProductDetailController::class, 'updateProduct'])->name('updateproduct');
    Route::post('/products/details/delete', [ProductDetailController::class, 'deleteProduct'])->name('deleteProduct');
    Route::post('/dashboard/addcategory', [AdminController::class, 'addCategory'])->name('addCategory');
    Route::get('/dashboard/editcategory', [CategoryController::class, 'category'])->name('editCategory');
    Route::post('/dashboard/updatecategory', [CategoryController::class, 'updateCategory'])->name('updateCategory');
    Route::post('/dashboard/deleteCategory', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
  });
});
