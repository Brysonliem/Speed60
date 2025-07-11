<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Voucher;
use Carbon\Carbon;
use Livewire\Attributes\Validate;

class VoucherCreateForm extends Form
{
    public ?Voucher $voucher = null;

    #[Validate('required|string|max:255')]
    public string $code = '';

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string')]
    public string $voucher_type = ''; 

    #[Validate('required|numeric|min:0')]
    public float $minimum_transaction = 0;

    #[Validate('required|boolean')]
    public bool $is_disabled = false;

    #[Validate('nullable|string')]
    public ?string $description = null;

    #[Validate('required|numeric|min:0|max:100')]
    public float $discount_percentage = 0;

    #[Validate('required|date')]
    public string $start_date = '';

    #[Validate('nullable|date')]
    public ?string $end_date = null;

    /**
     * Untuk mengisi form saat update misalnya
     */
    public function setVoucher(Voucher $voucher): void
    {
        $this->voucher = $voucher;

        $this->code = $voucher->voucher_code;
        $this->name = $voucher->voucher_name;
        $this->voucher_type = $voucher->voucher_type;
        $this->minimum_transaction = $voucher->voucher_minimum_transaction;
        $this->is_disabled = $voucher->voucher_is_disabled;
        $this->description = $voucher->voucher_description;
        $this->discount_percentage = $voucher->voucher_discount_percentage;
        $this->start_date = $voucher->voucher_start_date;
        $this->end_date = $voucher->voucher_end_date;
    }
}
