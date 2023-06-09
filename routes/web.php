<?php

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

require __DIR__.'/candidate/auth.php';
require __DIR__.'/candidate/candidate.php';
require __DIR__.'/company/auth.php';
require __DIR__.'/company/company.php';
require __DIR__.'/admin/auth.php';
require __DIR__.'/admin/admin.php';
