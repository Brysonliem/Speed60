<?php

namespace App\Interfaces;

interface VoucherRepositoryInterface
{
    public function all(?int $limit = null);
    public function getAvailableVouchers(?int $limit = null);
    public function getVouchersUser(int $user_id, float $grand_total);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function activate(int $id, bool $status);
    public function delete(int $id);
    public function assign(int $voucherId, int $userId);
}
