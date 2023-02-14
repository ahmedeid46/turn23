<?php

use App\Http\Controllers\Customer\api\CatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\ServiceController;
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
Route::get('product/files/{type}/{filename}', [ProductController::class,'file'])->name('product.files');
Route::get('api/product/img/{type}/{filename}', [ProductController::class,'img'])->name('product.imgs');
Route::get('service/files/{type}/{filename}', [ServiceController::class,'file'])->name('service.files');
Route::get('order/files/{type}/{filename}', [\App\Http\Controllers\Customer\api\OrderController::class,'file'])->name('order.file');
Route::get('/price/list/format',[ServiceController::class,'priceListFormat']);
Route::get('category/img/{filename}',[CatController::class,'file'])->name('category.img');
Route::get('seller/avtar/{filename}',[\App\Http\Controllers\seller\api\ProfileController::class,'avtar'])->name('seller.avtar');
Route::get('seller/file/{folder}/{filename}',[\App\Http\Controllers\seller\api\ProfileController::class,'file'])->name('seller.file.only');
Route::get('customer/avtar/{filename}',[\App\Http\Controllers\Customer\api\ProfileController::class,'avtar'])->name('customer.avtar');

Route::get('newsletter',[NewsLetterController::class,'index']);
Route::post('store-newsletter',[NewsLetterController::class,'create']);

Route::patch('/fcm-token', [\App\Http\Controllers\WebNotificationController::class, 'updateToken'])->name('fcmToken');
