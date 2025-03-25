<?php

namespace App\Livewire\Components;

use Livewire\Component;

class OrderCard extends Component
{

    public $icon;
    public $color;
    public $count;
    public $label;

    public function mount($icon = 'rocket', $color = 'blue', $count = 0, $label = 'Total Orders') 
    {
        $this->icon = $icon;
        $this->color = $color;
        $this->count = $count;
        $this->label = $label;
    }

    public function render()
    {
        return view('livewire.components.order-card');
    }
}
