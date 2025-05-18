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
            ->where('carts.user_id', Auth::user()->id)
            ->select(
                'carts.id AS cart_id',
                'carts.quantity',
                'products.id AS product_id',
                'products.name',
                'products.price',
                'product_images.image_path'
            )
            ->get();
    }

    public function addToCart(int $product_id, int $quantity)
    {
        return DB::transaction(function () use ($product_id, $quantity) {
            $productsInCart = Carts::where('product_id', $product_id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if ($productsInCart) {
                // Jika produk sudah ada di cart, update quantity
                $productsInCart->quantity += $quantity;
                $productsInCart->save();
                return $productsInCart;
            }

            return Carts::create([
                'product_id' => $product_id,
                'user_id' => Auth::user()->id,
                'quantity' => $quantity,
            ]);
        });
    }

    public function updateQuantity(int $product_id, int $quantity)
    {
        return DB::transaction(function () use ($product_id, $quantity) {
            $cart = Carts::where('product_id', $product_id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if (!$cart) {
                return null;
            }

            $cart->quantity = $quantity;
            $cart->save();
            return $cart;
        });
    }

    public function delete(int $product_id)
    {
        return DB::transaction(function () use ($product_id) {
            $cart = Carts::where('product_id', $product_id)
                ->where('user_id', Auth::user()->id)
                ->first();
            return $cart->delete();
        });
    }
}
