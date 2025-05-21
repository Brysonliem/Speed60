<?php

namespace App\Interfaces;

interface TransactionDetailRepositoryInterface
{
    public function all();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
