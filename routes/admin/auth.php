<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function() {
    Route::prefix('admin')->group(function() {
        Route::group(['middleware' => 'guest.admin'], function () {
            Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                        ->name('login');

            Route::post('/login', [AuthenticatedSessionController::class, 'store']);
        });

        Route::middleware('auth.admin')->group(function () {
            Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                        ->name('logout');
        });
    });
});

