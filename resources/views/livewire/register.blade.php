<div class="flex flex-col min-h-screen items-center justify-center bg-base-200">
    <main class="bg-base-100 flex flex-col justify-center min-h-[60vh] items-center p-8 w-full max-w-md">
        <div class="flex flex-col items-center justify-center gap-2 p-8">
            <h1 class="text-lg font-bold">新規登録</h1>
        </div>
        <form wire:submit.prevent="register" class="flex flex-col justify-center w-full gap-4">
            <div class="form-control">
                <label class="label" for="name"><span class="label-text">ユーザーネーム</span></label>
                <input wire:model='name' type="text" placeholder="nickname" class="input input-bordered [&:user-invalid]:input-warning [&:user-valid]:input-success" required id="name" autocomplete="nickname" />
                @error('name')
                    <div class="text-sm text-error italic">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="input1"><span class="label-text">メールアドレス</span></label>
                <input wire:model='email' type="email" placeholder="email" class="input input-bordered [&:user-invalid]:input-warning [&:user-valid]:input-success" required id="input1" autocomplete="email" />
                @error('email')
                    <div class="text-sm text-error italic">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="input2"><span class="label-text">パスワード</span></label>
                <input wire:model='password' type="password" placeholder="password" class="input input-bordered [&:user-invalid]:input-warning [&:user-valid]:input-success" required minlength="8" for="input2" />
                @error('password')
                    <div class="text-sm text-error italic">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="input2"><span class="label-text">パスワード(確認用)</span></label>
                <input wire:model='password_confirmation' type="password" placeholder="password(確認用)" class="input input-bordered [&:user-invalid]:input-warning [&:user-valid]:input-success" required minlength="8" for="input2" />
                @error('password_confirmation')
                    <div class="text-sm text-error italic">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-neutral" type="submit">新規登録</button>

            <!-- signup -->
            <div class="label justify-end">
                <a class="link-hover link label-text-alt" href="{{ route('login') }}">すでに登録した方はこちら</a>
            </div>
            <!-- /signup -->

        </form>
    </main>
</div>
