<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Register extends Component
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone;
    public $address;
    public $province;
    public $city;
    public $district;
    public $block;
    public $rt;
    public $rw;

    protected $rules = [
        'name' => 'required|min:3',
        'username' => 'required|unique:users|min:4',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required',
        'phone' => 'required|numeric|digits_between:10,13',
        'address' => 'required',
        'province' => 'required',
        'city' => 'required',
        'district' => 'required',
        'rt' => 'required',
        'rw' => 'required'
    ];

    protected $messages = [
        'name.required' => 'Nama lengkap wajib diisi',
        'name.min' => 'Nama minimal 3 karakter',
        'username.required' => 'Username wajib diisi',
        'username.unique' => 'Username sudah digunakan',
        'username.min' => 'Username minimal 4 karakter',
        'email.required' => 'Email wajib diisi',
        'email.email' => 'Format email tidak valid',
        'email.unique' => 'Email sudah terdaftar',
        'password.required' => 'Password wajib diisi',
        'password.min' => 'Password minimal 8 karakter',
        'password.confirmed' => 'Konfirmasi password tidak cocok',
        'phone.required' => 'Nomor telepon wajib diisi',
        'phone.numeric' => 'Nomor telepon harus berupa angka',
        'phone.digits_between' => 'Nomor telepon harus 10-13 digit',
        'address.required' => 'Alamat wajib diisi',
        'province.required' => 'Provinsi wajib diisi',
        'city.required' => 'Kota/Kabupaten wajib diisi',
        'district.required' => 'Kecamatan wajib diisi',
        'rt.required' => 'RT wajib diisi',
        'rw.required' => 'RW wajib diisi'
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone_number' => $this->phone,
            'address' => $this->address,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'block' => $this->block,
            'rt' => $this->rt,
            'rw' => $this->rw
        ]);

        Auth::login($user);
        
        session()->flash('success', 'Registrasi berhasil!');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
