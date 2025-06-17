<?php

namespace App\Livewire\Pages\Products;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\CartCreateForm;
use App\Services\CartService;
use App\Services\MotorCategoryService;
use App\Services\ProductService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Index extends BaseComponent
{
    protected ProductService $productService;
    protected MotorCategoryService $motorCategoryService;

    public CartCreateForm $cartForm;

    public string $search = '';
    public string $selectedCategoryCode = '';
    public string $selectedMaterial = '';

    public array $materialProducts = [
        ['name' => 'Stainless', 'code' => 'STAINLESS'],
        ['name' => 'Titanium', 'code' => 'TITANIUM'],
        ['name' => 'Other', 'code' => ''],
    ];

    protected $queryString = [
        'selectedCategoryCode' => ['as' => 'motor_type', 'except' => ''],
        'search' => ['except' => ''],
        'selectedMaterial' => ['as' => 'material', 'except' => ''],
    ];

    public function boot(
        ProductService $productService,
        MotorCategoryService $motorCategoryService
    ) {
        $this->productService = $productService;
        $this->motorCategoryService = $motorCategoryService;
    }

    #[Computed]
    public function products(): array
    {
        return $this->productService->getAllProducts(
            $this->selectedCategoryCode ?: null,
            $this->selectedMaterial ?: null,
            $this->search ?: null
        );
    }

    #[Computed]
    public function motorCategories(): array
    {
        return $this->motorCategoryService->getAllCategory();
    }

    public function resetFilter(): void
    {
        $this->reset(['search', 'selectedCategoryCode', 'selectedMaterial']);
    }

    public function render()
    {
        return view('livewire.pages.products.index');
    }
}
