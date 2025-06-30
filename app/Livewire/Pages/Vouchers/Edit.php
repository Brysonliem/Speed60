<?php

namespace App\Livewire\Pages\Vouchers;

use App\Livewire\Forms\VoucherCreateForm;
use App\Livewire\BaseComponent;
use App\Models\Voucher;
use App\Services\VoucherService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Edit extends Component
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
        // $this->form->validate();

        $voucher = $this->form->voucher;

        $this->voucherService->updateVoucher($voucher->id, [
            'voucher_code' => $this->form->code,
            'voucher_name' => $this->form->name,
            'voucher_type' => $this->form->voucher_type,
            'voucher_minimum_transaction' => $this->form->minimum_transaction,
            'voucher_is_disabled' => $this->form->is_disabled,
            'voucher_description' => $this->form->description,
            'voucher_discount_percentage' => $this->form->discount_percentage,
            'voucher_start_date' => $this->form->start_date,
            'voucher_end_date' => $this->form->end_date,
        ]);

        session()->flash('success', 'Voucher updated successfully!');

        return $this->redirect(route('vouchers.index'), true);
    }


    public function render()
    {
        return view('livewire.pages.vouchers.edit');
    }
}
