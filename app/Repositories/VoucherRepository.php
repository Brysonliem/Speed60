<?php

namespace App\Repositories;

use App\Interfaces\VoucherRepositoryInterface;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoucherRepository implements VoucherRepositoryInterface
{
    public function all(?int $limit = null)
    {
        $data = Voucher::latest()->get();

        return $limit ? $data->take($limit)->toArray() : $data->toArray();
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

    public function getVouchersUser(int $user_id,float $grand_total)
    {
        $user = User::findOrFail($user_id);
        $now = now();
        return $user->vouchers()
            ->wherePivot('is_used', false)
            ->where('voucher_minimum_transaction', '<=', $grand_total)
            ->where(function ($q) use ($now) {
                $q->whereNull('voucher_end_date')
                ->orWhere('voucher_end_date', '>=', $now);
            })
            ->get()
            ->toArray();
    }

    public function assign(int $voucherId, int $userId)
    {
        return DB::transaction(function() use ($voucherId, $userId) {
            $voucher = $this->find($voucherId);

            if($voucher->voucher_is_disabled) {
                throw new \Exception('Voucher is disabled');
            }

            return DB::table('user_vouchers')->insert([
                'user_id' => $userId,
                'voucher_id' => $voucherId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }

    public function getAvailableVouchers(?int $limit = null)
    {
        $user = Auth::user();

        // Fetching owned voucher IDs for the authenticated user
        $ownedVoucherIds = $user?->vouchers?->pluck('voucher_id')?->toArray() ?? [];

        $availableVouchers = Voucher::whereNotIn('id', $ownedVoucherIds)->take($limit)->get();
            // ->where('voucher_is_disabled', false)
            // ->whereDate('voucher_start_date', '<=', now())
            // ->where(function ($query) {
            //     $query->whereNull('voucher_end_date')
            //         ->orWhere('voucher_end_date', '>=', now());
            // })
            // ->latest()
            // ->get();

        return $availableVouchers->toArray();
    }

    public function find(int $id)
    {
        return Voucher::findOrFail($id);
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
