<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class CheckoutSuccess extends Component
{

    public function redirectToDashboardUser()
    {
        return redirect()->route('dashboard.user');
    }

    public function render()
    {
        return view('livewire.pages.checkout-success');
    }
}
