<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carts extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'product_variant_id',
        'quantity',
    ];

    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_variant_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
}
