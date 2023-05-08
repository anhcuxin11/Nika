<?php

use App\Http\Controllers\Candidate\HomeController;
use App\Http\Controllers\Candidate\JobController;
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
    Route::get('/jobs', [JobController::class, 'index'])->name('job.index');

    Route::middleware('auth')->group(function () {

    });
});
