<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class ForgotPassword extends Component
{
    #[Validate('required|email:filter')]
    public string $email = '';
    public string $status = '';
    public string $errorMsg = '';

    public function sendLink()
    {
        $this->validate();

        // ====== KEBIJAKAN OAUTH-ONLY (opsional) ======
        // Jika kamu ingin blokir reset untuk akun Google-only, aktifkan snippet ini:
        // $user = User::where('email', $this->email)->first();
        // if ($user && $user->provider === 'google' && empty($user->password)) {
        //     $this->errorMsg = 'Akun ini memakai Google Sign-In. Silakan masuk lewat Google.';
        //     return;
        // }
        // =============================================

        $status = Password::broker('users')->sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->status = __($status);
            $this->errorMsg = '';
        } else {
            $this->status = '';
            $this->errorMsg = __($status);
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.forgot-password');
    }
}
