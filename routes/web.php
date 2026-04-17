<?php

use App\Http\Controllers\PosController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::redirect('/', '/pos');

    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/store', [PosController::class, 'store'])->name('pos.store');
    Route::get('/pos/invoice/{transaction}', [PosController::class, 'invoice'])->name('pos.invoice');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/master-data', [InventoryController::class, 'hub'])->name('master.hub');
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::put('/shop', [ShopController::class, 'update'])->name('shop.update');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
});
