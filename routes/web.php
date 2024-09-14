<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Posts;
use App\Livewire\Register;
use App\Livewire\Login;

// ログインしているユーザーのみアクセス可能
Route::middleware(['auth'])->group(function () {
    Route::get('/', Posts::class)->name('home');  // Only accessible to authenticated users
});

// ログインしていないユーザーのみアクセス可能
Route::middleware(['guest'])->group(function () {
    Route::get('/register', Register::class)->name('register');  // Only accessible to non-authenticated users
    Route::get('/login', Login::class)->name('login');  // Only accessible to non-authenticated users
});
