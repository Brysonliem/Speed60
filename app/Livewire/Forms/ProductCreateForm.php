<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Product;
use Livewire\Attributes\Validate;

class ProductCreateForm extends Form
{
    public ?Product $product = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $description = null;

    #[Validate('required|numeric|min:0')]
    public float $price = 0;

    #[Validate('required|integer|min:0')]
    public int $current_stock = 0;

    #[Validate('required|string|in:new,used')] // contoh enum: "new" atau "used"
    public string $condition = 'NEW';

    #[Validate('required|integer|exists:product_types,id')]
    public int $product_type_id;

    /**
     * Untuk mengisi form saat update misalnya
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->current_stock = $product->current_stock;
        $this->condition = $product->condition;
        $this->product_type_id = $product->product_type_id;
    }
}
