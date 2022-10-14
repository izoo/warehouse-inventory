<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Auth\LoginController as Login;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

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

Route::group(['prefix' => 'admin'],function(){
    Route::get('login', [LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class,'login'])->name('admin.login.post');
    Route::get('logout', [LoginController::class,'logout'])->name('admin.logout');
    Route::group(['middleware' => ['auth:admin']],function(){
       
        Route::get('/',function(){
            return view('admin.dashboard.warehouses.create');
        })->name('admin.dashboard');
        Route::get('feedback_messages',function(){
            return view('admin.dashboard.feedbacks');
        })->name('feedback_messages');
        Route::post('update_itemss',[ItemController::class,'update'])->name('update_items');
        Route::delete('items/{id}',[ItemController::class,'destroy']);
        Route::resource('warehouses',WarehouseController::class);
        Route::resource('clients',ClientController::class);
        Route::resource('banners',BannerController::class);
        Route::get('users-list',[ClientController::class,'clientList'])->name('users-list');
        Route::resource('services',ServiceController::class);
        Route::resource('items',ItemController::class);
        Route::resource('technicians',TechnicianController::class);
        Route::post('technician-update',[TechnicianController::class,'updateTechnician'])->name('technician-update');
        Route::resource('repairs',RepairsController::class);
        Route::resource('system-orders',OrderController::class);
        Route::post('product_orders',[OrderController::class,'productOrders'])->name('product_orders');
        Route::resource('categories',CategoryController::class);
        Route::post('category-update',[CategoryController::class,'update'])->name('category-update');
        Route::resource('product_images',ProductImageController::class);
        Route::get('product_images/{id}/delete', [ProductImageController::class,'destroy'])->name('product_images.delete');
        Route::get('categories-list',[CategoryController::class,'categoryList'])->name('categories-list');
        Route::get('brands-list',[BrandController::class,'brandList'])->name('brands-list');
        Route::resource('brands',BrandController::class);
        Route::post('brand-update',[BrandController::class,'update'])->name('brand-update');
        Route::get('devices-list',[DeviceController::class,'deviceList'])->name('devices-list');
        
        Route::get('technicians-list',[TechnicianController::class,'technicianList'])->name('technicians-list');
        Route::get('spares-list',[ProductsController::class,'sparesList'])->name('spares-list');
        Route::post('product-update',[ProductsController::class,'update'])->name('product-update');
        Route::post('update_device',[DeviceController::class,'update'])->name('update_device');
        Route::post('update_profile',[TechnicianController::class,'update'])->name('update_profile');
        Route::post('update_password',[TechnicianController::class,'changePassword'])->name('update_password');
        Route::get('profile',function(){
                 return view('admin.dashboard.profile.edit');
              })->name('profile');
        Route::get('change_password',function(){
            return view('admin.dashboard.profile.change_password');
            })->name('change_password');

    });    
});
