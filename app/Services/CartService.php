<?php

namespace App\Services;

use App\Interfaces\CartRepositoryInterface;

class CartService
{
    protected CartRepositoryInterface $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function addToCart(int $product_id, int $quantity)
    {
        return $this->cartRepository->addToCart($product_id, $quantity);
    }

    public function getAllDataCart()
    {
        return $this->cartRepository->all();
    }

    public function deleteFromCart(int $product_id)
    {
        return $this->cartRepository->delete($product_id);
    }
}
