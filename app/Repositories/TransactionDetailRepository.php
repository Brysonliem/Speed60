<?php

namespace App\Repositories;

use App\Interfaces\TransactionDetailRepositoryInterface;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionDetailRepository implements TransactionDetailRepositoryInterface
{
    public function all()
    {
        return TransactionDetail::with('master')
            ->where('transaction_user', Auth::user()->id)
            ->get()
            ->toArray();
    }

    public function create(array $data)
    {
        return TransactionDetail::create($data);
    }

    public function update(int $id, array $data)
    {
        $det = TransactionDetail::findOrFail($id);
        $det->update($data);
        return $det;
    }

    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            $trx = TransactionDetail::find($id);
            return $trx?->delete();
        });
    }
}
