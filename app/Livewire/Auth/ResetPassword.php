<?php

namespace App\Livewire\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class ResetPassword extends Component
{
    public string $email = '';
    public string $token = '';
    #[Validate('required|min:8')] public string $password = '';
    #[Validate('same:password')] public string $password_confirmation = '';
    public string $status = ''; public string $errorMsg = '';

    public function mount() { $this->email = request('email',''); $this->token = request('token',''); }

    public function submit()
    {
        $this->validate();

        $res = Password::broker('users')->reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function ($user) {
                $user->forceFill(['password' => Hash::make($this->password)])->save();
                $user->setRememberToken(Str::random(60));
                event(new PasswordReset($user));
            }
        );

        if ($res === Password::PASSWORD_RESET) {
            session()->flash('status', __($res));               // biar kebaca di halaman login
            $this->reset(['password', 'password_confirmation']); // optional bersihin state
            return $this->redirectRoute('login', navigate: true);
        }

        $this->errorMsg = __($res);
    }


    public function render() { return view('livewire.pages.auth.reset-password'); }
}
