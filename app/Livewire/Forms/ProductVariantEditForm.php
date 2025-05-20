<?php

namespace App\Livewire\Forms;

use App\Models\ProductVariant;
use Livewire\Form;
use Livewire\Attributes\Validate;

class ProductVariantCreateForm extends Form
{
    public ?ProductVariant $variant = null;

    #[Validate('required|integer|exists:products,id')]
    public int $product_id;

    #[Validate('required|string')]
    public string $color;

    #[Validate('required|string')]
    public string $color_code;

    #[Validate('required|integer|min:0')]
    public int $current_stock;

    #[Validate('required|numeric|min:0')]
    public float $price;

    #[Validate('required|string|in:set,pcs')]
    public string $purchase_unit;

    #[Validate('numeric|min:0')]
    public ?float $unit_per_set;

    public function setProductVariant(ProductVariant $variant)
    {
        $this->variant = $variant;

        $this->product_id = $variant->product_id;
        $this->color = $variant->color;
        $this->color_code = $variant->color_code;
        $this->current_stock = $variant->current_stock;
        $this->price = $variant->price;
        $this->purchase_unit = $variant->purchase_unit;
        $this->unit_per_set = $variant->unit_per_set;
    }
}
