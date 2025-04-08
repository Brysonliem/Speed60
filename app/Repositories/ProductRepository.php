<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::latest()
            ->with([
                'productType', 
                'productImages' => function ($query) {
                    $query->where('is_main', 1);
                },
            ])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating_point')
            ->get()
            ->toArray();
    }

    public function find(int $id)
    {
        return Product::with(['productType', 'productImages', 'reviews'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating_point')
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        $product = Product::create($data);

        return $product;
    }

    public function update(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function delete(int $id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }
}
