<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="h-[100vh] w-full flex flex-col justify-center items-center gap-8">
        <h2 class="text-2xl">TODOリスト</h2>
        {{-- 入力部 --}}
        <div class="flex flex-col">
            <form action="{{ route('todos.store') }}" method="POST" class="flex w-96">
                @csrf
                <input name="title" type="text" class="input input-bordered w-full max-w-xs" value="{{ old('title') ?? null }}">
                <button type="submit" class="btn btn-neutral">保存</button>
            </form>
            @error('title')
                <div class="text-error">{{ $message }}</div>
            @enderror
        </div>
        {{-- リスト表示部 --}}
        <ul class="flex flex-col text-left gap-2 w-96">
            @foreach ($todos as $todo)
                <li>
                    <span>{{ $todo->title }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
