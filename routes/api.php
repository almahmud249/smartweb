<?php

use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\OrderController;
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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class,'login'])->name('login');
});
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('index/{tab}', [OrderController::class,'index'])->name('index');
    Route::get('all-products-with-orders', [OrderController::class,'allProductsWithOrders'])->name('allProductsWithOrders');
    Route::get('product-list', [OrderController::class,'productList'])->name('productList');
    Route::get('my-shop', [OrderController::class,'myShop'])->name('myShop');
    Route::post('update-shop', [OrderController::class,'updateShop'])->name('updateShop');


   Route::post('logout', [LoginController::class,'logout'])->name('logout');
});
