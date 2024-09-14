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
    public $current_photo_path = '';

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
            $path = $this->photo->store(path: 'public/photos');
            $path = str_replace('public/', 'storage/', $path);
            $post->photo_path = $path;
        }

        $post->save();
        $this->reset('message', 'photo');
        $this->dispatch('post-saved');
    }

    public function editPost($id)
    {
        $this->post = Post::find($id);
        $this->current_photo_path = $this->post->photo_path;
        $this->current_message = $this->post->message;
    }

    public function updatePost()
    {
        if (!auth()->user()->can('update', $this->post)) {
            abort(403);
        }
        $this->validate([
            'current_message' => 'required|max:255'
        ]);
        $this->post->message = $this->current_message;
        $this->post->save();
        $this->dispatch('post-updated');
    }

    public function deletePost()
    {
        if (!auth()->user()->can('delete', $this->post)) {
            abort(403);
        }
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
