<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;
use App\Models\Product;
use App\Models\Reviews;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ProductDetail extends Component
{
    protected ProductService $productService;
    protected CartService $cartService;
    protected TransactionService $transactionService;

    public $detailProduct;
    public $products;
    public $quantity = 1;
    public $subTotal = 0;
    public $variants;
    public $currentVariant = null;
    public $reviews = [];
    public $mainImage = null;


    #listeners
    protected $listeners = [
        'loadReviews' => 'loadReviews',
        // 'add-to-cart-from-modal' => 'handleAddToCartFromModal',
    ];

    public function boot(
        ProductService $productService,
        CartService $cartService,
        TransactionService $transactionService
    ) {
        $this->productService = $productService;
        $this->cartService = $cartService;
        $this->transactionService = $transactionService;
    }

    public function mount($product)
    {
        $this->products = $this->productService->allProductMaster(5);
        $this->detailProduct = $this->productService->getProductById((int) $product);
        $this->variants = $this->detailProduct->variants;

        // Tidak memilih variant di awal
        $this->currentVariant = null;

        // Inisialisasi quantity
        $this->quantity = 1;
    }

    public function getSubTotalProperty()
    {
        if (!$this->currentVariant) {
            return 0;
        }

        return $this->currentVariant->price * $this->quantity;
    }

    public function loadReviews() 
    {
        if(empty($this->reviews)) {
            $this->reviews = Reviews::all();
        }
    }

    public function incrementQuantity()
    {
        // $this->quantity++;
        if ($this->quantity < $this->currentVariant->current_stock) {
            $this->subTotal = $this->currentVariant->price * ++$this->quantity;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
            $this->subTotal = $this->currentVariant->price * $this->quantity;
        }
    }

    public function setSelectedVariant(int $index)
    {
        if ($index >= 0 && $index < count($this->variants)) {
            $this->currentVariant = $this->variants[$index];
        }

        if ($this->currentVariant) {
            $this->dispatch('variant-selected', $this->currentVariant->color);
        }
    }

    public function addToCart()
    {
        if (!$this->canProceed()) {
            return;
        }

        $this->cartService->addToCart($this->currentVariant->id, $this->quantity);

        session()->flash('success', 'Added to cart!');

        $this->dispatch('card-added');
    }

    #[On('addToCartFromModal')]
    public function handleAddToCartFromModal($payload)
    {
        dd("CALLED");
        $variantId = $payload['variantId'];
        $quantity = $payload['quantity'];

        // Ambil variant
        $variant = $this->variants->firstWhere('id', $variantId);
        if (!$variant) {
            session()->flash('error', 'Variant not found.');
            return;
        }

        // Simpan ke cart
        if ($quantity > $variant->current_stock) {
            session()->flash('error', 'Stok tidak mencukupi.');
            return;
        }

        $this->cartService->addToCart($variant->id, $quantity);
        session()->flash('success', 'Produk ditambahkan ke keranjang.');

        $this->dispatch('cart-updated');
    }

    private function canProceed()
    {
        if ($this->quantity === 0) {
            session()->flash('error', 'Quantity cannot be zero');
            return false;
        }

        if ($this->quantity > $this->currentVariant->current_stock) {
            session()->flash('error', 'Quantity exceeds current stock');
            return false;
        }

        return true;
    }

    public function purchaseNow()
    {
        if (!$this->canProceed()) {
            return;
        }

        $trxId = DB::transaction(function () {
            // DB::statement('LOCK TABLES transactions WRITE');

            $trx = $this->transactionService->create([
                'transaction_user' => Auth::user()->id
            ]);

            $this->transactionService->createDetail([
                'detail_master' => $trx->id,
                'detail_variant' => $this->currentVariant->id,
                'detail_qty' => $this->quantity,
                'detail_subtotal' => $this->quantity * $this->currentVariant->price,
                'product_id' => $this->detailProduct->id
            ]);

            // DB::statement('UNLOCK TABLES');

            return $trx->transaction_number;
        });

        if (!$trxId) {
            session()->flash('error', 'An unknown error has occured');
            return;
        }

        redirect(route('products.checkout', ['trx' => $trxId]));
    }

    public function render()
    {
        return view('livewire.pages.product-detail');
    }
}
