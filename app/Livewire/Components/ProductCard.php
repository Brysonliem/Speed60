<?php

namespace App\Livewire\Components;

use App\Services\ProductImageService;
use Livewire\Component;

class ProductCard extends Component
{
    private ProductImageService $productImageService;

    public $product;
    public $image;
    public $title;
    public $subtitle;
    public $price;

    public $discount_percentage;
    public $rating;
    public $reviews;

    public $variants;
    public $product_images;

    public function boot(ProductImageService $productImageService)
    {
        $this->productImageService = $productImageService;
    }

    public function mount($product)
    {
        $this->product = $product;

        $this->variants = $product['variants'] ?? [];
        $this->product_images = $this->getProductImages();
    }

    public function getProductImages()
    {
        return $this->productImageService->getAllImagesByProductId($this->product['id']);
    }
    
    public function render()
    {
        return view('livewire.components.product-card');
    }
}
