<?php

namespace App\Interfaces;

use App\Models\AddressUsers;
use Illuminate\Database\Eloquent\Collection;

interface AddressUserRepositoryInterface
{
    public function getByUser(int $userId): Collection;
    public function getMainForUser(int $userId): ?AddressUsers;
    public function firstForUser(int $userId): ?AddressUsers;

    public function findByIdForUser(int $id, int $userId): ?AddressUsers;
    public function findByIdForUserOrFail(int $id, int $userId): AddressUsers;

    public function create(array $data): AddressUsers;
    public function update(AddressUsers $address, array $data): bool;
    public function delete(AddressUsers $address): ?bool;

    public function unsetMainForUser(int $userId): int;
}