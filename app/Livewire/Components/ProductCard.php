<?php

namespace App\Livewire\Components;

use Livewire\Component;

class ProductCard extends Component
{

    public $product;
    public $image;
    public $title;
    public $subtitle;
    public $price;

    public $discount_percentage;
    public $rating;
    public $reviews;

    public $variants;

    public function mount($product)
    {
        $this->product = $product;

        $this->variants = $product['variants'] ?? [];
    }
    
    public function render()
    {
        return view('livewire.components.product-card');
    }
}
