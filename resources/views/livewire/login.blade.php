<div class="flex flex-col min-h-screen items-center justify-center bg-base-200">
    <main class="bg-base-100 flex flex-col justify-center min-h-[60vh] items-center p-8 w-full max-w-md">
        <div class="flex flex-col items-center justify-center gap-2 p-8">
            <h1 class="text-lg font-bold">ログイン</h1>
        </div>
        <form wire:submit.prevent="login" class="flex flex-col justify-center w-full gap-4">
            <div class="form-control">
                <label class="label" for="email"><span class="label-text">メールアドレス</span></label>
                <input wire:model='email' type="email" placeholder="email" class="input input-bordered [&:user-invalid]:input-warning [&:user-valid]:input-success" required id="email" autocomplete="email" />
                @error('email')
                    <div class="text-sm text-error italic">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="password"><span class="label-text">パスワード</span></label>
                <input wire:model='password' type="password" placeholder="password" class="input input-bordered [&:user-invalid]:input-warning [&:user-valid]:input-success" required minlength="8" id="password" autocomplete="current-password" />
                @error('password')
                    <div class="text-sm text-error italic">{{ $message }}</div>
                @enderror
            </div>

            <!-- Login Error Alert -->
            @if ($loginError)
                <span class="text-error">{{ $loginError }}</span>
            @endif

            <!-- Submit Button -->
            <button class="btn btn-neutral" type="submit">ログイン</button>

            <!-- Register Link -->
            <div class="label justify-end">
                <a class="link-hover link label-text-alt" href="{{ route('register') }}">新規登録はこちら</a>
            </div>
        </form>
    </main>
</div>
