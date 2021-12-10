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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Route::resource('/products', ProductController::class);

Route::get('/products', [ProductController::class,'index'])->name('products')->middleware('auth');
Route::get('/products/list', [ProductController::class,'productList'])->name('list.products')->middleware('auth');
Route::post('/products', [ProductController::class,'store'])->name('products.store');
Route::put('/products', [ProductController::class,'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class,'destroy'])->name('products.destroy');

Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases');
Route::resource('/purchases', PurchaseController::class);

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices');
Route::get('/invoices/{invoicesId}', [InvoiceController::class, 'show'])->name('invoices.show');

Route::get('/invoices/generate', [InvoiceController::class, 'generateInvoices'])->name('invoices.generate');
Route::get('/invoices/{userId}', [InvoiceController::class, 'show'])->name('invoices.show');
// Route::resource('/invoices', InvoiceController::class);

require __DIR__.'/auth.php';
