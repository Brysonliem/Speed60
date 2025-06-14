<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'condition',
        'created_by',
        'product_type_id',
        'material'
    ];

    public function productType(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(ProductImages::class, 'product_id')->where('is_main', true);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Reviews::class, 'product_id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function motorCategories(): BelongsToMany
    {
        return $this->belongsToMany(MotorCategory::class);
    }
}
