<?php

namespace App\Livewire\Pages;

use App\Services\CartService;
use Livewire\Component;

class Carts extends Component
{
    protected CartService $cartService;

    public $products;
    public $sub_total;
    public $tax;
    public $grand_total;

    public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function calculateTotals()
    {
        // Ambil semua data cart user
        $cartItems = $this->cartService->getAllDataCart();

        $cartTotal = 0;
        foreach ($cartItems as $item) {
            $cartTotal += $item->price * $item->quantity;
        }

        $this->sub_total = $cartTotal;
        $this->tax = $this->sub_total * 0.11;
        $this->grand_total = $this->sub_total + $this->tax;
    }

    public function loadProductCarts()
    {
        $this->products = $this->cartService->getAllDataCart();
        $this->calculateTotals();
    }

    public function mount()
    {
        $this->loadProductCarts();
        $this->calculateTotals();
    }

    public function deleteFromCart(int $product_id)
    {
        $this->cartService->deleteFromCart($product_id);

        session()->flash('success', 'Berhasil menghapus cart');

        $this->loadProductCarts();
    }

    public function redirectToCheckout()
    {
        if ($this->products->count() === 0) {
            session()->flash('error', 'Cart tidak boleh kosong');
            return;
        }

        redirect(route('products.checkout', ['cart' => $this->products[0]->id]));
    }

    public function render()
    {
        return view('livewire.pages.carts');
    }
}
