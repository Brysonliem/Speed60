<?php

namespace App\Livewire\Pages\Vouchers;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\VoucherCreateForm;
use App\Services\VoucherService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Create extends Component
{
    public VoucherCreateForm $form;
    protected VoucherService $voucherService;

    public function boot(VoucherService $service)
    {
        $this->voucherService = $service;
        $this->form->start_date = now()->format('Y-m-d');
    }

    public function store()
    {
        $this->form->validate();

        $this->voucherService->createVoucher([
            'voucher_code' => $this->form->code,
            'voucher_name' => $this->form->name,
            'voucher_minimum_transaction' => $this->form->minimum_transaction,
            'voucher_is_disabled' => $this->form->is_disabled,
            'voucher_description' => $this->form->description,
            'voucher_discount_percentage' => $this->form->discount_percentage,
            'voucher_start_date' => $this->form->start_date,
            'voucher_end_date' => $this->form->end_date,
            'voucher_created_by' => Auth::user()->id,
        ]);

        session()->flash('success', 'Voucher created successfully!');

        return $this->redirect(route('vouchers.index'), true);
    }

    public function render()
    {
        return view('livewire.pages.vouchers.create');
    }
}
