<?php

namespace App\Livewire\Components;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Component;

class CartModal extends Component
{
    public $open = false;
    public $product = null;
    public $selectedVariant = null;
    public $quantity = 1;

    protected $listeners = ['openCartModal' => 'open'];

    public function open($product)
    {
        $this->product = $product;
        $this->selectedVariant = null;
        $this->quantity = 1;
        $this->open = true;
    }

    public function selectVariant($variantId)
    {
        $this->selectedVariant = collect($this->product['variants'])->firstWhere('id', $variantId);
        $this->quantity = 1;
    }

    public function incrementQuantity()
    {
        if ($this->quantity < ($this->selectedVariant['current_stock'] ?? 1)) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        // logic add to cart
        $this->dispatchBrowserEvent('cart-added');
        $this->reset(['open', 'product', 'selectedVariant', 'quantity']);
    }
    
    public function render()
    {
        return view('livewire.components.cart-modal');
    }
}
