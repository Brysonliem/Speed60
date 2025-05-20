<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionDetail extends Model
{
    protected $guarded = [];

    public function master(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'detail_master');
    }

    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'detail_variant');
    }
}
