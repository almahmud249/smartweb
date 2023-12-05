<?php

use App\Http\Controllers\BulkImportController;
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

Route::get('/', [BulkImportController::class, 'home'])->name('dashboard');
Route::get('admin', [BulkImportController::class, 'dashboard'])->name('dashboard');
Route::post('city-bulk-import', [BulkImportController::class, 'bulkImport'])->name('city.bulk.import');
Route::get('city-index', [BulkImportController::class, 'cityIndex'])->name('city.index');
Route::get('city/details/{id}', [BulkImportController::class, 'cityDetails'])->name('city.details');
Route::get('city', [BulkImportController::class, 'city'])->name('city');

