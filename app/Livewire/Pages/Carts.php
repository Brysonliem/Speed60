<?php

namespace App\Livewire\Pages;

use App\Services\CartService;
use App\Services\ProductService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Carts extends Component
{
    protected CartService $cartService;
    protected ProductService $productService;
    protected TransactionService $transactionService;

    public $products;
    public $sub_total;
    public $tax;
    public $grand_total;

    public function boot(
        CartService $cartService,
        ProductService $productService,
        TransactionService $transactionService
    ) {
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->transactionService = $transactionService;
    }

    public function calculateTotals()
    {
        // Ambil semua data cart user
        // $cartItems = $this->cartService->getAllDataCart();

        $cartTotal = 0;
        foreach ($this->products as $item) {
            if (!$item->checked) {
                continue;
            }

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

    public function updateQuantity(int $variant_id, int $quantity)
    {
        // Validate quantity
        if ($quantity < 1) {
            session()->flash('error', 'Quantity tidak boleh kurang dari 1');
            return;
        }

        $product = $this->productService->getVariantById($variant_id);
        if (!$product) {
            session()->flash('error', 'Produk tidak ditemukan');
            return;
        }

        if ($quantity > $product->current_stock) {
            session()->flash('error', 'Stok tidak mencukupi');
            return;
        }

        $this->cartService->updateQuantity($variant_id, $quantity);
        $this->loadProductCarts();
    }

    public function mount()
    {
        $this->loadProductCarts();
        $this->calculateTotals();
    }

    public function deleteFromCart(int $variant_id)
    {
        $this->cartService->deleteFromCart($variant_id);

        session()->flash('success', 'Berhasil menghapus cart');

        $this->loadProductCarts();
    }

    public function redirectToCheckout()
    {
        if ($this->products->count() === 0) {
            session()->flash('error', 'Cart tidak boleh kosong');
            return;
        }

        $trxId = DB::transaction(function () {
            $trx = $this->transactionService->create([
                'transaction_user' => Auth::user()->id,
            ]);

            foreach ($this->products as $product) {
                if (!$product->checked) {
                    continue;
                }

                $this->transactionService->createDetail([
                    'detail_master' => $trx->id,
                    'detail_variant' => $product->product_variant_id,
                    'detail_qty' => $product->quantity,
                    'detail_subtotal' => $product->quantity * $product->price,
                ]);
                $this->cartService->deleteFromCart($product->product_variant_id);
            }

            return $trx->transaction_number;
        });

        if (!$trxId) {
            session()->flash('error', 'An unknown error has occured');
            return;
        }

        redirect(route('products.checkout', ['trx' => $trxId]));
    }

    public function toggleChecked(int $index)
    {
        if ($index < 0 || $index >= count($this->products)) {
            return;
        }

        $item = $this->products[$index];
        $status = $item->checked === 1 ? 0 : 1;
        $this->cartService->toggleChecked($item->product_variant_id, $status);

        $this->calculateTotals();
    }

    public function render()
    {
        return view('livewire.pages.carts');
    }
}
