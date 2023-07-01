<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\OverviewController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::group(['middleware' => 'guest.admin'], function () {
        Route::get('/', function () {
            return view('admin.welcome');
        });
    });

    Route::name('admin.')->group(function() {
        Route::middleware('auth.admin')->group(function () {
            Route::get('/top-page', [OverviewController::class, 'index'])->name('overview');
            Route::get('/users', [HomeController::class, 'index'])->name('users');
            Route::prefix('user')->group(function () {
                Route::get('/{id}/edit', [HomeController::class, 'edit'])->name('user.edit');
                Route::post('/{id}/update', [HomeController::class, 'update'])->name('user.update');
                Route::post('/{id}/delete', [HomeController::class, 'delete'])->name('user.delete');
                Route::post('/{id}/restore', [HomeController::class, 'restore'])->name('user.restore');
            });

            Route::get('/company-management', [CompanyController::class, 'index'])->name('companies');
            Route::prefix('company')->group(function () {
                Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
                Route::post('/{id}/update', [CompanyController::class, 'update'])->name('company.update');
                Route::post('/{id}/delete', [CompanyController::class, 'delete'])->name('company.delete');
                Route::post('/{id}/restore', [CompanyController::class, 'restore'])->name('company.restore');
            });

            Route::get('/job-management', [JobController::class, 'index'])->name('jobs');
            Route::prefix('job')->group(function () {
                Route::post('/{id}/update-status', [JobController::class, 'updateStatus'])->name('job.update-status');
            });
        });
    });
});
