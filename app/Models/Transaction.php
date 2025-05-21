<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $guarded = [
        'transaction_number'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $transaction->transaction_number = self::generateTransactionNumber();
        });
    }

    private static function generateTransactionNumber()
    {
        return DB::transaction(function () {
            $lastNumber = DB::table('transactions')
                ->lockForUpdate()
                ->latest()
                ->value('transaction_number');

            $nextNumber = 1;
            if ($lastNumber) {
                $nextNumber = intval(substr($lastNumber, strlen(self::getTrxPrefix()))) + 1;
            }

            return self::getTrxPrefix() . str_pad($nextNumber, 10, '0', STR_PAD_LEFT);
        });
    }

    private static function getTrxPrefix()
    {
        return "TRX";
    }

    public function details(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, 'detail_master');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'transaction_user');
    }
}
