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

    #[Validate('required|string|in:new,used')] // contoh enum: "new" atau "used"
    public string $condition = 'NEW';

    #[Validate('required|string|in:STAINLESS,TITANIUM')]
    public string $material = '';


    #[Validate('required|integer|exists:product_types,id')]
    public int $product_type_id;

    #[Validate('required|integer|exists:sub_product_type,id')]
    public int $sub_product_type_id;

    /**
     * Untuk mengisi form saat update misalnya
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;

        $this->name = $product->name;
        $this->description = $product->description;
        $this->condition = $product->condition;
        $this->material = $product->material;
        $this->product_type_id = $product->product_type_id;
        $this->sub_product_type_id = $product->sub_product_type_id;
    }
}
