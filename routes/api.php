<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\seller\api\ProductController;
use App\Http\Controllers\seller\api\ServiceController;
use App\Http\Controllers\SubCatController;
use App\Http\Controllers\Admin\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('paymob/payment/verify',[OrderController::class,'paymob_payment_verify']);
Route::post('paymob/payment/response',[OrderController::class,'set_payment_response']);
Route::post('download/service/file',[ServiceController::class,'download_file']);
Route::post('download/product/file',[ProductController::class,'download_file']);

Route::post('search/product/{text}',[SubCatController::class,'searchByProduct']);
Route::post('search/Category/{text}',[SubCatController::class,'SearchByCat']);

Route::get('search/sellers',[SearchController::class,'SearchSeller'])->name('admin.sellers.search');
Route::get('filter/cat/sellers',[SearchController::class,'FilterSeller'])->name('admin.sellers.filter.cat');

Route::get('search/customer',[SearchController::class,'SearchCustomer'])->name('admin.customer.search');
Route::get('location/group/check',[SearchController::class,'locationCheckGroup'])->name('admin.group.location.check');


