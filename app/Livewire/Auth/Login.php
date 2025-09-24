<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    // Form object untuk login (punya method authenticate())
    public LoginForm $loginForm;

    // State UI: login | register
    public string $active = 'login';

    // Field register
    public string $reg_username = '';
    public string $reg_name = '';
    public string $reg_email = '';
    public string $reg_password = '';
    public string $reg_password_confirmation = '';

    /**
     * Validasi dinamis untuk register (dipanggil di register()).
     * Untuk login tetap pakai $this->validate() dari LoginForm (di method login()).
     */
    protected function registerRules(): array
    {
        return [
            'reg_username' => [
                'required', 'string', 'min:3', 'max:50', 'alpha_dash',
                Rule::unique('users', 'username'),
            ],
            'reg_name' => ['required', 'string', 'min:3'],
            'reg_email' => [
                'required', 'string', 'email',
                Rule::unique('users', 'email'),
            ],
            'reg_password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
    }

    /**
     * Agar konfirmasi password Livewire cocok dengan aturan "confirmed"
     * (nama field harus <field>_confirmation).
     */
    public function updatedRegPasswordConfirmation() {} // no-op, hanya memastikan properti terdefinisi

    public function switchTo(string $tab): void
    {
        $this->active = $tab === 'register' ? 'register' : 'login';
        // clear error ketika berpindah tab
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function login()
    {
        // Validasi input login via Form Object (pastikan LoginForm punya rules)
        $this->validate();

        // Hapus URL intended agar tidak bentrok
        session()->forget('url.intended');

        // Autentikasi
        $this->loginForm->authenticate();

        // Regenerasi session
        Session::regenerate();

        // Redirect by role level
        $user = Auth::user();

        $ip    = request()->ip() ?? '-';
        $agent = request()->userAgent() ?? '-';
        $when  = now()->timezone(config('app.timezone'))->toDateTimeString();

        // kirim notifikasi
        $user->notify(new \App\Notifications\LoginInfoNotification($ip, $agent, $when));
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
        // Validasi field register
        $this->validate($this->registerRules(), [], [
            'reg_username' => 'username',
            'reg_name' => 'fullname',
            'reg_email' => 'email',
            'reg_password' => 'password',
        ]);

        // Simpan user baru (default role level 3 -> user)
        $user = DB::transaction(function () {
            $role = Role::where('level', 3)->firstOrFail();

            return User::create([
                'username' => $this->reg_username,
                'name'     => $this->reg_name,
                'email'    => $this->reg_email,
                'password' => Hash::make($this->reg_password),
                'role_id'  => $role->id,
            ]);
        });

        // Auto-login setelah register (opsional; kalau tidak mau, hapus 3 baris ini)
        Auth::login($user);
        Session::regenerate();

        // Redirect by role level (user baru => kemungkinan level 3)
        return $this->redirectIntended(
            match ($user->role->level) {
                1 => route('dashboard.superadmin', absolute: false),
                2 => route('dashboard.admin', absolute: false),
                default => route('dashboard.user', absolute: false),
            },
            navigate: true
        );
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
