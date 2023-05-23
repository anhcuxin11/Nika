<?php

use App\Http\Controllers\Company\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->group(function() {
    Route::group(['middleware' => 'guest.company'], function () {
        Route::get('/', function () {
            return view('company.welcome');
        });
    });

    Route::name('company.')->group(function() {
        Route::middleware('auth.company')->group(function () {
            Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        });
    });

});

