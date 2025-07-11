<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function deleteByTransactionNumber(string $trx_number);
    public function getTransactionDetails(?string $status);
    public function countTransactionByUser(int $userId);
    public function countTransactionByStatusAndUser(string $status, int $userId);
    public function getTransactionsByUser(int $userId, ?string $status = null, bool $exclude = false);
}
