<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/invitations/accept/{token}', [InvitationController::class, 'showAcceptForm'])->name('invitations.accept');
Route::post('/invitations/accept/{token}', [InvitationController::class, 'accept']);

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('short-urls', ShortUrlController::class)->only(['index', 'create', 'store']);
    Route::resource('invitations', InvitationController::class)->only(['create', 'store']);
});

Route::get('/{shortCode}', [RedirectController::class, 'redirect'])->name('redirect');
