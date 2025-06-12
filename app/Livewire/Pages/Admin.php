<?php

namespace App\Livewire\Pages;

use App\Services\ProductService;
use App\Services\ReviewService;
use App\Services\TransactionService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Admin extends Component
{
    protected ProductService $productService;
    protected TransactionService $transactionService;
    protected ReviewService $reviewService;

    public int $products_count;
    public int $vouchers_count;
    public int $reviews_count;

    public function boot(ProductService $productService, TransactionService $transactionService, ReviewService $reviewService)
    {
        $this->productService = $productService;
        $this->transactionService = $transactionService;
        $this->reviewService = $reviewService;
    }

    public function render()
    {
        return view('livewire.pages.admin');
    }
}
