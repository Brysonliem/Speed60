<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SignupVoucherInfo extends Model
{
    protected $table = 'signup_voucher_info';

    protected $guarded = [];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }
}
