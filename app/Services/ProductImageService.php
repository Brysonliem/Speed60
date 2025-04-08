<?php

namespace App\Services;

use App\Interfaces\ProductImageRepositoryInterface;
use App\Repositories\ProductImageRepository;

class ProductImageService
{

    protected ProductImageRepositoryInterface $productImageRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(ProductImageRepositoryInterface $productImageRepository)
    {
        $this->productImageRepository = $productImageRepository;
    }
    
    public function createProductImage(array $data)
    {
        return $this->productImageRepository->create($data);
    }
}
