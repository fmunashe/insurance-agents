<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InsuredController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StockReceivingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/users', UserController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/currency', CurrencyController::class);
    Route::resource('/customers', CustomerController::class);
    Route::resource('/productCategories', ProductCategoryController::class);
    Route::get("/receipt/{sale}/download", [SaleController::class, 'download'])->name('downloadReceipt');
    Route::resource('/sales', SaleController::class);
    Route::get("/orderNote/{order}/download", [OrderController::class, 'download'])->name('downloadOrder');
    Route::resource('/orders', OrderController::class);
    Route::resource('/stockReceiving', StockReceivingController::class);

    Route::get("/reports/sales", [ReportsController::class, 'index'])->name('salesReport');
    Route::post("/reports/generate/sales", [ReportsController::class, 'generateSalesReport'])->name(
        'generateSalesReport'
    );

    Route::get('/suppliers/export', [SupplierController::class, 'report'])->name('suppliers.report');
    Route::resource('/suppliers', SupplierController::class);

    Route::resource('clients', ClientController::class);
    Route::resource('insurance', InsuredController::class);
    Route::resource('commissions', CommissionController::class);

});

require __DIR__ . '/auth.php';
