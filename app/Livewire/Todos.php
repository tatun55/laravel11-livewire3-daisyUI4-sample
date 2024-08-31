<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class Todos extends Component
{
    public $todo = '';

    public $todos = [];

    public function add()
    {
        $todo = new Todo();
        $todo->title = $this->todo;
        $todo->save();
        $this->todos[] = $todo;
        $this->reset('todo');
    }


    public function mount()
    {
        $this->todos = Todo::all();
    }

    public function render()
    {
        return view('livewire.todos');
    }
}
