<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\CheckoutController;
use App\Http\Controllers\client\ProductController;
use App\Http\Controllers\client\ContactController;
use App\Http\Controllers\client\LoginController;
use App\Http\Controllers\admin\DashbordController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\admin\Sub_CategoryController as AdminSub_CategoryController;
use App\Http\Controllers\admin\BrandController as AdminBrandController;
use App\Http\Controllers\admin\DivisionController as AdminDivisionController;
use App\Http\Controllers\admin\DistrictController as AdminDistrictController;
use App\Http\Controllers\admin\StationController as AdminStationController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\admin\SliderController as AdminSliderController;
use App\Http\Controllers\admin\SitesettingController as AdminSitesettingController;


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

Route::get('/',[HomeController::class,'index'])->name('client.home');
Route::get('/checkout',[CheckoutController::class,'index'])->name('client.checkout');
Route::get('/contact',[ContactController::class,'index'])->name('client.contact');
Route::get('/products',[ProductController::class,'product'])->name('client.product');
Route::get('/product-detailse/{id}',[ProductController::class,'productdetailse'])->name('client.product.detailse');
Route::get('/login',[LoginController::class,'index'])->name('client.login');
Route::resource('/carts', CartController::class);


//admin
Route::prefix('admin')->group(function(){
    //dashbord
    Route::get('/dashboard',[DashbordController::class,'index'])->name('admin.dashbord.index');
    //Product
    Route::resource('products', AdminProductController::class);
    //Category
    Route::resource('categories', AdminCategoryController::class);
    //Sub_Category
    Route::resource('subcategories', AdminSub_CategoryController::class);
    //Brand
    Route::resource('brands', AdminBrandController::class);
    //Division
    Route::resource('divisions', AdminDivisionController::class);
    //District
    Route::resource('districts', AdminDistrictController::class);
    //Stasion
    Route::resource('stations', AdminStationController::class);
    //Stasion
    Route::resource('users', AdminUserController::class);
    //Slider
    Route::resource('sliders', AdminSliderController::class);
     //sitesetting
     Route::resource('sitesettings', AdminSitesettingController::class);

});


