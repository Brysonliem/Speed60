<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Login extends Component
{
    public $username;
    public $password;
    public $showRegister = false;

    protected $rules = [
        'username' => 'required',
        'password' => 'required',
    ];

    protected $messages = [
        'username.required' => 'Username wajib diisi',
        'password.required' => 'Password wajib diisi',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            session()->flash('success', 'Berhasil login!');
            return redirect()->intended('/dashboard');
        }

        session()->flash('error', 'Username atau password salah!');
    }

    public function toggleRegister()
    {
        $this->showRegister = !$this->showRegister;
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}