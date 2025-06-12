<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Reviews extends Component
{
    public function render()
    {
        return view('livewire.pages.reviews.index');
    }
}
