<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {


    // rutas de productos
    Route::prefix('admin/')->group(function () {

        // Route::resource('/products', ProductController::class)->except([
        //     'create', 'show'
        // ]);

        Route::get('/products/table', [ProductController::class, 'productsTable'])
            ->name('products.table');

        Route::get('/products', [ProductController::class, 'index'])->name('products.index')
            ->middleware('role:ADMIN');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        Route::delete('/products/{id}', [ProductController::class, 'destroy'])
            ->name('products.destroy');

        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{id}', [ProductController::class, 'update'])
            ->name('products.update');

        // rutas de facturas
        Route::get('/invoices', [InvoiceController::class, 'index'])
            ->name('invoices');

        Route::get('/invoices/table', [InvoiceController::class, 'invoiceTable'])
            ->name('invoices.table');

        Route::post('/invoices/generate', [InvoiceController::class, 'generateInvoices'])
            ->name('invoices.generate');

        Route::get('/invoices/{invoicesId}', [InvoiceController::class, 'show'])
            ->name('invoices.show');
    });

    // rutas para el cliente
    Route::middleware('role:CLIENT')->group(function () {

        // productos
        Route::get('/products/list', [ProductController::class, 'productList'])
            ->name('list.products');

        // rutas de compras
        Route::get('/purchases', [PurchaseController::class, 'index'])
            ->name('purchases');

        Route::post('/purchases', [PurchaseController::class, 'store'])
            ->name('purchases.store');
    });
});

require __DIR__ . '/auth.php';
