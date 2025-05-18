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

    public function boot(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }

    public function mount($product)
    {
        $this->products = $this->productService->getAllProducts();
        $this->detailProduct = $this->productService->getProductById((int) $product);
        $this->subTotal = $this->detailProduct->price * $this->quantity;
    }

    public function incrementQuantity()
    {
        // $this->quantity++;
        if ($this->quantity < $this->detailProduct->current_stock) {
            $this->subTotal = $this->detailProduct->price * ++$this->quantity;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->subTotal = $this->detailProduct->price * $this->quantity;
        }
    }

    public function redirectCheckout()
    {
        return redirect()->route('products.checkout');
    }

    public function addToCart()
    {
        $this->cartService->addToCart($this->detailProduct->id, $this->quantity);

        session()->flash('success', 'Added to cart!');

        $this->dispatch('card-added');
    }

    public function render()
    {
        return view('livewire.pages.product-detail');
    }
}
