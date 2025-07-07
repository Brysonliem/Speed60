<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewImages extends Model
{
    protected $table = 'review_images';

    public $fillable = ['image_path','review_id'];

    public function review(): BelongsTo
    {
        return $this->belongsTo(Reviews::class, 'review_id');
    }
}
