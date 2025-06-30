<?php

namespace App\Interfaces;

interface SignupVoucherInfoRepositoryInterface
{
    public function create(array $data);
    public function delete(int $id);
    public function getAll();
    public function getByVoucherId(int $voucherId);
}
