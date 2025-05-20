<?php

namespace App\Interfaces;

interface CartRepositoryInterface
{
    public function all();
    public function addToCart(int $variant_id, int $quantity);
    public function delete(int $variant_id);
    public function updateQuantity(int $variant_id, int $quantity);
}
