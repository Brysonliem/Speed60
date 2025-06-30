<?php

namespace App\Services;

use App\Interfaces\SignupVoucherInfoRepositoryInterface;

class SignupVoucherInfoService
{
    private SignupVoucherInfoRepositoryInterface $signupVoucherInfoRepository;
    
    public function __construct(SignupVoucherInfoRepositoryInterface $signupVoucherInfoRepository)
    {
        $this->signupVoucherInfoRepository = $signupVoucherInfoRepository;
    }

    public function createSignupVoucherInfo(array $data)
    {
        return $this->signupVoucherInfoRepository->create($data);
    }
}
