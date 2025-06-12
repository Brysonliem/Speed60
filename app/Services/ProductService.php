<?php

namespace App\Services;

use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductService
{

    protected ProductRepositoryInterface $productRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts(?string $motorCategoryCode = null)
    {
        return $this->productRepository->all($motorCategoryCode);
    }

    public function allProductMaster(?int $limit)
    {
        return $this->productRepository->allProductMaster($limit);
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->find($id);
    }

    public function getAllType()
    {
        return $this->productRepository->getAllType();
    }

    public function createProduct(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->productRepository->create($data);

            return $product;
        });
    }

    public function updateProduct(int $id, array $data)
    {
        return DB::transaction(fn() => $this->productRepository->update($id, $data));
    }

    public function deleteProduct(int $id)
    {
        return $this->productRepository->delete($id);
    }

    public function createVariant(array $data)
    {
        return $this->productRepository->createVariant($data);
    }

    public function getVariantById(int $id)
    {
        return $this->productRepository->getVariantById($id);
    }
}
