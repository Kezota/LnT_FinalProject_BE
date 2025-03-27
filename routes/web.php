<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'viewHomepage'])->name('viewHomepage');

// Auth pages
Route::middleware('guest')->group(
  function () {
    Route::get('/login', [ViewController::class, 'viewLoginPage'])->name('viewLoginPage');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [ViewController::class, 'viewRegisterPage'])->name('viewRegisterPage');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
  }
);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User pages
Route::prefix('user')->middleware(['auth:user', 'role:user'])->group(function () {
  Route::get('/catalog', [ViewController::class, 'viewCatalogPage'])->name('user.catalog');
  Route::get('/cart', [ViewController::class, 'viewCartPage'])->name('user.cart');
});

// Admin pages
Route::prefix('admin')->middleware(['auth:admin', 'role:admin'])->group(function () {
  Route::get('/dashboard', [ViewController::class, 'viewDashboardPage'])->name('admin.dashboard');
  Route::get('/add-product', [ViewController::class, 'viewAddProductPage'])->name('admin.addProduct');
  Route::get('/edit-product', [ViewController::class, 'viewEditProductPage'])->name('admin.editProduct');
});
