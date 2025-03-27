<?php

use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ViewController::class, 'viewHomepage'])->name('viewHomepage');

// Auth pages
Route::middleware('guest')->group(function () {
  Route::get('/login', [ViewController::class, 'viewLoginPage'])->name('viewLoginPage');
  Route::get('/register', [ViewController::class, 'viewRegisterPage'])->name('viewRegisterPage');
});

// User pages
Route::get('/catalog', [ViewController::class, 'viewDashboardPage'])->name('viewDashboardPage');
Route::get('/cart', [ViewController::class, 'viewCartPage'])->name('viewCartPage');

// Admin pages
Route::get('/dashboard', [ViewController::class, 'viewDashboardPage'])->name('viewDashboardPage');
Route::get('/insert-product', [ViewController::class, 'viewInsertProductPage'])->name('viewInsertProductPage');
Route::get('/edit-product', [ViewController::class, 'viewEditProductPage'])->name('viewEditProductPage');
