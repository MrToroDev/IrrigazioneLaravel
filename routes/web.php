<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\Data\OrtoController;
use App\Http\Controllers\Data\SensoreController;
use App\Http\Controllers\Data\AlertController;

Route::get('/', function () {
    return view("home");
})->name("home");

Route::get('/register', function() {
    return view('register');
})->name("register");
    
Route::post('/register/verify', RegisterController::class)->name("register.verify"); 

Route::middleware('guest')->group(function () {    
    Route::get('/login', [LoginController::class, 'show'])->name("login");

    Route::post('/login/verify', LoginController::class)->name("login.verify"); 
});

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', function() {
        return view('user.dashboard');
    })->name('dashboard');
    
    Route::get('/user/dashboard/garden', [OrtoController::class, 'index'])->name('dashboard.orto');
    Route::get('/user/dashboard/sensor', [SensoreController::class, 'index'])->name('dashboard.sensori');
    Route::get('/user/dashboard/alert', [AlertController::class, 'index'])->name('dashboard.alert');

    Route::post('/logout', [LoginController::class, 'logout'])->name("logout");
});