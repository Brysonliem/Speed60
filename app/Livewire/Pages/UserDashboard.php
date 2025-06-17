<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;
use App\Services\ProductService;

class UserDashboard extends BaseComponent
{
    public $products;

    protected ProductService $productService;

    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function loadProducts() 
    {
        $this->products = $this->productService->getAllProducts(null, null, null);
    }

    public function mount()
    {
        $this->loadProducts();
    }
    public function render()
    {
        return view('livewire.pages.user-dashboard');
    }
}
