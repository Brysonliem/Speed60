<?php

namespace App\Services;

use App\Repositories\TransactionDetailRepository;
use App\Repositories\TransactionRepository;

class TransactionService
{
    protected TransactionRepository $transactionRepository;
    protected TransactionDetailRepository $transactionDetailRepository;

    public function __construct(TransactionRepository $transactionRepository, TransactionDetailRepository $transactionDetailRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->transactionDetailRepository = $transactionDetailRepository;
    }

    public function all()
    {
        return $this->transactionRepository->all();
    }

    public function findByTrxNumber(string $number)
    {
        return $this->transactionRepository->findByTrxNumber($number);
    }

    public function create(array $data)
    {
        return $this->transactionRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->transactionRepository->update($id, $data);
    }

    public function updateByTrxNumber(string $trxNumber, array $data)
    {
        return $this->transactionRepository->updateByTrxNumber($trxNumber, $data);
    }

    public function delete(int $id)
    {
        return $this->transactionRepository->delete($id);
    }

    public function deleteByTransactionNumber(string $trx_number)
    {
        return $this->transactionRepository->deleteByTransactionNumber($trx_number);
    }

    public function createDetail(array $data)
    {
        return $this->transactionDetailRepository->create($data);
    }

    public function getTransactionDetails(?string $status)
    {
        return $this->transactionRepository->getTransactionDetails($status);
    }

    public function countTransactionByUser(int $userId)
    {
        return $this->transactionRepository->countTransactionByUser($userId);
    }

    public function countTransactionByStatusAndUser(string $status, int $userId)
    {
        return $this->transactionRepository->countTransactionByStatusAndUser($status, $userId);
    }

    public function getTransactionsByUser(int $userId, ?string $status = null, bool $exclude = false)
    {
        return $this->transactionRepository->getTransactionsByUser($userId, $status, $exclude);
    }
}
