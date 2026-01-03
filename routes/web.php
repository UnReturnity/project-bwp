<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\TransactionController;


Route::get('/', [ProductController::class, 'index'])->name('home');

// --- AUTH PAGES (Views) ---
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

// --- AUTH LOGIC (Actions) ---
Route::post('/register', [AuthController::class, 'registerUser'])->name('register.submit');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- SHOP & CART LOGIC ---
// (Optional) You can keep /products if you want, but "/" does the same thing now.
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');


Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/checkout', [TransactionController::class, 'checkout'])->name('checkout');
Route::get('/history', [TransactionController::class, 'index'])->name('history.index');
