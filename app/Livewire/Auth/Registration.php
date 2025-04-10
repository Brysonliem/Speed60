<?php

namespace App\Livewire\Auth;

use App\Models\Role;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.guest')]
class Registration extends Component
{
    #[Validate('required|string')]
    public string $username = '';

    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string|min:6|confirmed')]
    public string $password = '';

    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password_confirmation = '';

    #[Validate('required|string')]
    public string $rt = '';

    #[Validate('required|string')]
    public string $rw = '';

    #[Validate('required|string')]
    public string $block = '';
    
    #[Validate('required|string')]
    public string $district = '';

    #[Validate('required|string')]
    public string $province = '';

    // #[Validate('nullable')]
    // public string $birth_date = '';

    #[Validate('required|string')]
    public string $city = '';

    #[Validate('required|numeric')]
    public string $role_level = '';

    public $address;

    public $roles;

    public function login()
    {
        $this->redirect(route('login'), true);
    }

    public function register()
    {
        // Validasi otomatis berdasarkan atribut #[Validate]
        // $this->validate();

        DB::transaction(function () {
            $role = Role::where('level', 3)->first();

            User::create([
                'username' => $this->username,
                'name' => $this->name,
                'password' => bcrypt($this->password),
                'city' => $this->city,
                'rt' => $this->rt,
                'rw' => $this->rw,
                'district' => $this->district,
                'province' => $this->province,
                'address' => $this->address,
                // 'birth_date' => Carbon::parse($this->birth_date)->format('Y-m-d'),
                'block' => $this->block,
                'role_id' => $role->id
            ]);
        });

        session()->flash('message', 'Registration successful!');
        $this->redirect(route('login'));
    }

    public function mount()
    {
        $this->roles = DB::table('role as r')->orderByDesc('r.created_at')->get();
    }

    public function render()
    {
        return view('livewire.pages.auth.register');
    }
}
