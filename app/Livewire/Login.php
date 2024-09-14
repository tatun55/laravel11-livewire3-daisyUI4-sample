<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;
    public $loginError;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        $this->validate();

        // ログイン
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Redirect to a specific page after successful login
            return redirect()->route('home');
        }

        // ログイン失敗
        $this->loginError = 'メールアドレスまたはパスワードが間違っています。';
    }

    public function render()
    {
        return view('livewire.login')->layout('components.layouts.guest');
    }
}
