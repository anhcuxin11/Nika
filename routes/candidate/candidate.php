<?php

use App\Http\Controllers\Candidate\ApplicationController;
use App\Http\Controllers\Candidate\CompanyController;
use App\Http\Controllers\Candidate\FavoriteController;
use App\Http\Controllers\Candidate\HomeController;
use App\Http\Controllers\Candidate\JobController;
use App\Http\Controllers\Candidate\ResumeController;
use App\Http\Controllers\Candidate\ResumeRequirementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('candidate.')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'index'])->name('job.index');
        Route::get('/{id}', [JobController::class, 'show'])->name('job.show');
    });

    Route::get('companies/{id}', [CompanyController::class, 'show'])->name('companies');

    Route::middleware('auth')->group(function () {
        Route::prefix('favorites')->group(function () {
            Route::get('/', [FavoriteController::class, 'index'])->name('favorite.index');
            Route::post('/{job_id}', [FavoriteController::class, 'store'])->name('favorite.store');
            Route::delete('/{job_id}/delete', [FavoriteController::class, 'delete'])->name('favorite.delete');
        });

        Route::get('/{id}/applications/create', [ApplicationController::class, 'index'])->name('job.application');
        Route::post('/{id}/applications/apply', [ApplicationController::class, 'apply'])->name('job.apply');

        Route::prefix('resumes')->group(function () {
            Route::get('/', [ResumeController::class, 'index'])->name('resume');
            Route::get('/{id}/edit', [ResumeController::class, 'edit'])->name('resume.edit');
            Route::post('/{id}/update', [ResumeController::class, 'update'])->name('resume.update');
            Route::get('/{id}/experience', [ResumeController::class, 'experience'])->name('resume.experience');
            Route::post('/{id}/experience/update', [ResumeController::class, 'updateExperience'])->name('resume.experience.update');
        });

        Route::prefix('desired-job')->group(function () {
            Route::get('/' , [ResumeRequirementController::class, 'index'])->name('desired-job');
            // Route::group(['middleware' => 'cors'], function () {
                Route::post('/api/update', [ResumeRequirementController::class, 'update'])->name('desired-job.update');
            // });
        });

    });
});
