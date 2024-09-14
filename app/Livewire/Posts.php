<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Posts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $message = '';
    public $current_message = '';

    public Post $post;

    public $search = '';

    // アップロードされた画像を格納するプロパティ
    public $photo;

    public function storePost()
    {
        $this->validate([
            'message' => 'required|max:255'
        ]);
        $post = new Post();
        $post->message = $this->message;

        // 画像がアップロードされている場合は、画像を保存する
        if ($this->photo) {
            $path = $this->photo->store(path: 'photos');
            $post->img_path = $path;
        }

        $post->save();
        $this->reset('message');
        $this->dispatch('post-saved');
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
        $this->dispatch('post-updated');
    }

    public function deletePost()
    {
        $this->post->delete();
    }

    public function resetFormValidation()
    {
        $this->resetValidation();
    }

    // Searchプロパティが更新されたときに実行されるメソッド
    public function updatingSearch()
    {
        $this->resetPage(); // Pagenationをリセットする
    }

    public function render()
    {
        $query = Post::query();
        if ($this->search) {
            $query->where('message', 'like', '%' . $this->search . '%');
        }

        return view('livewire.posts', ['posts' => $query->orderBy('created_at', 'desc')->paginate(10)])
            ->title('投稿管理ページ');
    }
}
