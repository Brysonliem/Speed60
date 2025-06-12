<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use Illuminate\Validation\Rule;

class ProductVariantEditForm
{
    public ?int $id = null;
    public ?int $product_id = null;
    public string $color = '';
    public string $color_code = '';
    public int $current_stock = 0;
    public float $price = 0;
    public string $purchase_unit = 'pcs';
    public ?int $unit_per_set = null;

    protected Component $parent;
    protected string $formPath;

    public function __construct(Component $parent, string $formPath)
    {
        $this->parent = $parent;
        $this->formPath = $formPath;
    }

    public function setVariant($variant): void
    {
        $this->id = $variant->id;
        $this->product_id = $variant->product_id;
        $this->color = $variant->color;
        $this->color_code = $variant->color_code;
        $this->current_stock = $variant->current_stock;
        $this->price = $variant->price;
        $this->purchase_unit = $variant->purchase_unit;
        $this->unit_per_set = $variant->unit_per_set;
    }

    public function rules(): array
    {
        return [
            "{$this->formPath}.color" => ['required', 'string', 'max:255'],
            "{$this->formPath}.color_code" => ['required', 'string', 'max:255'],
            "{$this->formPath}.current_stock" => ['required', 'integer', 'min:0'],
            "{$this->formPath}.price" => ['required', 'numeric', 'min:0'],
            "{$this->formPath}.purchase_unit" => ['required', Rule::in(['set', 'pcs'])],
            "{$this->formPath}.unit_per_set" => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'color' => $this->color,
            'color_code' => $this->color_code,
            'current_stock' => $this->current_stock,
            'price' => $this->price,
            'purchase_unit' => $this->purchase_unit,
            'unit_per_set' => $this->unit_per_set,
        ];
    }
}
