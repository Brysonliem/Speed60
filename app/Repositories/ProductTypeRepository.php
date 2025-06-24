<?php

namespace App\Repositories;

use App\Interfaces\ProductTypeRepositoryInterface;
use App\Models\ProductType;

class ProductTypeRepository implements ProductTypeRepositoryInterface
{
    public function all(): array
    {
        return ProductType::all()->toArray();
    }

    public function findByCode(string $code): ?array
    {
        // Implement logic to find a product type by its code
        return null;
    }

    public function create(array $data): array
    {
        // Implement logic to create a new product type
        return [];
    }

    public function update(int $id, array $data): array
    {
        // Implement logic to update an existing product type
        return [];
    }

    public function delete(int $id): bool
    {
        // Implement logic to delete a product type
        return true;
    }
}
