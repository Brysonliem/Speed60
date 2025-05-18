<?php

namespace App\Livewire\Pages\Vouchers;

use App\Livewire\Forms\VoucherCreateForm;
use App\Livewire\BaseComponent;
use App\Models\Voucher;
use App\Services\VoucherService;

class Edit extends BaseComponent
{
    protected VoucherService $voucherService;

    public VoucherCreateForm $form;

    public function boot(VoucherService $service)
    {
        $this->voucherService = $service;
    }

    public function mount(Voucher $voucher)
    {
        $this->form->setVoucher($voucher);
    }

    public function update()
    {
        dd($this->form->voucher);
    }

    public function render()
    {
        return view('livewire.pages.vouchers.edit');
    }
}
