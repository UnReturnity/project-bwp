<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// --- PAGES (Views) ---
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

// --- LOGIC (Actions) ---
// This is the missing line causing your error:
Route::post('/register', [AuthController::class, 'registerUser'])->name('register.submit');

Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
