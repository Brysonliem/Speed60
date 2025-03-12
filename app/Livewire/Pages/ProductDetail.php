<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;

class ProductDetail extends BaseComponent
{

    public $product;

    // public function mount($id)
    // {
    //     $this->product = Product
    // }

    public function redirectCheckout()
    {
        return redirect()->route('products.checkout');
    }

    public function render()
    {
        return view('livewire.pages.product-detail');
    }
}
