<?php

use App\Http\Controllers\Customer\api\AuthController;
use App\Http\Controllers\Customer\api\CatController;
use App\Http\Controllers\Customer\api\ChartController;
use App\Http\Controllers\Customer\api\HeavyEquipmentsController;
use App\Http\Controllers\Customer\api\IndChartController;
use App\Http\Controllers\Customer\api\IndOrderController;
use App\Http\Controllers\Customer\api\IndProductController;
use App\Http\Controllers\Customer\api\IndWishlistController;
use App\Http\Controllers\Customer\api\OrderController;
use App\Http\Controllers\Customer\api\ProductController;
use App\Http\Controllers\Customer\api\ServiceController;
use App\Http\Controllers\Customer\api\TrainingController;
use App\Http\Controllers\Customer\api\WishlistController;
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
Route::post('auth/login',[AuthController::class,'userLogin']);
Route::post('auth/register',[AuthController::class,'register']);
Route::post('auth/complete/file',[AuthController::class,'completeRegister']);
Route::post('auth/forget/Password',[AuthController::class,'forgetPassword']);
Route::post('auth/reset/Password',[AuthController::class,'CodeCheck']);
Route::post('auth/edit/profile/data',[AuthController::class,'editProfileData'])->middleware(['jwt.verify']); // new
Route::post('auth/update/profile',[AuthController::class,'updateProfile'])->middleware(['jwt.verify']);  //new
Route::post('category',[CatController::class,'cats']);
Route::post('products',[ProductController::class,'product']);
Route::post('slider',[ProductController::class,'slider']);
Route::post('products/show/file',[ProductController::class,'showfile']);
Route::post('wishlist/add',[WishlistController::class,'add'])->middleware(['jwt.verify']);
Route::post('wishlist/delete',[WishlistController::class,'delete'])->middleware(['jwt.verify']);
Route::post('wishlist',[WishlistController::class,'wishlist'])->middleware(['jwt.verify']);
Route::post('chart',[ChartController::class,'index'])->middleware(['jwt.verify']);
Route::post('chart/add',[ChartController::class,'add'])->middleware(['jwt.verify']);
Route::post('chart/delete',[ChartController::class,'delete'])->middleware(['jwt.verify']);
Route::post('chart/update',[ChartController::class,'update'])->middleware('jwt.verify');
Route::post('orders',[OrderController::class,'allOrder'])->middleware('jwt.verify');
Route::Post('order/add',[OrderController::class,'index'])->middleware('jwt.verify');
Route::Post('order/payment',[OrderController::class,'payment'])->middleware('jwt.verify');
Route::Post('order/refuse',[OrderController::class,'refuse_price'])->middleware('jwt.verify');
Route::Post('order/accept',[OrderController::class,'accept_price'])->middleware('jwt.verify');
Route::middleware('jwt.verify')->controller(ServiceController::class)->prefix('service')->group(function (){
    Route::post('/','index');
    Route::post('/price/list','priceList');
    Route::post('/request','request');
    Route::post('/request/manpower','requestmanpower');
    Route::post('/delete','delete');
    Route::post('manpower/rate','rate');
    Route::post('/start','start'); //new
    Route::post('/terminate','completemanpower'); //new
    Route::post('/rate','rate'); //new
    Route::post('/complete','complete'); //new
    Route::post('price/list/accept','priceListAccept');
    Route::post('/absence','absence');
    Route::post('/reject/pricelist','rejectpricelist');
});
Route::controller(TrainingController::class)->middleware('jwt.verify')->prefix('/training')->group(function (){
    Route::post('/','index');
    Route::post('/request','request');
    Route::post('/requested','trainingRequested');

}); // new

Route::controller(HeavyEquipmentsController::class)->middleware('jwt.verify')->prefix('/heavy/equipments')->group(function (){
    Route::post('/','orders');
    Route::post('/request','order_request');
    Route::post('/request/delete','delete');
    Route::post('/request/accept','acceptPrice');
    Route::post('/request/refuse','refusePrice');
});

Route::post('industrial/products',[IndProductController::class,'product']);
Route::post('industrial/wishlist/add',[IndWishlistController::class,'add'])->middleware(['jwt.verify']);
Route::post('industrial/wishlist/delete',[IndWishlistController::class,'delete'])->middleware(['jwt.verify']);
Route::post('industrial/wishlist',[IndWishlistController::class,'wishlist'])->middleware(['jwt.verify']);
Route::post('industrial/chart',[IndChartController::class,'index'])->middleware(['jwt.verify']);
Route::post('industrial/chart/add',[IndChartController::class,'add'])->middleware(['jwt.verify']);
Route::post('industrial/chart/delete',[IndChartController::class,'delete'])->middleware(['jwt.verify']);
Route::post('industrial/chart/update',[IndChartController::class,'update'])->middleware('jwt.verify');
Route::post('industrial/orders',[IndOrderController::class,'allOrder'])->middleware('jwt.verify');
Route::Post('industrial/order/add',[IndOrderController::class,'index'])->middleware('jwt.verify');
Route::Post('industrial/order/payment',[IndOrderController::class,'payment'])->middleware('jwt.verify');
Route::Post('industrial/order/refuse',[IndOrderController::class,'refuse_price'])->middleware('jwt.verify');
Route::Post('industrial/order/accept',[IndOrderController::class,'accept_price'])->middleware('jwt.verify');

Route::prefix('tender')->group(function(){
    Route::prefix('chemical')->controller(OrderController::class)->group(function(){
        Route::get('/','tenders');
        Route::post('request','tender_request');
        Route::post('delete','tender_delete');
    });
    Route::prefix('industrial')->controller(IndOrderController::class)->group(function(){
        Route::get('/','tenders');
        Route::post('request','tender_request');
        Route::post('delete','tender_delete');
    });
});
