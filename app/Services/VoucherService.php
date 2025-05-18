<?php

namespace App\Services;

use App\Repositories\VoucherRepository;

class VoucherService
{
    protected VoucherRepository $voucherRepository;

    public function __construct(VoucherRepository $voucherRepository)
    {
        $this->voucherRepository = $voucherRepository;
    }

    public function createVoucher(array $data)
    {
        return $this->voucherRepository->create($data);
    }

    public function getVoucherById(int $id)
    {
        return $this->voucherRepository->find($id);
    }

    public function updateVoucher(int $id, array $data)
    {
        return $this->voucherRepository->update($id, $data);
    }

    public function activateVoucher(int $id, bool $status)
    {
        return $this->voucherRepository->activate($id, $status);
    }

    public function deleteVoucher(int $id)
    {
        return $this->voucherRepository->delete($id);
    }

    public function getAllVouchers()
    {
        return $this->voucherRepository->all();
    }

    public function getAllActiveVouchers()
    {
        return $this->voucherRepository->getAllActiveVouchers();
    }
}
