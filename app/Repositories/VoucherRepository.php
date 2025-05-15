<?php

namespace App\Repositories;

use App\Interfaces\VoucherRepositoryInterface;
use App\Models\Voucher;

class VoucherRepository implements VoucherRepositoryInterface
{
    public function all()
    {
        return Voucher::latest()->get()->toArray();
    }

    public function find(int $id)
    {
        return Voucher::find($id);
    }

    public function create(array $data)
    {
        return Voucher::create($data);
    }

    public function update(int $id, array $data)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->update($data);
        return $voucher;
    }

    public function activate(int $id, bool $status)
    {
        return $this->update($id, ['is_active' => $status]);
    }

    public function delete(int $id)
    {
        return Voucher::where('id', $id)->delete();
    }
}
