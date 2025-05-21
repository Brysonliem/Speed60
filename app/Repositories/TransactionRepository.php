<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all()
    {
        return Transaction::with(['details', 'user'])
            ->where('transaction_user', Auth::user()->id)
            ->get();
    }

    public function findByTrxNumber(string $transactionNumber)
    {
        return DB::table('transactions')
            ->join('transaction_details', 'detail_master', '=', 'transactions.id')
            ->join('product_variants', 'detail_variant', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->join('product_images', function ($join) {
                $join->on('product_images.product_id', '=', 'products.id')
                    ->where('product_images.is_main', true);
            })
            ->select(
                'product_variants.id AS variant_id',
                'purchase_unit',
                'name',
                'unit_per_set',
                'price',
                'current_stock',
                'detail_qty AS quantity',
                'image_path',
                'detail_subtotal'
            )
            ->where('transaction_number', $transactionNumber)
            ->where('transaction_user', Auth::user()->id)
            ->get();
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function update(int $id, array $data)
    {
        $trx = Transaction::findOrFail($id);
        $trx->update($data);
        return $trx;
    }

    public function updateByTrxNumber(string $transactionNumber, array $data)
    {
        $trx = Transaction::where('transaction_number', $transactionNumber)
            ->where('transaction_user', Auth::user()->id);
        $trx?->update($data);
        return $trx;
    }

    public function delete(int $id)
    {
        return DB::transaction(function () use ($id) {
            $trx = Transaction::find($id);
            return $trx?->delete();
        });
    }
}
