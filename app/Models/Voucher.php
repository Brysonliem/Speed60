<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    protected $guarded = [];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'voucher_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_voucher')
                    ->withTimestamps()
                    ->withPivot('used_at');
    }

    public function signupVoucherInfo(): HasMany
    {
        return $this->hasMany(SignupVoucherInfo::class, 'voucher_id');
    }
}
