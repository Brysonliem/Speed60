<?php

namespace App\Repositories;

use App\Interfaces\VoucherRepositoryInterface;
use App\Models\Voucher;

class VoucherRepository implements VoucherRepositoryInterface
{
    public function all()
    {
        return Voucher::latest()->get()->toArray();
    }

    public function getAllActiveVouchers(?float $grandTotal)
    {
        $now = now();
        return Voucher::where('voucher_is_disabled', false)
            ->where('voucher_minimum_transaction', '<=', $grandTotal)
            ->whereDate('voucher_start_date', '<=', $now)
            ->where(function ($q) use ($now) {
                $q->whereNull('voucher_end_date')            // never expires
                    ->orWhere('voucher_end_date', '>=', $now); // still valid
            })
            ->latest()
            ->get()
            ->toArray();
    }

    public function find(int $id)
    {
        return Voucher::find($id);
    }

    public function create(array $data)
    {
        return Voucher::create($data);
    }

    public function update(int $id, array $data)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->update($data);
        return $voucher;
    }

    public function activate(int $id, bool $status)
    {
        return $this->update($id, ['is_active' => $status]);
    }

    public function delete(int $id)
    {
        return Voucher::where('id', $id)->delete();
    }
}
