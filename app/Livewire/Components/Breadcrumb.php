<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Breadcrumb extends Component
{
    public array $links = [];

    public function mount(array $links = []) 
    {
        // Redirect default sesuai role
        $dashboardRoute = match (Auth::user()->role->level) {
            1 => route('dashboard.superadmin'),
            2 => route('dashboard.admin'),
            default => route('dashboard.user'),
        };

        // Tambahkan dashboard sebagai default breadcrumb pertama
        $this->links = array_merge([
            ['name' => 'Dashboard', 'url' => $dashboardRoute]
        ], $links);
    }

    public function render()
    {
        return view('livewire.components.breadcrumb');
    }
}
