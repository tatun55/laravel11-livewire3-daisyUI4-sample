<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        // TODOデータを取得
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
        // return view('todos.index',['todos' => $todos]); // compact関数を使わずに連想配列を使ってもOK
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->save();

        return redirect()->route('todos.index');
    }
}
