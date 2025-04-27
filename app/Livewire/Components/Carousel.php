<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Carousel extends Component
{

    public array $images = [];

    public function mount(array $images = []) 
    {
        // Redirect default sesuai role

        // Tambahkan dashboard sebagai default breadcrumb pertama
    }


    public function render()
    {
        return view('livewire.components.carousel');
    }
}
