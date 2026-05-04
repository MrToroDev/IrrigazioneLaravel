<?php

use App\Http\Controllers\UtenteController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

use App\Http\Controllers\Data\OrtoController;
use App\Http\Controllers\Data\SensoreController;
use App\Http\Controllers\Data\AlertController;

Route::get('/', function () {
    return view("home");
})->name("home");

Route::get('/register', [RegisterController::class, "show"])->name("register");
Route::post('/register/verify', RegisterController::class)->name("register.verify"); 

Route::middleware('guest')->group(function () {    
    Route::get('/login', [LoginController::class, 'show'])->name("login");
    Route::post('/login/verify', LoginController::class)->name("login.verify"); 
});

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', function() {
        return view('user.dashboard');
    })->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])->name("logout");
    
    /** Gestione utente */
    Route::get('/user/settings', [UtenteController::class, 'index'])->name("settings.index");
    Route::put('/user/settings/update', [UtenteController::class, 'update'])->name("settings.update");
    Route::delete('/user/settings/delete', [UtenteController::class, 'delete'])->name("settings.delete");

    Route::get('/user/help', [UtenteController::class, 'showHelp'])->name("user.help");

    /** Gestione dati StemCity */

    Route::get('/user/dashboard/garden', [OrtoController::class, 'index'])->name('dashboard.orto');
    Route::get('/user/dashboard/garden/new', [OrtoController::class, 'create'])->name('dashboard.orto.create');
    Route::post('/user/dashboard/garden/store', [OrtoController::class, 'store'])->name('dashboard.orto.store');
    Route::get('/user/dashboard/garden/{orto}', [OrtoController::class, 'show'])->name('dashboard.orto.id');
    Route::get('/user/dashboard/garden/{orto}/edit', [OrtoController::class, 'edit'])->name('dashboard.orto.edit');
    Route::put('/user/dashboard/garden/{orto}/update', [OrtoController::class, 'update'])->name('dashboard.orto.update');
    Route::delete('/user/dashboard/garden/{orto}/delete', [OrtoController::class, 'delete'])->name('dashboard.orto.delete');

    Route::get('/user/dashboard/sensor', [SensoreController::class, 'index'])->name('dashboard.sensori');
    Route::get('/user/dashboard/sensor/new', [SensoreController::class, 'create'])->name('dashboard.sensori.create');
    Route::post('/user/dashboard/sensor/store', [SensoreController::class, 'store'])->name('dashboard.sensori.store');
    Route::get('/user/dashboard/sensor/{sensore}', [SensoreController::class, 'show'])->name('dashboard.sensori.id');
    Route::get('/user/dashboard/sensor/{sensore}/edit', [SensoreController::class, 'edit'])->name('dashboard.sensori.edit');
    Route::put('/user/dashboard/sensor/{sensore}/update', [SensoreController::class, 'update'])->name('dashboard.sensori.update');
    Route::delete('/user/dashboard/sensor/{sensore}/delete', [SensoreController::class, 'delete'])->name('dashboard.sensori.delete');
    
    Route::get('/user/dashboard/alert', [AlertController::class, 'index'])->name('dashboard.alert');
    Route::put('/user/dashboard/alert/{alert}/update', [AlertController::class, 'update'])->name('dashboard.alert.update');
    Route::delete('/user/dashboard/alert/{alert}/destroy', [AlertController::class, 'destroy'])->name('dashboard.alert.destroy');
});