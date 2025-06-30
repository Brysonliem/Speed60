<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;
use App\Services\ProductService;
use App\Services\VoucherService;

class UserDashboard extends BaseComponent
{
    public $products;
    public $vouchers;

    protected ProductService $productService;
    private VoucherService $voucherService;

    public function boot(ProductService $productService, VoucherService $voucherService)
    {
        $this->productService = $productService;
        $this->voucherService = $voucherService;
    }

    public function loadProducts() 
    {
        $this->products = $this->productService->getAllProducts(null, null, null);
    }

    public function loadVouchers()
    {
        $this->vouchers = $this->voucherService->getAllVouchers(3);
    }

    public function mount()
    {
        $this->loadProducts();
        $this->loadVouchers();
    }

    public function render()
    {
        return view('livewire.pages.user-dashboard');
    }
}
