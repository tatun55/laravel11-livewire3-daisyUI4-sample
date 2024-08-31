<?php

namespace App\Livewire;

use Livewire\Component;

class Todos extends Component
{
    public $todos = [
        '買い物に行く',
        '掃除をする',
        '洗濯をする',
        '料理をする',
        '本を読む',
    ];

    public function render()
    {
        return view('livewire.todos');
    }
}
