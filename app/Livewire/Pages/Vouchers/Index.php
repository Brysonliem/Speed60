<?php

namespace App\Livewire\Pages\Vouchers;

use App\Livewire\BaseComponent;
use App\Models\Voucher;
use App\Services\VoucherService;

class Index extends BaseComponent
{
    public $vouchers;

    protected VoucherService $voucherService;

    public function boot(VoucherService $service)
    {
        $this->voucherService = $service;
    }

    public function mount()
    {
        $this->loadVouchers();
    }

    public function loadVouchers()
    {
        // Load vouchers from the database
        $this->vouchers = Voucher::all();
    }

    public function deleteVoucher($voucherId)
    {
        $this->voucherService->deleteVoucher($voucherId);
        $this->loadVouchers();
        session()->flash('success', 'Voucher deleted successfully!');
    }

    public function render()
    {
        return view('livewire.pages.vouchers.index');
    }
}
