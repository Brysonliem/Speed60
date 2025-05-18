<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;
use App\Services\VoucherService;
use App\Services\CartService;
use App\Services\ProductService;

class CheckoutProduct extends BaseComponent
{
    protected CartService $cartService;
    protected VoucherService $voucherService;
    protected ProductService $productService;

    public $products;
    public $sub_total;
    public $tax;
    public $grand_total;
    public $vouchers;
    public $selectedVoucher;
    public $discount;

    public function boot(CartService $cartService, VoucherService $voucherService, ProductService $productService)
    {
        $this->cartService = $cartService;
        $this->voucherService = $voucherService;
        $this->productService = $productService;
    }

    public function calculateTotals()
    {
        // Ambil semua data cart user
        // $cartItems = $this->cartService->getAllDataCart();

        $cartTotal = 0;
        foreach ($this->products as $item) {
            $cartTotal += $item->price * $item->quantity;
        }

        $this->sub_total = $cartTotal;
        $this->tax = $this->sub_total * 0.11;
        $this->grand_total = $this->sub_total + $this->tax;
    }

    public function updatedSelectedVoucher()
    {
        $this->applyDiscount();
    }

    public function applyDiscount()
    {
        // Calculate totals first to ensure accurate base amounts
        $this->calculateTotals();

        if (!empty($this->selectedVoucher)) {
            $voucher = $this->voucherService->getVoucherById($this->selectedVoucher);
            if ($voucher) {
                $this->discount = $voucher->voucher_discount_percentage / 100 * $this->grand_total;
                $this->grand_total -= $this->discount;
                session()->flash('success', "Voucher {$voucher->voucher_code} applied successfully!");
            }
        } else {
            $this->discount = 0;
            // Reset grand_total to pre-discount amount
            $this->grand_total = $this->sub_total + $this->tax;
        }
    }

    public function loadProductCarts()
    {
        $this->products = $this
            ->cartService
            ->getAllDataCart()
            ->groupBy('cart_id')
            ->map(fn($item) => $item->first())
            ->values();
    }

    public function loadVouchers()
    {
        $this->vouchers = $this->voucherService->getAllActiveVouchers($this->grand_total);
    }

    public function mount()
    {
        $this->loadProductCarts();
        $this->calculateTotals();
        $this->loadVouchers();
    }

    public function redirectWhenSuccessCheckout()
    {
        foreach ($this->products as $product) {
            $productMaster = $this->productService->getProductById($product->product_id);
            if ($productMaster) {
                $productMaster->current_stock -= $product->quantity;
                $productMaster->save();
            }

            $this->cartService->deleteFromCart($product->product_id);
        }

        return redirect()->route('products.checkout.success');
    }

    public function render()
    {
        return view('livewire.pages.checkout-product');
    }
}
