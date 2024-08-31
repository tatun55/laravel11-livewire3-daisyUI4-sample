<div class="h-[100vh] w-full flex flex-col justify-center items-center gap-8">
    <h2 class="text-2xl">TODOリスト</h2>
    {{-- リスト表示部 --}}
    <ul class="flex flex-col text-left gap-2">
        @foreach ($todos as $todo)
            <li class="w-96">{{ $todo }}</li>
        @endforeach
    </ul>
</div>
