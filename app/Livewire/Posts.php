<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;


class Posts extends Component
{
    use WithPagination;

    public $message = '';
    public $current_message = '';
    public Post $post;

    public function storePost()
    {
        $this->validate([
            'message' => 'required|max:255'
        ]);

        $post = new Post();
        $post->message = $this->message;
        $post->save();
        $this->reset('message'); // textarea[name="message"]をリセットする
    }

    public function editPost($id)
    {
        $this->post = Post::find($id);
        $this->current_message = $this->post->message;
    }

    public function updatePost()
    {
        $this->validate([
            'current_message' => 'required|max:255'
        ]);

        $this->post->message = $this->current_message;
        $this->post->save();
        $this->reset('current_message');
    }

    public function deletePost()
    {
        $this->post->delete();
    }

    // Validationメッセージのリセット用に作成
    public function resetFormValidation()
    {
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.posts', ['posts' => Post::latest()->paginate(10)])
            ->title('投稿管理ページ');
    }
}
