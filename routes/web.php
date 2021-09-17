<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;


//check if user is not logged in
Route::middleware('guest')->group(function () {
    //login form
    Route::get('/login', [LoginController::class, 'index'])->name('loginForm');

    //register form
    Route::get('/register', [RegisterController::class, 'index'])->name('registerForm');


});



// login user
Route::post('/login', [LoginController::class, 'login'])->name('login');


//register new user
Route::post('/register', [RegisterController::class, 'store'])->name('register');



//only logged in user
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chart', [DashboardController::class, 'chart'])->name('chart');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

});

Route::middleware(['auth' , 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

});


