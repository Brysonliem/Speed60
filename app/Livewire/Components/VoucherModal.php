<?php

namespace App\Livewire\Components;

use App\Livewire\Forms\VoucherModalCreateForm;
use App\Models\Voucher;
use App\Services\SignupVoucherInfoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class VoucherModal extends Component
{
    public $show = true;
    public $disabled = false;

    public VoucherModalCreateForm $form;
    
    private SignupVoucherInfoService $signupVoucherInfoService;

    public function boot(SignupVoucherInfoService $signupVoucherInfoService)
    {
        $this->signupVoucherInfoService = $signupVoucherInfoService;
    }

    public function mount()
    {
        $this->show = session()->has('show_promo_modal');
    }

    public function close()
    {
        $this->show = false;
    }

    public function submit()
    {
        $signUpVoucher = Voucher::where('voucher_code', 'DISC10')
            ->where('voucher_is_disabled', 0)
            ->first();

        $this->signupVoucherInfoService->createSignupVoucherInfo([
            'email' => $this->form->email,
            'first_name' => $this->form->first_name,
            'last_name' => $this->form->last_name,
            'phone_number' => $this->form->phone,
            'user_id' => Auth::user()->id,
            'voucher_id' => $signUpVoucher->id
        ]);

        // this has to be replaced with the service
        DB::table('user_vouchers')->insert([
            'user_id' => Auth::user()->id,
            'voucher_id' => $signUpVoucher->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->form->reset();

        $this->disabled = true;

        return back()->with('success', 'Voucher Claimed!');
    }

    public function render()
    {
        return view('livewire.components.voucher-modal');
    }
}
