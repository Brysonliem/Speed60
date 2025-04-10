<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use App\Models\Carts;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartRepository implements CartRepositoryInterface
{
    public function all()
    {
        return DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->join('product_images', function ($join) {
                $join->on('product_images.product_id', '=', 'products.id')
                     ->where('product_images.is_main', true);
            })
            ->where('carts.user_id', 9)
            ->select(
                'carts.id',
                'carts.quantity',
                'products.name',
                'products.price',
                'product_images.image_path'
            )
            ->get();
    }

    public function addToCart(int $product_id, int $quantity)
    {
        return DB::transaction(function() use ($product_id, $quantity) {

            return Carts::create([
                'product_id' => $product_id,
                'user_id' => Auth::user()->id,
                'quantity' => $quantity,
            ]);
        });
    }

    public function delete(int $product_id)
    {
        return DB::transaction(function() use ($product_id) {
            return Carts::where('product_id', $product_id)->delete();
        });
    }
}
