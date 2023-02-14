<?php

use App\Http\Controllers\seller\ManPowerController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\seller\auth\LoginController;
use App\Http\Controllers\seller\auth\LogoutController;
use App\Http\Controllers\seller\auth\RegisterController;
use App\Http\Controllers\seller\ProductController;
use App\Http\Controllers\seller\TrainingController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\seller\ServiceProviderController;
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
Route::view('category','seller.page.chemical.addcategory');

Route::get('home',[SellerController::class,'home'])->middleware('auth:seller')->name('seller.home');

Route::prefix('training')->middleware(['CIUT','auth:seller'])->group(function (){
    Route::get('/',[TrainingController::class,'index'])->name('seller.trainer');
    Route::get('/request',[TrainingController::class,'request'])->name('seller.trainer.requests');
    Route::post('/accept',[TrainingController::class,'accept'])->name('seller.trainer.accept');
    Route::post('/decline',[TrainingController::class,'decline'])->name('seller.trainer.decline');
});



Route::controller(SellerController::class)->group(function(){
    Route::redirect('/','chemical/dashboard');
    Route::post('/edit/account','edit')->middleware('auth:seller')->name('seller.account.edit');
});
Route::prefix('chemical')->middleware(['CIUC','auth:seller'])->group(function (){
    Route::redirect('/','dashboard');
    Route::get('dashboard',[SellerController::class,'chemical'])->name('seller.chemical');
    Route::post('update/categories',[SellerController::class,'registrationCats'])->name('seller.update.cat');
    Route::get('products/{id}',[ProductController::class,'index'])->name('seller.products');
    Route::post('product/add',[ProductController::class,'add'])->name('seller.add.product');
    Route::post('product/edit/{id}',[ProductController::class,'edit'])->name('seller.edit.product');
    Route::get('product/files/{type}/{filename}', [ProductController::class,'file'])->name('seller.product.files');
    Route::get('product/{id}',[ProductController::class,'show'])->name('seller.product.show');
    Route::post('order/price/submit',[SellerController::class,'order_price'])->name('seller.order.price.add');
});
Route::prefix('man/power')->middleware(['CIUMP','auth:seller'])->group(function (){
    Route::redirect('/','/dashboard');
    Route::get('/dashboard',[SellerController::class,'manpower'])->name('seller.man.power');
    Route::post('update/categories',[SellerController::class,'registrationmanpowerCats'])->name('seller.manpower.update.cat');
    Route::get('requests',[ManPowerController::class,'requests'])->name('seller.man.power.requests');
    Route::get('/description/{id}',[ServiceProviderController::class,'description'])->name('seller.man.power.description');
    Route::post('/service/accept',[ManPowerController::class,'accept'])->name('seller.man.power.accept');
    Route::post('/service/complete',[ManPowerController::class,'complete'])->name('seller.man.power.complete');
});
Route::prefix('service/provider')->middleware(['CIUSP','auth:seller'])->group(function (){
    Route::redirect('/','/dashboard');
    Route::get('/dashboard',[SellerController::class,'services'])->name('seller.service');
    Route::post('update/categories',[SellerController::class,'registrationmanpowerCats'])->name('seller.service.update.cat');
    Route::get('requests',[ServiceProviderController::class,'requests'])->name('seller.service.requests');
    Route::get('/description/{id}',[ServiceProviderController::class,'description'])->name('seller.service.description');
    Route::post('/service/accept',[ServiceProviderController::class,'accept'])->name('seller.service.accept');
    Route::post('/service/complete',[ServiceProviderController::class,'complete'])->name('seller.service.complete');

});

Route::prefix('auth')->middleware('guest:seller')->group(function (){
    Route::get('/register',[RegisterController::class,'showRegister'])->name('seller.show.register');
    Route::post('/signup',[RegisterController::class,'register'])->name('seller.register');
    Route::get('login',[LoginController::class,'showLogin'])->name('seller.show.login');
    Route::post('login',[LoginController::class,'login'])->name('seller.login');
});
Route::post('auth/logout',[LogoutController::class,'logout'])->middleware('auth:seller')->name('seller.logout');



Route::get('newsletter',[NewsLetterController::class,'index']);
Route::post('store-newsletter',[NewsLetterController::class,'create']);
