<?php

use App\Http\Controllers\seller\api\IndCatController;
use App\Http\Controllers\seller\api\IndOrderController;
use App\Http\Controllers\seller\api\IndProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\seller\api\CatController;
use App\Http\Controllers\seller\api\AuthController;
use App\Http\Controllers\seller\api\OrderController;
use App\Http\Controllers\seller\api\ProductController;
use App\Http\Controllers\seller\api\ServiceController;
use App\Http\Controllers\seller\api\TrainingController;
use App\Http\Controllers\seller\api\HeavyEquipmentsController;

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

Route::post('auth/login',[AuthController::class,'userLogin']);
Route::post('auth/register',[AuthController::class,'register']);
Route::post('auth/complete/file',[AuthController::class,'completeRegister']);
Route::post('auth/forget/Password',[AuthController::class,'forgetPassword']);
Route::post('auth/reset/Password',[AuthController::class,'CodeCheck']);
Route::post("auth/register/category",[AuthController::class,'getCategory']);
Route::post('auth/edit/profile/data',[AuthController::class,'editProfileData'])->middleware(['jwt.verify']);
Route::post('auth/update/profile',[AuthController::class,'updateProfile'])->middleware(['jwt.verify']);
Route::post('categories',[CatController::class,'cats'])->middleware(['jwt.verify']);
Route::post('add/MainCat',[CatController::class,'addMainCat'])->middleware(['jwt.verify']);
Route::post('/add/seller/all/sub/cats',[CatController::class,'addSellerallSubCat'])->middleware('jwt.verify');
Route::post('/delete/seller/sub/cat',[CatController::class,'deleteSellerSubCat'])->middleware('jwt.verify');
Route::post('/add/seller/sub/cat',[CatController::class,'addSellerSubCat'])->middleware('jwt.verify');
Route::post('category',[CatController::class,'index'])->middleware('jwt.verify');
Route::post('all/product',[CatController::class,'allProductbyCat'])->middleware('jwt.verify');
Route::get('product',[ProductController::class,'index'])->middleware('jwt.verify');
Route::post('add/product',[ProductController::class,'add'])->middleware('jwt.verify');
Route::post('edit/product',[ProductController::class,'edit'])->middleware('jwt.verify');
Route::post('delete/product',[ProductController::class,'delete'])->middleware('jwt.verify');
Route::post('order',[OrderController::class,'index'])->middleware('jwt.verify');
Route::post('add/price/order',[OrderController::class,'addPriceOrder'])->middleware('jwt.verify');
Route::prefix('service')->middleware('jwt.verify')->controller(ServiceController::class)->group(function (){
    Route::post('/','index');
    Route::post('/manpower','manpower');
    Route::post('/price/list/add','service_price_list_add');
    Route::post('/complete','service_complete');
});
Route::post('/training',[TrainingController::class,'index'])->middleware('jwt.verify');
Route::post('/training/status',[TrainingController::class,'trainingStatus'])->middleware('jwt.verify');

Route::controller(HeavyEquipmentsController::class)
    ->middleware('jwt.verify')->prefix('heavy/equipments')->group(function(){
        Route::get('/','Orders');
        Route::post('/price','price');
    });
Route::prefix('industrial')->middleware('jwt.verify')->group(function(){
    Route::post('category',[IndCatController::class,'index'])->middleware('jwt.verify');
    Route::post('all/product',[IndCatController::class,'allProductbyCat'])->middleware('jwt.verify');
    Route::get('product',[IndProductController::class,'index'])->middleware('jwt.verify');
    Route::post('add/product',[IndProductController::class,'add'])->middleware('jwt.verify');
    Route::post('edit/product',[IndProductController::class,'edit'])->middleware('jwt.verify');
    Route::post('delete/product',[IndProductController::class,'delete'])->middleware('jwt.verify');
    Route::post('order',[IndOrderController::class,'index'])->middleware('jwt.verify');
    Route::post('add/price/order',[IndOrderController::class,'addPriceOrder'])->middleware('jwt.verify');
});
Route::prefix('tender')->group(function(){
    Route::prefix('chemical')->controller(OrderController::class)->group(function(){
        Route::get('/','tender');
        Route::post('add/price','tenderPrice');
    });
    Route::prefix('industrial')->controller(IndOrderController::class)->group(function(){
        Route::get('/','tender');
        Route::post('add/price','tenderPrice');
    });
});

