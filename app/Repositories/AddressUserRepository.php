<?php

namespace App\Repositories;

use App\Interfaces\AddressUserRepositoryInterface;
use App\Models\AddressUsers;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class AddressUserRepository implements AddressUserRepositoryInterface
{
    public function getByUser(int $userId): Collection
    {
        return AddressUsers::query()
            ->where('user_id', $userId)
            ->orderByDesc('is_main')
            ->latest()
            ->get();
    }

    public function getMainForUser(int $userId): ?AddressUsers
    {
        return AddressUsers::query()
            ->where('user_id', $userId)
            ->where('is_main', true)
            ->first();
    }

    public function firstForUser(int $userId): ?AddressUsers
    {
        return AddressUsers::query()
            ->where('user_id', $userId)
            ->first();
    }

    public function findByIdForUser(int $id, int $userId): ?AddressUsers
    {
        return AddressUsers::query()
            ->where('user_id', $userId)
            ->where('id', $id)
            ->first();
    }

    public function findByIdForUserOrFail(int $id, int $userId): AddressUsers
    {
        $m = $this->findByIdForUser($id, $userId);
        if (!$m) {
            throw (new ModelNotFoundException())->setModel(AddressUsers::class, $id);
        }
        return $m;
    }

    public function create(array $data): AddressUsers
    {
        return AddressUsers::create($data);
    }

    public function update(AddressUsers $address, array $data): bool
    {
        return $address->update($data);
    }

    public function delete(AddressUsers $address): ?bool
    {
        return $address->delete();
    }

    public function unsetMainForUser(int $userId): int
    {
        return AddressUsers::query()
            ->where('user_id', $userId)
            ->where('is_main', true)
            ->update(['is_main' => false]);
    }
}
