<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AspirationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AspirationController::class, 'index'])->name('dashboard');
    Route::post('/aspirations', [AspirationController::class, 'store'])->name('aspirations.store');
    Route::delete('/aspirations/{id}', [AspirationController::class, 'destroy'])->name('aspirations.destroy');

    Route::post('/aspirations/{id}/reply', [AspirationController::class, 'storeReply'])->name('aspirations.reply.store');
    Route::delete('/replies/{id}', [AspirationController::class, 'destroyReply'])->name('replies.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
