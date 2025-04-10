<?php

namespace App\Livewire\Pages\Products;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\CartCreateForm;
use App\Services\CartService;
use App\Services\ProductService;
use Livewire\Attributes\On;

class Index extends BaseComponent
{

    public $products;

    protected ProductService $productService;

    public CartCreateForm $cartForm;

    public function boot(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
    }

    public function loadProducts() 
    {
        $this->products = $this->productService->getAllProducts();
    }

    public function mount()
    {
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.pages.products.index');
    }
}
