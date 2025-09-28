<?php

namespace App\Livewire\Pages;

use App\Services\ProductService;
use App\Services\ReviewService;
use App\Services\TransactionService;
use App\Services\VoucherService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Admin extends Component
{
    protected ProductService        $productService;
    protected TransactionService    $transactionService;
    protected ReviewService         $reviewService;
    protected VoucherService        $voucherService;

    public int $products_count;
    public int $vouchers_count;
    public int $reviews_count;

    public function boot(ProductService $productService, TransactionService $transactionService, ReviewService $reviewService, VoucherService $voucherService)
    {
        $this->productService       = $productService;
        $this->transactionService   = $transactionService;
        $this->reviewService        = $reviewService;
        $this->voucherService       = $voucherService;
    }

    public function mount()
    {
        $this->loadProductsCount();
        $this->loadVouchersCount();
        $this->loadReviewsCount();
    }

    public function loadProductsCount() 
    {
        $this->products_count = $this->productService->countProducts();
    }

    public function loadVouchersCount() 
    {
        $this->vouchers_count = $this->voucherService->countVouchers();
    }

    public function loadReviewsCount() 
    {
        $this->reviews_count = $this->reviewService->countReviews();
    }

    public function render()
    {
        return view('livewire.pages.admin');
    }
}
