<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Admin extends Component
{
    public function render()
    {
        return view('livewire.pages.admin');
    }
}
