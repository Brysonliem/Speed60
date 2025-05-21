<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductEditForm extends Form
{

    public ?Product $product = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $description = null;

    #[Validate('required|string|in:new,used')] // contoh enum: "new" atau "used"
    public string $condition = 'NEW';

    #[Validate('required|integer|exists:product_types,id')]
    public int $product_type_id;

    public function setProduct(Product $product): void
    {
        $this->product = $product->load(['images']);

        $this->name = $product->name;
        $this->description = $product->description;
        $this->condition = $product->condition;
        $this->product_type_id = $product->product_type_id;
    }
}
