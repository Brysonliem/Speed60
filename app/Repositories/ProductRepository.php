<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductVariant;

class ProductRepository implements ProductRepositoryInterface
{
    // TODO: clean up these 2 methods below to avoid redundancy
    public function all()
    {
        return Product::latest()
            ->with([
                'variants',
                'productType',
                'productImages' => function ($query) {
                    $query->where('is_main', 1);
                },
            ])
            ->withCount('reviews')
            ->withCount('variants')
            ->withAvg('reviews', 'rating_point')
            ->having('variants_count', '>', 0) // a product cannot be displayed if it doesn't have any variant
            ->get()
            ->toArray();
    }

    public function allProductMaster()
    {
        return Product::latest()
            ->with([
                'variants',
                'productType',
                'productImages' => function ($query) {
                    $query->where('is_main', 1);
                },
            ])
            ->withCount('reviews')
            ->withCount('variants')
            ->withAvg('reviews', 'rating_point')
            ->having('variants_count', '>', 0) // a product cannot be displayed if it doesn't have any variant
            ->groupBy('id', 'name', 'description', 'condition', 'created_by', 'product_type_id', 'created_at', 'updated_at')
            ->get()
            ->toArray();
    }

    public function getAllType()
    {
        return ProductType::get()->toArray();
    }

    public function find(int $id)
    {
        return Product::with(['productType', 'productImages', 'reviews', 'variants'])
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

    public function getAllVariants(int $id)
    {
        return ProductVariant::where('product_id', $id)->get()->toArray();
    }

    public function createVariant(array $data)
    {
        return ProductVariant::create($data);
    }

    public function getVariantById(int $id)
    {
        return ProductVariant::with('product')->findOrFail($id);
    }
}
