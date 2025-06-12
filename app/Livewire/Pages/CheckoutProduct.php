<?php

namespace App\Livewire\Pages;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\TransactionAddressForm;
use App\Models\Transaction;
use App\Services\TransactionAddressService;
use App\Services\VoucherService;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;

class CheckoutProduct extends BaseComponent
{
    #[Url]  
    public $trx = '';

    protected TransactionService $transactionService;
    protected TransactionAddressService $transactionAddressService;
    protected VoucherService $voucherService;
    protected ProductService $productService;

    public TransactionAddressForm $address_form;
    public $products;
    public $sub_total;
    public $tax;
    public $grand_total;
    public $vouchers;
    public $selectedVoucher;
    public $voucher;
    public $discount;

    public function boot(
        TransactionService $transactionService, 
        VoucherService $voucherService, 
        ProductService $productService,
        TransactionAddressService $transactionAddressService
    )
    {
        $this->transactionService = $transactionService;
        $this->voucherService = $voucherService;
        $this->productService = $productService;
        $this->transactionAddressService = $transactionAddressService;
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
            $this->voucher = $this->voucherService->getVoucherById($this->selectedVoucher);
            if ($this->voucher) {
                $this->discount = $this->voucher->voucher_discount_percentage / 100 * $this->grand_total;
                $this->grand_total -= $this->discount;
                session()->flash('success', "Voucher {$this->voucher->voucher_code} applied successfully!");
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
            ->transactionService
            ->findByTrxNumber($this->trx);
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
        $this->checkout();

        return redirect()->route('products.checkout.success');
    }

    public function checkout()
    {
        $this->savingVariant($this->products);
        $this->createTransactionAddress();
        $this->updateTransaction($this->trx);
    }

    public function savingVariant($products)
    {
        foreach ($this->products as $product) {
            $variant = $this->productService->getVariantById($product->variant_id);
            if ($variant) {
                if ($variant->purchase_unit === 'set') {
                    $variant->current_stock -= $product->quantity * $variant->unit_per_set;
                } else {
                    $variant->current_stock -= $product->quantity;
                }
                $variant->save();
            }
        }
    }

    private function createTransactionAddress(): void
    {
        $current_transaction = Transaction::where('transaction_number', '=', $this->trx)->first();
        // TODO : ADA BUG, BAGIAN ADDRESS KEBAWAH GAK MASUK DATANYA.

        $this->transactionAddressService->createAddress([
            'transaction_id' => $current_transaction->id,
            'first_name'     => $this->address_form->first_name,
            'last_name'      => $this->address_form->last_name,
            // 'company_name'   => $this->address_form->company_name,
            'address'        => $this->address_form->address,
            'province'       => $this->address_form->province,
            'city'           => $this->address_form->city,
            'postal_code'    => $this->address_form->postal_code,
            'email'          => $this->address_form->email,
            'phone'          => $this->address_form->phone,
            'description'    => $this->address_form->description,
        ]);
    }


    private function updateTransaction(string $transaction_number)
    {
        $data = [
            // 'transaction_status' => 'paid',
            'sub_total' => $this->sub_total,
            'shipping_price' => 0, // default before integration
            'tax_price' => $this->tax,
            'discount_price' => $this->discount,
            'grand_total' => $this->grand_total,
        ];

        if ($this->voucher) {
            $data['voucher_id'] = $this->voucher->id;
        }

        $this->transactionService->updateByTrxNumber($transaction_number, $data);
    }


    public function cancelTransaction()
    {
        DB::transaction(function() {
            $this->transactionService->deleteByTransactionNumber($this->trx);
        });

        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.pages.checkout-product');
    }
}
