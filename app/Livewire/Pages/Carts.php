<?php

namespace App\Livewire\Pages;

use App\Services\CartService;
use App\Services\ProductService;
use Livewire\Component;

class Carts extends Component
{
    protected CartService $cartService;
    protected ProductService $productService;

    public $products;
    public $sub_total;
    public $tax;
    public $grand_total;

    public function boot(CartService $cartService, ProductService $productService)
    {
        $this->cartService = $cartService;
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

    public function loadProductCarts()
    {
        // TODO: clean this up
        $this->products = $this
            ->cartService
            ->getAllDataCart()
            ->groupBy('cart_id')
            ->map(fn($item) => $item->first())
            ->values();

        $this->calculateTotals();
    }

    public function updateQuantity(int $product_id, int $quantity)
    {
        // Validate quantity
        if ($quantity < 1) {
            session()->flash('error', 'Quantity tidak boleh kurang dari 1');
            return;
        }

        $product = $this->productService->getProductById($product_id);
        if (!$product) {
            session()->flash('error', 'Produk tidak ditemukan');
            return;
        }

        if ($quantity > $product->current_stock) {
            session()->flash('error', 'Stok tidak mencukupi');
            return;
        }

        $this->cartService->updateQuantity($product_id, $quantity);
        $this->loadProductCarts();
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

        redirect(route('products.checkout', ['cart' => $this->products[0]->cart_id]));
    }

    public function render()
    {
        return view('livewire.pages.carts');
    }
}
