<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $user_profile;

    public $user_profile_preview;
    public $newPhoto;

    public function updatedNewPhoto()
    {
        if ($this->newPhoto) {
            // Upload langsung ke folder profile di disk public
            $path = $this->newPhoto->store('profile', 'public');

            // Update user langsung
            $this->user->update([
                'profile_image' => $path,
            ]);

            session()->flash('success', 'Profile picture updated successfully!');
        }
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->user_profile = $this->user->profile_image;
    }

    public function render()
    {
        return view('livewire.pages.profile');
    }
}
