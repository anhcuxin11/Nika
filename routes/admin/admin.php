<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::group(['middleware' => 'guest.admin'], function () {
        Route::get('/', function () {
            return view('admin.welcome');
        });
    });

    Route::name('admin.')->group(function() {
        Route::middleware('auth.admin')->group(function () {
            Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
        });
    });
});

