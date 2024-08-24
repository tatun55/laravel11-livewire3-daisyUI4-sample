<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;


// コンポーネントにタイトルを追加します。これは、コンポーネントのタイトルを表示するために使用されます。
#[Title('Todos')]
class Todos extends Component
{
    // プロパティを追加します。これは、新しいTODOを追加するために使用されます。
    public $todo = '';

    // プロパティを追加します。これは、TODOリストを保持するために使用されます。
    public $todos = [
        'Take out trash',
        'Do dishes',
    ];

    // メソッドを追加します。これは、新しいTODOをTODOリストに追加します。
    public function add()
    {
        $this->todos[] = $this->todo;

        $this->reset('todo');
    }

    // メソッドを追加します。これは、TODOリストからTODOを削除します。
    public function render()
    {
        return view('livewire.todos');
    }
}
