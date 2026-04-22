<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view("home");
});

Route::middleware('guest')->group(function () {    
    Route::get('/login', function() {
        return view('login');
    });
    
    Route::post('/login/verify', LoginController::class)->name("login.verify"); 
});

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', function() {
        return view('user.dashboard');
    })->name('dashboard');
});