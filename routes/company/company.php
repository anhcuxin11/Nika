<?php

use Illuminate\Support\Facades\Route;

Route::prefix('company')->group(function() {
    Route::group(['middleware' => 'guest.company'], function () {
        Route::get('/', function () {
            return view('company.welcome');
        });
    });

    Route::middleware('auth.company')->group(function () {
        Route::get('/dashboard', function () {
            return view('company.dashboard');
        })->name('company.dashboard');
    });
});

