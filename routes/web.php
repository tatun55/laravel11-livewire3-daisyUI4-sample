<?php

use Illuminate\Support\Facades\Route;

// このアプリケーションはTODO機能しかないので、リダイレクトしてTODO一覧画面に遷移する
Route::get('/', function () {
    return redirect()->route('todos.index');
});

// RESTfulなURLを設定する
Route::get('todos', function () {
    return view('todos.index');
})->name('todos.index');
