<div class="h-[100vh] w-full flex flex-col justify-center items-center gap-8">
    <h2 class="text-2xl">TODOリスト</h2>
    {{-- 入力部 --}}
    <div class="flex flex-col">
        <form wire:submit="add" class="flex w-96">
            <input wire:model="todo" type="text" class="input input-bordered w-full max-w-xs">
            <button type="submit" class="btn btn-neutral">追加</button>
        </form>
        {{-- エラー表示 --}}
        @error('todo')
            <div class="w-96 text-error">{{ $message }}</div>
        @enderror
    </div>
    {{-- リスト表示部 --}}
    <ul class="flex flex-col text-left gap-2">
        @foreach ($todos as $todo)
            <li class="w-96">{{ $todo->title }}</li>
        @endforeach
    </ul>
</div>
