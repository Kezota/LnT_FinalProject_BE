<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'viewHomepage'])->name('viewHomepage');

// Auth pages
Route::middleware('guest')->group(
  function () {
    Route::get('login', [ViewController::class, 'viewLoginPage'])->name('viewLoginPage');
    Route::get('register', [ViewController::class, 'viewRegisterPage'])->name('viewRegisterPage');

    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
  }
);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// User pages
Route::prefix('user')->middleware(['auth:user', 'role:user'])->group(function () {
  Route::get('catalog', [ViewController::class, 'viewCatalogPage'])->name('user.catalog');
  Route::get('cart', [ViewController::class, 'viewCartPage'])->name('user.cart');
});

// Admin pages
// Route::prefix('admin')->middleware(['auth:admin', 'role:admin'])->group(function () {
Route::prefix('admin')->group(function () {
  Route::get('dashboard', [BarangController::class, 'dashboard'])->name('admin.dashboard');
  Route::get('add-product', [BarangController::class, 'addProduct'])->name('admin.addProduct');
  Route::get('edit-product/{id}', [BarangController::class, 'editProduct'])->name('admin.editProduct');

  Route::post('store-product', [BarangController::class, 'storeProduct']);
  Route::post('update-product/{id}', [BarangController::class, 'updateProduct']);
  Route::delete('delete-product/{id}', [BarangController::class, 'deleteProduct']);
});
