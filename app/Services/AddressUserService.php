<?php

namespace App\Services;

use App\Interfaces\AddressUserRepositoryInterface;
use App\Models\AddressUsers;

class AddressUserService
{
    public function __construct(
        private AddressUserRepositoryInterface $repo
    ) {}

    /** List untuk view (sudah di-map ke array) */
    public function listForUser(int $userId): array
    {
        $query = $this->repo->getByUser($userId)
            ->map(fn(AddressUsers $a) => $this->map($a))
            ->values()
            ->all();
        return $query;
    }

    /** ID default: main jika ada, else first, else null */
    public function defaultSelectedId(int $userId): ?int
    {
        $m = $this->repo->getMainForUser($userId) ?? $this->repo->firstForUser($userId);
        return $m?->id;
    }

    /** Create/Update + handle is_main tunggal + fallback main */
    public function save(int $userId, array $data): AddressUsers
    {
        $data['user_id'] = $userId;
        $isMain = (bool)($data['is_main'] ?? false);

        if ($isMain) {
            $this->repo->unsetMainForUser($userId);
        }

        if (!empty($data['id'])) {
            $model = $this->repo->findByIdForUserOrFail((int)$data['id'], $userId);
            $this->repo->update($model, $data);
            $model->refresh();
        } else {
            $model = $this->repo->create($data);
        }

        // pastikan ada satu main
        if (!$this->repo->getMainForUser($userId)) {
            $this->repo->unsetMainForUser($userId);
            $this->repo->update($model, ['is_main' => true]);
            $model->refresh();
        }

        return $model;
    }

    /** Delete + promote main bila perlu */
    public function delete(int $userId, int $id): void
    {
        $model = $this->repo->findByIdForUserOrFail($id, $userId);
        $wasMain = (bool)$model->is_main;

        $this->repo->delete($model);

        if ($wasMain) {
            $next = $this->repo->firstForUser($userId);
            if ($next) {
                $this->repo->unsetMainForUser($userId);
                $this->repo->update($next, ['is_main' => true]);
            }
        }
    }

    /** Set main tunggal */
    public function setMain(int $userId, int $id): void
    {
        $model = $this->repo->findByIdForUserOrFail($id, $userId);
        $this->repo->unsetMainForUser($userId);
        $this->repo->update($model, ['is_main' => true]);
    }

    /** Map model -> array (untuk Blade/Alpine) */
    public function map(AddressUsers $a): array
    {
        return [
            'id' => $a->id,
            'title_address' => $a->title_address,
            'recipients_name' => $a->recipients_name,
            'recipients_phone' => $a->recipients_phone,
            'address' => $a->address,
            'additional_address' => $a->additional_address,
            'city' => $a->city,
            'province' => $a->province,
            'district' => $a->district,
            'subdistrict' => $a->subdistrict,
            'postal_code' => $a->postal_code,
            'is_main' => (bool)$a->is_main,
        ];
    }
}