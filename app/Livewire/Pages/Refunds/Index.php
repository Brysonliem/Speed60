<?php

namespace App\Livewire\Pages\Refunds;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.refunds.index');
    }
}
