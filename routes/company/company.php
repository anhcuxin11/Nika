<?php

use App\Http\Controllers\Company\ApplicationController;
use App\Http\Controllers\Company\FavoriteController;
use App\Http\Controllers\Company\HomeController;
use App\Http\Controllers\Company\JobController;
use App\Http\Controllers\Company\MessageController;
use App\Http\Controllers\Company\ScoutController;
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
                Route::put('/api/status/{id}/update/{status}', [FavoriteController::class, 'updateStatus'])->name('favorites.update.status');
                Route::put('/api/mark/{id}/update/{status}', [FavoriteController::class, 'updateMark'])->name('favorites.update.mark');
        });

            Route::prefix('applications')->group(function () {
                Route::get('/', [ApplicationController::class, 'index'])->name('applications');
                Route::put('/api/status/{id}/update/{status}', [ApplicationController::class, 'updateStatus'])->name('applications.update.status');
            });

            Route::prefix('messages')->group(function () {
                Route::post('/api/{id}/history/{candidateId}', [MessageController::class, 'history'])->name('messages.api.history');
                Route::post('/api/send', [MessageController::class, 'send'])->name('messages.api.send');
                //scout
                Route::post('/api/{candidateId}/history-scout', [MessageController::class, 'historyScout'])->name('messages.api.history-scout');
                Route::post('/api/send-scout', [MessageController::class, 'sendScout'])->name('messages.api.send-scout');
            });

            Route::prefix('scouts')->group(function () {
                Route::get('/', [ScoutController::class, 'index'])->name('scouts.search');
                Route::get('/result', [ScoutController::class, 'result'])->name('scouts.result');
                Route::put('/api/mark/{id}', [ScoutController::class, 'addMark'])->name('messages.api.add-mark');
                Route::delete('/api/mark/{id}', [ScoutController::class, 'removeMark'])->name('messages.api.remove-mark');
            });
        });
    });
});

