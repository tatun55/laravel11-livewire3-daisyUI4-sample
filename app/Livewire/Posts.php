<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $message = '';
    public $current_message = '';
    public Post $post;
    public $posts = [];


    public function storePost()
    {
        $post = new Post();
        $post->message = $this->message;
        $post->save();
        $this->reset('message');
    }

    public function editPost($id)
    {
        $this->post = Post::find($id);
        $this->current_message = $this->post->message;
    }

    public function updatePost()
    {
        $this->post->message = $this->current_message;
        $this->post->save();
        $this->reset('message');
    }

    public function deletePost()
    {
        $this->post->delete();
    }

    public function render()
    {
        $this->posts = Post::latest()->get();
        return view('livewire.posts')
            ->title('投稿管理ページ');
    }
}
