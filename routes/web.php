<?php

use App\Http\Controllers\Admin\AspirationAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'))->name('welcome');

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);

    Route::controller(AspirationAdminController::class)->group(function () {
        Route::get('/aspirations', 'index')->name('aspirations.index');
        Route::patch('/aspirations/{id}/status', 'updateStatus')->name('aspirations.update-status');
        Route::get('/aspirations/{id}', 'show')->name('aspirations.show');
        Route::delete('/aspirations/{id}', 'destroy')->name('aspirations.destroy');
    });
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::resource('aspirations', AspirationController::class)->except(['create', 'edit', 'update']);
    Route::post('/aspirations/{id}/reply', [AspirationController::class, 'storeReply'])->name('aspirations.reply.store');
    Route::delete('/replies/{id}', [AspirationController::class, 'destroyReply'])->name('replies.destroy');

    Route::get('/my-activity', [AspirationController::class, 'activity'])->name('aspirations.activity');
    Route::get('/about', fn() => view('about'))->name('about');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
