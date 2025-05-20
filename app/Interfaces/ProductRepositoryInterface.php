<?php

namespace App\Interfaces;

interface ProductRepositoryInterface
{
    public function all();
    public function allProductMaster();
    public function find(int $id);
    public function create(array $data);

    public function getAllType();
    public function update(int $id, array $data);
    public function delete(int $id);

    public function getAllVariants(int $id);
    public function createVariant(array $data);
    public function getVariantById(int $id);
}
