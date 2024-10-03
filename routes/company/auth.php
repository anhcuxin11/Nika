<?php

use App\Http\Controllers\Company\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Company\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Company\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Company\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Company\Auth\NewPasswordController;
use App\Http\Controllers\Company\Auth\PasswordResetLinkController;
use App\Http\Controllers\Company\Auth\RegisteredUserController;
use App\Http\Controllers\Company\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Route::prefix('company')->group(function() {
    Route::group([
        'middleware' => [
            'guest.company',
        ]
    ], function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])
                    ->name('company.register');

        Route::post('/register', [RegisteredUserController::class, 'store']);

        Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                    ->name('company.login');

        Route::post('/login', [AuthenticatedSessionController::class, 'store']);

        Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                    ->name('company.password.request');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                    ->name('company.password.email');

        Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                    ->name('company.password.reset');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
                    ->name('company.password.update');
    });

    Route::middleware('auth.company')->group(function () {
        Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->name('company.verification.notice');

        Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('company.verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware('throttle:6,1')
                    ->name('company.verification.send');

        Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->name('company.password.confirm');

        Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->name('company.logout');
    });
// });
