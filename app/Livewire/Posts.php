<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Posts extends Component
{
    public $message = '';

    public function storePost()
    {
        dd($this->message);
    }

    public function render()
    {
        return view('livewire.posts')
            ->title('投稿管理ページ');
    }
}
