<?php

use App\Http\Controllers\Company\ApplicationController;
use App\Http\Controllers\Company\FavoriteController;
use App\Http\Controllers\Company\HomeController;
use App\Http\Controllers\Company\JobController;
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

            Route::prefix('jobs')->group(function () {
                Route::get('/', [JobController::class, 'index'])->name('jobs');
                Route::put('/api/statuses/update', [JobController::class, 'updateMultiStatus'])
                    ->name('jobs.update.statuses');
                Route::put('/api/status/{id}/update/{status}', [JobController::class, 'updateStatus'])
                    ->name('jobs.ajax.update.status');

                Route::get('/create', [JobController::class, 'create'])->name('jobs.create');
                Route::post('/store', [JobController::class, 'store'])->name('jobs.store');
                Route::get('/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
                Route::post('/{id}/update', [JobController::class, 'update'])->name('jobs.update');
            });

            Route::prefix('favorites')->group(function () {
                Route::get('/', [FavoriteController::class, 'index'])->name('favorites');
            });

            Route::prefix('applications')->group(function () {
                Route::get('/', [ApplicationController::class, 'index'])->name('applications');
            });
        });
    });
});

