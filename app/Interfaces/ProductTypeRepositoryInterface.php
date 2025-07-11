<?php

namespace App\Interfaces;

interface ProductTypeRepositoryInterface
{
    public function all(): array;

    public function findByCode(string $code): ?array;

    public function create(array $data): array;

    public function update(int $id, array $data): array;

    public function delete(int $id): bool;
}
