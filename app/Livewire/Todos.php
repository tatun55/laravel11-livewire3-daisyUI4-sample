<?php

namespace App\Livewire;

use Livewire\Component;

class Todos extends Component
{
    public $todo = ''; //ここを追加

    public $todos = [
        '買い物に行く',
        '掃除をする',
        '洗濯をする',
        '料理をする',
        '本を読む',
    ];

    public function add()
    {
        $this->todos[] = $this->todo; //ここを修正
    }

    public function render()
    {
        return view('livewire.todos');
    }
}