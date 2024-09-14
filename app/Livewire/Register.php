<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $auth_error;
    public $rules;

    public function mount()
    {
        $this->rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed'],
        ];
    }

    public function register()
    {
        $this->validate();

        // Create a new user
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Optionally, log the user in after registration
        auth()->attempt(['email' => $this->email, 'password' => $this->password]);

        // Redirect to a specific page after registration
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.register')->layout('components.layouts.guest');
    }
}
