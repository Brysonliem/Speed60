<?php

namespace App\Repositories;

use App\Interfaces\ProductImageRepositoryInterface;
use App\Models\ProductImages;
use Illuminate\Support\Facades\DB;

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

    public function find(int $id)
    {
        $productImage = ProductImages::findOrFail($id);

        return $productImage;
    }

    public function delete(int $id)
    {
        $productImage = ProductImages::findOrFail($id);

        return DB::transaction(fn() => $productImage->delete());
    }

    public function getAllImagesByProductId(int $productId)
    {
        return ProductImages::where('product_id', $productId)->get()->toArray();
    }
}
