<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AddressUsers extends Model
{
    use HasFactory;

    protected $table = 'address_users';

    protected $guarded = [];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // optional
    public function scopeForUser($q, $userId)
    {
        return $q->where('user_id', $userId);
    }
}
