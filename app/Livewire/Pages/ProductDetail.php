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

class ProductDetail extends BaseComponent
{
    protected ProductService $productService;
    protected CartService $cartService;
    protected TransactionService $transactionService;

    public $detailProduct;
    public $products;
    public $quantity = 1;
    public $subTotal = 0;
    public $variants;
    public $currentVariant;
    public $reviews = [];

    #listeners
    protected $listeners = ['loadReviews' => 'loadReviews'];

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
        $this->currentVariant = $this->variants[0];
        $this->subTotal = $this->currentVariant->price * $this->quantity;
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
