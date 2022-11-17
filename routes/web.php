<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Auth\LoginController as Login;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseAssignmentController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChargesController;
use App\Http\Controllers\MpesaController;

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


Route::get('/',function(){
    return view('mbele.pages.home');
});



Route::get('contact',function(){
    return view('mbele.pages.contact');
});



Route::get('appointment',function(){
    return view('mbele.pages.appointment');
});

Route::get('reviews',function(){
    return view('mbele.pages.reviews');
});
//User Guard
Route::group(['prefix' => 'user'],function(){
    Route::get('login', [Login::class,'showLoginForm'])->name('user.login');
    Route::post('login', [Login::class,'login'])->name('user.login.post');
    Route::post('logout', [Login::class,'logout'])->name('user.logout');
    Route::group(['middleware' => ['auth:user']],function()
    {
        // MPESA END POINTS
Route::post('v1/access/token',[MpesaController::class,'generateAccessToken'])->name('v1/access/token');
Route::post('v1/token/stk/push',[MpesaController::class,'stkPushRequest'])->name('v1/token/stk/push');
Route::post('v1/hlab/validation',[MpesaController::class,'mpesaValidation'])->name('v1/hlab/validation');
Route::post('sendback/response/{id}/{order_no}',[MpesaController::class,'mpesaConfirmation'])->name('sendback/response');
Route::post('callback/wallet/{id}',[MpesaController::class,'mpesaConfirmationWallet'])->name('callback/wallet');

        Route::get('/',function(){
            return view('mbele.pages.appointment');
        })->name('user.dashboard');
        Route::get('user-services-list',[ServiceController::class,'serviceList'])->name('user-services-list');
        Route::get('client-bookings',[BookingController::class,'clientBookings'])->name('client-bookings');
        Route::get('client-checkins',[WarehouseAssignmentController::class,'clientCheckIns'])->name('client-checkins');
        Route::post('client-payment',[PaymentController::class,'clientPayment'])->name('client-payment');
        Route::get('client-payment-list',[PaymentController::class,'clientPaymentList'])->name('client-payment-list');

    });
});


//Register User
Route::resource('register',RegisterController::class);
Route::resource('bookings',BookingController::class);
Route::resource('charges',ChargesController::class);
Route::resource('warehouse-assignment',WarehouseAssignmentController::class);
Route::get('user-items',[ItemController::class,'itemsList'])->name('user-items');
Route::get('warehouse-list',[WarehouseController::class,'warehousesList'])->name('warehouse-list');
Route::get('charges-list',[ChargesController::class,'chargesList'])->name('charges-list');

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
        Route::post('update_item',[ItemController::class,'update'])->name('update_items');
        Route::delete('items/{id}',[ItemController::class,'destroy']);
        Route::resource('warehouses',WarehouseController::class);
        Route::resource('clients',ClientController::class);
        Route::resource('banners',BannerController::class);
        Route::get('users-list',[ClientController::class,'clientList'])->name('users-list');
        Route::resource('services',ServiceController::class);
        Route::resource('items',ItemController::class);
        Route::resource('technicians',TechnicianController::class);
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
