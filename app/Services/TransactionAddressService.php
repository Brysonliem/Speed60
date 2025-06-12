<?php

namespace App\Services;

use App\Interfaces\TransactionAddressInterface;

class TransactionAddressService
{
    protected TransactionAddressInterface $transactionAddressRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(TransactionAddressInterface $transactionAddressRepository)
    {
        $this->transactionAddressRepository = $transactionAddressRepository;
    }

    public function createAddress(array $data) 
    {
        return $this->transactionAddressRepository->store($data);
    }
}
