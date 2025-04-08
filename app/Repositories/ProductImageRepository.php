<?php

namespace App\Repositories;

use App\Interfaces\ProductImageRepositoryInterface;
use App\Models\ProductImages;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    public function create(array $data)
    {
        return ProductImages::create($data);
    }

    public function update(int $id, array $data)
    {
        $productImage = ProductImages::findOrFail($id);
        $productImage->update($data);
        return $productImage;
    }

    public function delete(int $id)
    {
        $productImage = ProductImages::findOrFail($id);
        return $productImage->delete();
    }
}
