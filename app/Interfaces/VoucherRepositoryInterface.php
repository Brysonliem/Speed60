<?php

namespace App\Interfaces;

interface VoucherRepositoryInterface
{
    public function all(?int $limit = null);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function activate(int $id, bool $status);
    public function delete(int $id);
}
