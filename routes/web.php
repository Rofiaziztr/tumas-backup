<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome', ['title' => 'welcome']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'about']);
});

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');
