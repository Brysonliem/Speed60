<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;
use App\Services\ProductService;
use App\Services\VoucherService;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) {
            $this->vouchers = $this->voucherService->getAllVouchers(3);
        } else {
            $this->vouchers = $this->voucherService->getAvailableVouchers(3); // tanpa filtering user
        }
    }


    public function assignVoucher(int $voucher_id)
    {
        if(!Auth::check()) {
            return redirect()->route('login');
        }

        $this->voucherService->assignVoucher($voucher_id, Auth::user()->id);

        $this->loadVouchers();
        $this->loadProducts();

        session()->flash('voucher_assigned', 'Voucher assigned successfully!');
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
