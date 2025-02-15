<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    public LoginForm $loginForm;

    public function login() 
    {
        //validating all rules
        $this->validate();

        $this->loginForm->authenticate();

        Session::regenerate();

        // Ambil user yang sedang login
        $user = Auth::user();
        session()->forget('url.intended');

        // Cek role level dan tentukan redirect
        if ($user->role->level == 1) {
            return $this->redirectIntended(route('home.superadmin', absolute: false), navigate: true);
        } else {
            return $this->redirectIntended(route('home', absolute: false), navigate: true);
        }

    }

    public function register()
    {
        $this->redirect(route('register'), navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}