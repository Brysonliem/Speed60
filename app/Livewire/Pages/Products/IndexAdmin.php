<?php

namespace App\Livewire\Pages\Products;

use App\Services\ProductService;
use App\Livewire\BaseComponent;

class IndexAdmin extends BaseComponent
{
    public $products;

    protected ProductService $productService;

    public function boot(ProductService $productService)
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
        return view('livewire.pages.products.index-admin');
    }
}
