<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Posts;
use App\Livewire\Register;
use App\Livewire\Login;


Route::get('/', Posts::class)->name('home');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
