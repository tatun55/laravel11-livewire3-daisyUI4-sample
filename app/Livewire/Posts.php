<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $message = '';
    public $posts = [];


    public function storePost()
    {
        $post = new Post();
        $post->message = $this->message;
        $post->save();
        $this->reset('message');
    }

    public function render()
    {
        $this->posts = Post::latest()->get();
        return view('livewire.posts')
            ->title('投稿管理ページ');
    }
}
