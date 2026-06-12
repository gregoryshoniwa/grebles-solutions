<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('auth/google/redirect', [SocialAuthController::class, 'redirect'])->name('google.redirect');
    Route::get('auth/google/callback', [SocialAuthController::class, 'callback'])->name('google.callback');
});

Route::middleware(['auth', 'verified', 'active'])->group(function () {
    Route::get('dashboard', function () {
        return request()->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('team', [TeamController::class, 'index'])->name('team.index');
    Route::post('team', [TeamController::class, 'store'])->name('team.store');
    Route::delete('team/{member}', [TeamController::class, 'destroy'])->name('team.destroy');
});

Route::middleware(['auth', 'verified', 'active', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/settings.php';
