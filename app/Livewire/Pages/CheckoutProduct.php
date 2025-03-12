<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;

class CheckoutProduct extends BaseComponent
{

    public function redirectWhenSuccessCheckout()
    {
        return redirect()->route('products.checkout.success');
    }

    public function render()
    {
        return view('livewire.pages.checkout-product');
    }
}
