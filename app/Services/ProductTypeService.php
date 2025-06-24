<?php

namespace App\Services;

use App\Interfaces\ProductTypeRepositoryInterface;

class ProductTypeService
{
    private ProductTypeRepositoryInterface $productTypeRepository;

    public function __construct(ProductTypeRepositoryInterface $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function index()
    {
        return $this->productTypeRepository->all();
    }
}
