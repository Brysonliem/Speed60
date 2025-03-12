<?php

namespace App\Livewire\Components;

use Livewire\Component;

class CheckedProduct extends Component
{

    public $productImage;
    public $productName;
    public $productPrice;
    public $quantity;

    public function render()
    {
        return view('livewire.components.checked-product');
    }
}
