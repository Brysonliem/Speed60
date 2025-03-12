<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Carts extends Component
{

    public $products;

    public function mount()
    {
        $this->products = [
            ['id' => 1, 'image' => asset('images/product.png'), 'name' => "Baut pengencang body", 'price' => 40000, 'quantity' => 20]
        ];
    }

    public function render()
    {
        return view('livewire.pages.carts');
    }
}
