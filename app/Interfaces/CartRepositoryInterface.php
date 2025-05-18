<?php

namespace App\Interfaces;

interface CartRepositoryInterface
{
    public function all();
    public function addToCart(int $product_id, int $quantity);
    public function delete(int $product_id);
    public function updateQuantity(int $product_id, int $quantity);
}
