<?php

namespace App\Livewire\Pages\Tabs;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyAccount extends Component
{
    public $user = [];

    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $authUser = Auth::user();

        $this->user = [
            'id'    => $authUser->id,
            'name' => $authUser->name,
            'username' => $authUser->username,
            'email' => $authUser->email,
            'phone_number' => $authUser->phone_number,
            'address' => $authUser->address,
            'province' => $authUser->province,
            'city' => $authUser->city,
            'district' => $authUser->district,
            'block' => $authUser->block,
            'rt' => $authUser->rt,
            'rw' => $authUser->rw
        ];
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::where('id', Auth::id())->firstOrFail();

        $user->update([
            'password' => bcrypt($this->new_password),
        ]);

        // Reset form input
        $this->reset(['new_password', 'new_password_confirmation']);

        session()->flash('success', 'Password success updated!');
    }

    public function render()
    {
        return view('livewire.pages.tabs.my-account');
    }
}
