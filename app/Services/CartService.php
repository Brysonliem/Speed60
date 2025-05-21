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

    public function addToCart(int $variant_id, int $quantity)
    {
        return $this->cartRepository->addToCart($variant_id, $quantity);
    }

    public function getAllDataCart()
    {
        return $this->cartRepository->all();
    }

    public function deleteFromCart(int $variant_id)
    {
        return $this->cartRepository->delete($variant_id);
    }

    public function updateQuantity(int $variant_id, int $quantity)
    {
        return $this->cartRepository->updateQuantity($variant_id, $quantity);
    }

    public function toggleChecked(int $variant_id, bool $status)
    {
        return $this->cartRepository->toggleChecked($variant_id, $status);
    }
}
