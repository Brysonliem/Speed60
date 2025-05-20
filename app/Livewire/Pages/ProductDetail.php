<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;
use App\Models\Product;
use App\Services\CartService;
use App\Services\ProductService;

class ProductDetail extends BaseComponent
{
    protected ProductService $productService;
    protected CartService $cartService;

    public $detailProduct;
    public $products;
    public $quantity = 1;
    public $subTotal = 0;
    public $variants;
    public $currentVariant;

    public function boot(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }

    public function mount($product)
    {
        $this->products = $this->productService->allProductMaster();
        $this->detailProduct = $this->productService->getProductById((int) $product);
        $this->variants = $this->detailProduct->variants;
        $this->currentVariant = $this->variants[0];
        $this->subTotal = $this->currentVariant->price * $this->quantity;
    }

    public function incrementQuantity()
    {
        // $this->quantity++;
        if ($this->quantity < $this->currentVariant->current_stock) {
            $this->subTotal = $this->currentVariant->price * ++$this->quantity;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->subTotal = $this->currentVariant->price * $this->quantity;
        }
    }

    public function redirectCheckout()
    {
        if (!$this->canProceed()) {
            return;
        }

        return redirect()->route('products.checkout');
    }

    public function setSelectedVariant(int $index)
    {
        if ($index >= 0 && $index < count($this->variants)) {
            $this->currentVariant = $this->variants[$index];
        }
    }

    public function addToCart()
    {
        if (!$this->canProceed()) {
            return;
        }

        $this->cartService->addToCart($this->currentVariant->id, $this->quantity);

        session()->flash('success', 'Added to cart!');

        $this->dispatch('card-added');
    }

    private function canProceed()
    {
        if ($this->quantity === 0) {
            session()->flash('error', 'Quantity cannot be zero');
            return false;
        }

        if ($this->quantity > $this->currentVariant->current_stock) {
            session()->flash('error', 'Quantity exceeds current stock');
            return false;
        }

        return true;
    }

    public function render()
    {
        return view('livewire.pages.product-detail');
    }
}
