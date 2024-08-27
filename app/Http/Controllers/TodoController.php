<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return view('todos.index');
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
