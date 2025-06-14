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

    public function getDetailTransactions(?string $filter)
    {
        $query = DB::table('transactions as tx')
            ->select([
                'tx.id',
                'tx.transaction_number',
                DB::raw('UPPER(tx.transaction_status) as transaction_status'),
                'tx.sub_total',
                'tx.shipping_price',
                'tx.discount_price',
                'tx.grand_total',
                'u.name as buyer_name',
                DB::raw('CASE WHEN tx.voucher_id IS NOT NULL THEN true ELSE false END as has_voucher'),
                DB::raw('SUM(td.detail_qty) as total_quantity'),
                'tx.proceed_at',
            ])
            ->join('users as u', 'u.id', '=', 'tx.transaction_user')
            ->leftJoin('vouchers as vc', 'vc.id', '=', 'tx.voucher_id')
            ->join('transaction_details as td', 'td.detail_master', '=', 'tx.id')
            ->where('tx.proceed_at','!=','null')
            ->groupBy(
                'tx.id',
                'tx.transaction_number',
                'tx.transaction_status',
                'tx.sub_total',
                'tx.shipping_price',
                'tx.discount_price',
                'tx.grand_total',
                'u.name',
                'tx.voucher_id',
                'tx.proceed_at'
            );

        if($filter) {
            $query->where('tx.transaction_status','=',$filter);
        }

        return $query->get()->toArray();
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

    public function deleteByTransactionNumber(string $trx_number)
    {
        return DB::transaction(function() use ($trx_number) {
            $trx = Transaction::where('transaction_number', '=',$trx_number)->first();

            return $trx?->delete();
        });
    }
}
