<?php

namespace App\Repositories;

use App\Interfaces\SignupVoucherInfoRepositoryInterface;
use App\Models\SignupVoucherInfo;

class SignupVoucherInfoRepository implements SignupVoucherInfoRepositoryInterface
{

    public function create(array $data)
    {
        return SignupVoucherInfo::create($data);
    }

    public function delete(int $id)
    {
        $signupVoucherInfo = SignupVoucherInfo::findOrFail($id);
        return $signupVoucherInfo->delete();
    }

    public function getAll()
    {
        return SignupVoucherInfo::all();
    }

    public function getByVoucherId(int $voucherId)
    {
        return SignupVoucherInfo::where('voucher_id', $voucherId)->get();
    }
}
