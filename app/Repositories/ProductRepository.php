<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductVariant;

class ProductRepository implements ProductRepositoryInterface
{
    private function baseProductQuery()
    {
        return Product::latest()
            ->with([
                'variants',
                'productType',
                'productImages' => function ($query) {
                    $query->where('is_main', 1);
                },
                'motorCategories:id,name,code'
            ])
            ->withCount('reviews')
            ->withCount('variants')
            ->withSum('variants','current_stock')
            ->withAvg('reviews', 'rating_point')
            ->having('variants_count', '>', 0);
    }


    public function all(?string $motorCategoryCode = null, ?string $material, ?string $searchName = null)
    {
        $query = $this->baseProductQuery();

        if($motorCategoryCode) {
            $query->whereHas('motorCategories', function($subQuery) use ($motorCategoryCode) {
                $subQuery->where('code', $motorCategoryCode);
            });
        }

        if($material) {
            $query->where('material','=',$material);
        }

        if ($searchName) {
            $query->where('name', 'like', "%{$searchName}%");
        }

        return $query->get()->toArray();
    }


    public function allProductMaster(?int $limit = null)
    {
        $query = $this->baseProductQuery()
            ->groupBy('id', 'name', 'description', 'condition', 'created_by', 'product_type_id', 'created_at', 'updated_at');

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get()->toArray();
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
