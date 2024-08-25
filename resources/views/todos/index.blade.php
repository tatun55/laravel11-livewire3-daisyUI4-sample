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
        <form class="flex w-96">
            <input type="text" class="input input-bordered w-full max-w-xs">
            <button type="submit" class="btn btn-neutral">追加</button>
        </form>
        {{-- リスト表示部 --}}
        <ul class="flex flex-col text-left gap-2 w-96">
            <li>きゅうり</li>
            <li>なす</li>
            <li>かぼちゃ</li>
        </ul>
    </div>
</body>

</html>
