<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
    {
        // ログアウト
        Auth::logout();

        // セッションを無効にする
        session()->invalidate();

        // 新しいセッショントークンを発行する
        session()->regenerateToken();

        // ログイン画面にリダイレクト
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.logout');
    }
}
