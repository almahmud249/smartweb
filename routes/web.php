<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
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

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login.create');
});
Route::middleware(['auth.check'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('orders/{tab}', [OrderController::class, 'index'])->name('order.index');
});
