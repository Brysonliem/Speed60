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
        // Validasi input
        $this->validate();

        // Hapus URL yang disimpan di session sebelum autentikasi
        session()->forget('url.intended');

        // Autentikasi pengguna
        $this->loginForm->authenticate();

        // Regenerasi session untuk keamanan
        Session::regenerate();

        // Ambil user yang sedang login
        $user = Auth::user();

        // Tentukan redirect berdasarkan level role
        return $this->redirectIntended(
            match ($user->role->level) {
                1 => route('dashboard.superadmin', absolute: false),
                2 => route('dashboard.admin', absolute: false),
                default => route('dashboard.user', absolute: false),
            },
            navigate: true
        );
    }


    public function register()
    {
        $this->redirect(route('register'), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}