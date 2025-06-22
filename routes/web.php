<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Auth::routes(['verify' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('dashboard');
    Route::resource('tasks', TaskController::class)->only([
        'create',
        'store',
        'edit',
        'update',
        'destroy'
    ]);
    Route::get('/reminders', [TaskController::class, 'showReminders'])->name('reminders');
});
