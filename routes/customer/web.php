<?php

use App\Http\Controllers\ChartsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Customer\auth\LoginController;
use App\Http\Controllers\Customer\auth\LogoutController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\WishlistController;
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
// Navbar Route
Route::controller(CustomerController::class)->group(function (){
    Route::get('/','home')->name('customer.home');
    Route::get('/about','about')->name('customer.about');
    //Route::get('/chart','chart')->name('customer.chart');
    Route::get('/categories/{id}','categories')->name('customer.categories');
    Route::get('sub/categories/{id}','subcategories')->name('customer.sub.categories');
    Route::get('/products/{id}','products')->name('customer.products');
    Route::get('/product/show/{id}','product')->name('customer.product.show');
    Route::get('/about','about')->name('customer.about');
    Route::get('/services/{id}','service')->middleware('auth:customer')->name('customer.service');
    Route::get('industrial','industrial')->name('customer.industrial');
    Route::get('contact','contact')->name('customer.contact');
    Route::get('profile','profile')->middleware('auth:customer')->name('customer.profile');

});
Route::get('/training',[TrainingController::class,'index'])->name('customer.training');
Route::prefix('/training')->middleware('auth:customer')->controller(TrainingController::class)->group(function (){
    Route::post('/request','request')->name('customer.training.request');
    Route::get('/Track','track')->name('customer.training.track');
});
Route::prefix('wishlist')->controller(WishlistController::class)->middleware('auth:customer')->group(function (){
    Route::get('/','index')->name('customer.wishlist');
    Route::post('add','store')->name('customer.wishlist.add');
    Route::post('delete','destory')->name('customer.wishlist.delete');

});
Route::prefix('cart')->controller(ChartsController::class)->middleware('auth:customer')->group(function (){
    Route::get('/','index')->name('customer.chart');
    Route::post('add/one','storeone')->name('customer.chart.add.one');
    Route::post('add','store')->name('customer.chart.add');
    Route::get('delete/{chart}','destroy')->name('customer.chart.delete');
    Route::post('update','update')->name('customer.chart.update.count');
});
Route::prefix('service')->controller(ServiceController::class)->group(function (){
    Route::post('/add','store')->name('customer.service.add');
    Route::post('/rate','rateService')->name('customer.service.rate');
    Route::post('/start','start')->name('customer.service.start');
    Route::post('/complete','complete')->name('customer.service.complete');
    Route::post('/update','update')->name('customer.service.update');
    Route::post('/select/price/list','priceListSelection')->name('customer.service.select.price.list');


});
Route::prefix('order')->controller(OrderController::class)->middleware('auth:customer')->group(function (){
    Route::get('/','show')->name('customer.order.show');
    Route::post('add','add')->name('customer.order.add');
    Route::get('pay/{id}','payment')->name('customer.order.pay');
    Route::get('checkout','checkout')->name('customer.order.checkout');
});


Route::post('store/contact',[ContactController::class,'store'])->name('customer.store.contact');
Route::prefix('auth')->middleware('guest:customer')->group(function (){
    Route::get('/register',[RegisterController::class,'showRegister'])->name('customer.show.register');
    Route::post('/signup',[RegisterController::class,'register'])->name('customer.register');
    Route::get('login',[LoginController::class,'showLogin'])->name('customer.show.login');
    Route::post('login',[LoginController::class,'login'])->name('customer.login');
});
Route::post('auth/logout',[LogoutController::class,'logout'])->name('customer.logout');

Route::view('/notify','notify')->name('notify');
Route::post('send/notify',[NewsLetterController::class,'notification'])->name('send.notify');
//Route::post('fcmToken',[NewsLetterController::class,'updateToken'])->name('fcmToken');
