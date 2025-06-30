<?php

namespace App\Livewire\Components;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class CartModal extends Component
{
    private CartService $cartService;

    public $open = false;

    public $title;
    public $price;
    public $image;
    public $product_images = [];
    public $productId;
    public $productDescription;
    public $variants = [];

    public $selectedVariant = null;
    public $quantity = 1;

    public function boot(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    #[On('openCartModal')]
    public function openModal($payload)
    {
        $this->title = $payload['title'] ?? '';
        $this->price = $payload['price'] ?? 0;
        $this->image = $payload['image'] ?? '';
        $this->product_images = $payload['product_images'] ?? [];
        $this->productId = $payload['productId'] ?? null;
        $this->productDescription = $payload['productDescription'] ?? '';
        $this->variants = $payload['variants'] ?? [];
        $this->selectedVariant = null;
        $this->quantity = 1;
        $this->open = true;
    }



    public function selectVariant($id)
    {
        $this->selectedVariant = collect($this->variants)->firstWhere('id', $id);
        $this->quantity = 1;
    }

    public function increment()
    {
        if ($this->selectedVariant && $this->quantity < $this->selectedVariant['current_stock']) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (!$this->selectedVariant) {
            session()->flash('error', 'Varian belum dipilih.');
            return;
        }

        if ($this->quantity < 1) {
            session()->flash('error', 'Jumlah tidak boleh kosong.');
            return;
        }

        if ($this->quantity > $this->selectedVariant['current_stock']) {
            session()->flash('error', 'Stok tidak mencukupi.');
            return;
        }
        // Simpan ke keranjang
        $this->cartService->addToCart($this->selectedVariant['id'], $this->quantity);

        // Tutup modal
        $this->open = false;

        $this->dispatch('cart:added', [
            'message' => 'Produk berhasil ditambahkan ke keranjang.'
        ]);

    }


    public function render()
    {
        return view('livewire.components.cart-modal');
    }
}
