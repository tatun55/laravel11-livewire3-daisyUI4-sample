<div x-data="{
    newTodo: '',
    todos: []
}" class="h-[100vh] w-full flex flex-col justify-center items-center gap-8">
    <h2 class="text-2xl">TODOリスト</h2>
    {{-- 入力部 --}}
    <div class="flex flex-col">
        <form class="flex w-96">
            <input type="text" x-model="newTodo" class="input input-bordered w-full max-w-xs">
            <button type="button" @click="todos.push({ text: newTodo, completed: false }); newTodo = ''" class="btn btn-neutral">追加</button>
        </form>
    </div>
    {{-- リスト表示部 --}}
    <ul class="flex flex-col text-left gap-2">
        <template x-for="todo in todos">
            <li class="w-96">
                <label>
                    <input type="checkbox" x-model="todo.completed">
                    <span x-text="todo.text"></span>
                </label>
            </li>
        </template>
    </ul>
</div>
