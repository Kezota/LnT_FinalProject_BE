<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'viewHomepage'])->name('viewHomepage');

// Auth pages
Route::middleware('guest')->group(
  function () {
    Route::get('login', [ViewController::class, 'viewLoginPage'])->name('viewLoginPage');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('register', [ViewController::class, 'viewRegisterPage'])->name('viewRegisterPage');
    Route::post('register', [AuthController::class, 'register'])->name('register');
  }
);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// User pages
Route::prefix('user')->middleware(['auth:user', 'role:user'])->group(function () {
  Route::get('catalog', [CatalogController::class, 'viewCatalogPage'])->name('user.catalog');
  Route::get('history', [InvoiceController::class, 'viewHistoryPage'])->name('user.history');
  Route::get('checkout', [InvoiceController::class, 'viewCheckoutPage'])->name('user.checkoutProduct');

  Route::get('cart', [CartController::class, 'viewCartPage'])->name('user.cart');
  Route::post('/cart/add', [CartController::class, 'addToCart'])->name('user.addToCart');
  Route::post('/cart/update', [CartController::class, 'updateCart'])->name('user.updateCart');

  Route::get('invoice', [InvoiceController::class, 'viewInvoicePage'])->name('viewInvoicePage');
  Route::get('invoice/{invoiceNumber}', [InvoiceController::class, 'viewInvoice'])->name('user.invoice');
  Route::post('generate-invoice', [InvoiceController::class, 'generateInvoice'])->name('user.generateInvoice');
});

// Admin pages
Route::prefix('admin')->middleware(['auth:admin', 'role:admin'])->group(function () {
  Route::get('dashboard', [BarangController::class, 'dashboard'])->name('admin.dashboard');

  Route::get('add-product', [BarangController::class, 'addProduct'])->name('admin.addProduct');
  Route::post('store-product', [BarangController::class, 'storeProduct']);
  Route::get('edit-product/{id}', [BarangController::class, 'editProduct'])->name('admin.editProduct');
  Route::post('update-product/{id}', [BarangController::class, 'updateProduct']);
  Route::delete('delete-product/{id}', [BarangController::class, 'deleteProduct']);
});
