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
            ->join('product_variants', 'carts.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->join('product_images', function ($join) {
                $join->on('product_images.product_id', '=', 'products.id')
                    ->where('product_images.is_main', true);
            })
            ->where('carts.user_id', Auth::user()->id)
            ->select(
                'carts.id AS cart_id',
                'carts.quantity',
                'products.id AS product_id',
                'product_variants.id AS product_variant_id',
                'products.name',
                'product_variants.price',
                'product_images.image_path',
                'carts.checked'
            )
            ->get();
    }

    public function addToCart(int $variant_id, int $quantity)
    {
        return DB::transaction(function () use ($variant_id, $quantity) {
            $productsInCart = Carts::where('product_variant_id', $variant_id)
                ->where('user_id', Auth::user()->id)
                ->first();
            if ($productsInCart) {
                // Jika produk sudah ada di cart, update quantity
                $productsInCart->quantity += $quantity;
                $productsInCart->save();
                return $productsInCart;
            }

            return Carts::create([
                'product_variant_id' => $variant_id,
                'user_id' => Auth::user()->id,
                'quantity' => $quantity,
            ]);
        });
    }

    public function updateQuantity(int $variant_id, int $quantity)
    {
        return DB::transaction(function () use ($variant_id, $quantity) {
            $cart = Carts::where('product_variant_id', $variant_id)
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

    public function delete(int $variant_id)
    {
        return DB::transaction(function () use ($variant_id) {
            $cart = Carts::where('product_variant_id', $variant_id)
                ->where('user_id', Auth::user()->id)
                ->first();
            return $cart?->delete();
        });
    }

    public function toggleChecked(int $variant_id, bool $status)
    {
        $item = Carts::where('product_variant_id', $variant_id)
            ->where('user_id', Auth::user()->id)
            ->first();
        $item->checked = $status;
        $item->save();
        return $item;
    }
}
