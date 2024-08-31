<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;
use Livewire\Attributes\Validate;

class Todos extends Component
{
    #[Validate('required|max:32')]
    public $todo = '';

    public $todos = [];

    public function add()
    {
        $this->validate();
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
