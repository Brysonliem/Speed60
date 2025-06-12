<?php

namespace App\Repositories;

use App\Interfaces\TransactionAddressInterface;
use App\Models\TransactionAddress;

class TransactionAddressRepository implements TransactionAddressInterface
{
    public function store(array $data)
    {
        return TransactionAddress::create($data);
    }
}
