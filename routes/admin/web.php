<?php

use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\CompleteOrderController;
use App\Http\Controllers\Admin\HeavyEquipmentsController;
use App\Http\Controllers\Admin\IndAdminProductController;
use App\Http\Controllers\Admin\IndustrialController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\NotificationController;
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

Route::get('/login',[LoginController::class,'showLogin'])->name('admin.show.login');
Route::post('/auth/login',[LoginController::class,'login'])->name('admin.login');
Route::middleware('auth:admin')->group(function (){
    Route::get('/',[PermissionController::class,'allbuy'])->name('admin.buy.all');
    Route::get('/seller/products',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/customer/products',[AdminController::class,'index2'])->name('admin.customer.products');
    Route::get('/database/products',[AdminController::class,'index3'])->name('admin.database.products');
    Route::get('/sub/category/{id}',[AdminController::class,'subCat'])->name('admin.sub.cat');
    Route::get('sub/sub/category/{id}',[AdminController::class,'subsubCat'])->name('admin.sub.sub.cat');
    Route::get('/products/{id}',[AdminController::class,'products'])->name('admin.products');
    Route::get('/products/delete',[ProductController::class,'delete'])->name('admin.product.delete');
    Route::get('/product/{id}',[ProductController::class,'show'])->name('admin.product.show');
    Route::prefix('/permission')->group(function (){
        Route::get('/register',[PermissionController::class,'register'])->name('admin.permission.register');
        Route::get('/register/supplier',[PermissionController::class,'seller'])->name('admin.seller');
        Route::get('/register/customer',[PermissionController::class,'customer'])->name('admin.customer');
        Route::get('register/supplier/details/{id}',[PermissionController::class,'registerSellerDetails'])->name('admin.permission.register.seller.details');
        Route::get('register/customer/details/{id}',[PermissionController::class,'registerCustomerDetails'])->name('admin.permission.register.customer.details');
        Route::get('register/file/seller/{type}/{filename}/{name}',[PermissionController::class,'registerSellerFile'])->name('seller.file');
        Route::get('register/file/customer/{type}/{filename}/{name}',[PermissionController::class,'registerCustomerFile'])->name('customer.file');
        Route::post('/register/accept',[PermissionController::class,'sellerAccept'])->name('admin.seller.accept');
        Route::post('/register/decline',[PermissionController::class,'sellerDecline'])->name('admin.seller.decline');
        Route::get('register/accept/seller/file/{userid}/{code}',[PermissionController::class,'approve_registration_seller_file'])->name('admin.seller.accept.file');
        Route::get('register/accept/customer/file/{userid}/{code}',[PermissionController::class,'approve_registration_customer_file'])->name('admin.customer.accept.file');
        Route::post('register/refuse/seller/file/',[PermissionController::class,'refuse_registration_seller_file'])->name('admin.seller.refuse.file');
        Route::post('register/refuse/customer/file/',[PermissionController::class,'refuse_registration_customer_file'])->name('admin.customer.refuse.file');

        Route::get('/product',[PermissionController::class,'product'])->name('admin.permission.product');
        Route::get('product/details/{id}',[PermissionController::class,'productDetails'])->name('admin.permission.product.details');
        Route::get('product/file/{type}/{filename}',[PermissionController::class,'productFile'])->name('admin.product.file');
        Route::post('/product/accept',[PermissionController::class,'productAccept'])->name('admin.product.accept');
        Route::post('/product/decline',[PermissionController::class,'productDecline'])->name('admin.product.decline');

        Route::get('/buy',[PermissionController::class,'buy'])->name('admin.permission.buy');
        Route::post('/buy/add/price',[PermissionController::class,'addPriceToOrder'])->name('admin.permission.buy.add.price');
        Route::get('buy/details/{id}',[PermissionController::class,'buyDetails'])->name('admin.permission.buy.details');
        Route::get('buy/file/{type}/{filename}/{name}',[PermissionController::class,'buyFile'])->name('admin.buy.file');
        Route::post('/buy/complete',[PermissionController::class,'buyComplete'])->name('admin.buy.complete');
        Route::post('/buy/decline',[PermissionController::class,'buyDecline'])->name('admin.buy.decline');

        Route::get('all/service',[PermissionController::class,'allservice'])->name('admin.permission.all.service');
        Route::get('service/categories/',[PermissionController::class,'catservice'])->name('admin.permission.cat.service');
        Route::get('service/categories/manpower/',[PermissionController::class,'catsmanpower'])->name('admin.permission.cat.manpower');
        Route::get('service/sub/categories/{type}/{id}',[PermissionController::class,'subcatservice'])->name('admin.permission.sub_cat.service');
        Route::get('/service/{type}/{id}',[PermissionController::class,'service'])->name('admin.permission.service');
        Route::get('service/details/{type}/{id}',[PermissionController::class,'serviceDetails'])->name('admin.permission.service.details');
        Route::get('service/price/{type}/{id}',[PermissionController::class,'servicePrice'])->name('admin.permission.service.price');
        Route::get('service/file/{type}/{filename}',[PermissionController::class,'serviceFile'])->name('admin.service.file');
        Route::post('/service/accept',[PermissionController::class,'serviceAccept'])->name('admin.service.accept');
        Route::post('service/update',[PermissionController::class,'serviceUpdate'])->name('admin.service.update');
        Route::post('/service/price/delete',[PermissionController::class,'priceDelete'])->name('admin.price.delete');
        Route::post('/service/decline',[PermissionController::class,'serviceDecline'])->name('admin.service.decline');
        Route::post('/service/price/accept',[PermissionController::class,'priceAccept'])->name('admin.price.accept');
        Route::post('/service/price/upload',[PermissionController::class,'priceUpload'])->name('admin.price.upload');

        Route::get('/sub/cat',[PermissionController::class,'sub_cat'])->name('admin.permission.sub.cat');
        Route::get('/sub/cat/status/change/{id}',[PermissionController::class,'sub_cat_status_inverse'])->name('admin.permission.sub.cat.status.inverse');

        Route::get('/main/product',[PermissionController::class,'allProduct'])->name('admin.permission.all.product');
        Route::get('/main/product/status/change/{id}',[PermissionController::class,'allProduct_status_inverse'])->name('admin.permission.all.product.status.inverse');
    });
    Route::prefix('/users')->controller(UsersController::class)->group(function(){
        Route::get('/','index')->name('admin.users');
        Route::get('/suppliers','seller')->name('admin.users.sellers');
        Route::get('/supplier/details/{id}','sellerDetails')->name('admin.users.seller.details');
        Route::post('supplier/delete/','deleteSeller')->name('admin.user.seller.block');
        Route::get('/customer','customer')->name('admin.users.customer');
        Route::get('/customer/details/{id}','customerDetails')->name('admin.users.customer.details');
        Route::post('customer/delete/','deleteCustomer')->name('admin.user.customer.block');
    });
    Route::prefix('/profile')->controller(ProfileController::class)->group(function (){
        Route::post('logout','logout')->name('admin.logout');
        Route::get('/','index')->name('admin.profile');
        Route::get('/setting/show','settingShow')->name('admin.setting.show');
        Route::post('/setting','setting')->name('admin.setting');
        Route::get('file/{filename}','file')->name('admin.file');

    });
    Route::prefix('/training')->group(function (){
        Route::get('/all',[TrainingController::class,'trainings'])->name('admin.training.all');
        Route::get('/requests',[TrainingController::class,'training_request'])->name('admin.training.request');
        Route::get('/',[AdminController::class,'training'])->name('admin.training');
        Route::post('/create/group',[TrainingController::class,'createGroup'])->name('admin.training.create.group');
        Route::post('/update/group',[TrainingController::class,'edit'])->name('admin.training.update.group');
        Route::post('/delete/group',[TrainingController::class,'delete'])->name('admin.training.delete.group');
    });
    Route::controller(AdminProductController::class)->prefix('admin/product')->group(function (){
        Route::get('/','index')->name('admin.admin.product');
        Route::get('/show/{id}','show')->name('admin.show.admin.product');
        Route::post('/create','create')->name('admin.create.admin.product');
        Route::post('/update','update')->name('admin.update.admin.product');
        Route::post('/delete','delete')->name('admin.delete.admin.product');
        Route::post('submit/order','order')->name('admin.order.submit.admin.product');
        Route::get('orders','adminOrders')->name('admin.orders.admin.product');
        Route::get('orders/details/{id}','Show_price')->name('admin.show.orders.admin.product');
    });
    Route::get('notification',[NotificationController::class,'admin'])->name('admin.notify');
    Route::get('chat',[ChatController::class,'index'])->name('admin.chat');
    Route::controller(CompleteOrderController::class)->prefix('complete/order')->group(function (){
        Route::get('/','index')->name('admin.complete');
        Route::get('/chemical','ChemicalOrder')->name('admin.complete.chemical');
        Route::get('/chemical/{id}','ChemicalOrderDetails')->name('admin.complete.chemical.details');
        Route::get('/all/Service','allServiceOrder')->name('admin.complete.all.service');
        Route::get('cat/service/{id}','catservice')->name('admin.complete.cat.service');
        Route::get('cat/manpower/','catsmanpower')->name('admin.complete.cat.manpower');
        Route::get('sub/cat/service/{id}','subcatservice')->name('admin.complete.sub.cat.server');
        Route::get('service/{id}','service')->name('admin.complete.service');
        Route::get('service/details/{id}','serviceDetails')->name('admin.complete.service.details');
        Route::get('service/price/{id}','servicePrice')->name('admin.complete.service.price');
        Route::get('trainings','trainings')->name('admin.complete.trainings');
        Route::get('training/request','training_request')->name('admin.complete.training.request');
        Route::get('training/group','training')->name('admin.complete.training');
    });
    Route::prefix('industrial')->group(function (){
        Route::get('/buy',[IndustrialController::class,'index'])->name('admin.industrial.permission.buy');
        Route::post('/buy/add/price',[IndustrialController::class,'addPriceToOrder'])->name('admin.industrial.permission.buy.add.price');
        Route::get('buy/details/{id}',[IndustrialController::class,'buyDetails'])->name('admin.industrial.permission.buy.details');
        Route::get('buy/file/{type}/{filename}/{name}',[IndustrialController::class,'buyFile'])->name('admin.industrial.buy.file');
        Route::post('/buy/complete',[IndustrialController::class,'buyComplete'])->name('admin.industrial.buy.complete');
        Route::post('/buy/decline',[IndustrialController::class,'buyDecline'])->name('admin.industrial.buy.decline');

        Route::get('/product',[IndustrialController::class,'product'])->name('admin.industrial.permission.product');
        Route::get('product/details/{id}',[IndustrialController::class,'productDetails'])->name('admin.industrial.permission.product.details');
        Route::post('/product/accept',[IndustrialController::class,'productAccept'])->name('admin.industrial.product.accept');
        Route::post('/product/decline',[IndustrialController::class,'productDecline'])->name('admin.industrial.product.decline');

        Route::controller(IndAdminProductController::class)->prefix('admin/product')->group(function (){
            Route::get('/','index')->name('admin.industrial.admin.product');
            Route::get('/show/{id}','show')->name('admin.industrial.show.admin.product');
            Route::post('/create','create')->name('admin.industrial.create.admin.product');
            Route::post('/update','update')->name('admin.industrial.update.admin.product');
            Route::post('/delete','delete')->name('admin.industrial.delete.admin.product');
            Route::post('submit/order','order')->name('admin.industrial.order.submit.admin.product');
        });
        Route::get('/main/product',[IndustrialController::class,'allProduct'])->name('admin.industrial.permission.all.product');
        Route::get('/main/product/status/change/{id}',[IndustrialController::class,'allProduct_status_inverse'])->name('admin.industrial.permission.all.product.status.inverse');

    });
    Route::prefix('/equipments')->group(function (){
        Route::get('/',[HeavyEquipmentsController::class,'all'])->name('admin.equipment.orders');
        Route::get('/cat/{id}',[HeavyEquipmentsController::class,'index'])->name('admin.equipment.orders.cat');
        Route::get('/details/{id}',[HeavyEquipmentsController::class,'orderdetails'])->name('admin.equipment.order.details');
        Route::post('/accept',[HeavyEquipmentsController::class,'accept'])->name('admin.equipment.order.accept');
        Route::post('/add/price',[HeavyEquipmentsController::class,'add_price'])->name('admin.equipment.order.add.price');
    });
    Route::controller(TenderController::class)->prefix('tender')->group(function(){
        Route::get('chemical','chemical')->name('admin.tender.chemical');
        Route::get('chemical/details/{id}','chemical_details')->name('admin.tender.chemical.details');
        Route::post('chemical/accept','chemical_accept')->name('admin.tender.chemical.accept');
        Route::post('chemical/price/accept','chemical_price_accept')->name('admin.tender.chemical.price.accept');
        Route::post('chemical/status','chemical_status')->name('admin.tender.chemical.status');

        Route::get('industrial','industrial')->name('admin.tender.industrial');
        Route::get('industrial/details/{id}','industrial_details')->name('admin.tender.industrial.details');
        Route::post('industrial/accept','industrial_accept')->name('admin.tender.industrial.accept');
        Route::post('industrial/price/accept','industrial_price_accept')->name('admin.tender.industrial.price.accept');
        Route::post('industrial/status','industrial_status')->name('admin.tender.industrial.status');
    });
    Route::get('chemical/type',[TenderController::class,'chemical_type'])->name('admin.order.chemical.type');
    Route::get('industrial/type',[TenderController::class,'industrial_type'])->name('admin.order.industrial.type');
});
