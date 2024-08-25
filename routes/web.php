<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

// このアプリケーションはTODO機能しかないので、リダイレクトしてTODO一覧画面に遷移する
Route::get('/', function () {
    return redirect()->route('todos.index');
});

// RESTfulなURLを設定する
Route::get('todos', [TodoController::class, 'index'])->name('todos.index');
Route::get('todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('todos', [TodoController::class, 'store'])->name('todos.store');
