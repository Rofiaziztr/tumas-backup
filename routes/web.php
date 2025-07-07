<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;




Auth::routes(['verify' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('dashboard');
    Route::resource('tasks', TaskController::class)->only([
        'create',
        'store',
        'edit',
        'update',
        'show',
        'destroy'
    ]);
    Route::get('/reminders', [TaskController::class, 'showReminders'])->name('reminders');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});
