<?php

namespace App\Livewire\Pages\Products;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\CartCreateForm;
use App\Services\CartService;
use App\Services\MotorCategoryService;
use App\Services\ProductService;
use App\Services\ProductTypeService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Index extends BaseComponent
{
    protected ProductService $productService;
    protected MotorCategoryService $motorCategoryService;
    protected ProductTypeService $productTypeService;

    public CartCreateForm $cartForm;

    public string $search = '';
    public string $selectedCategoryCode = '';
    public string $selectedMaterial = '';
    public string $selectedProductType = '';
    public string $selectedSubProductType = '';

    public array $materialProducts = [
        ['name' => 'Stainless', 'code' => 'STAINLESS'],
        ['name' => 'Titanium', 'code' => 'TITANIUM'],
        ['name' => 'Other', 'code' => ''],
    ];

    protected $queryString = [
        'selectedCategoryCode' => ['as' => 'motor_type', 'except' => ''],
        'search' => ['except' => ''],
        'selectedMaterial' => ['as' => 'material', 'except' => ''],
        'selectedProductType' => ['as' => 'product_type', 'except' => ''],
        'selectedSubProductType' => ['as' => 'sub_product_type', 'except' => '']
    ];

    public function boot(
        ProductService $productService,
        MotorCategoryService $motorCategoryService,
        ProductTypeService $productTypeService
    ) {
        $this->productService = $productService;
        $this->motorCategoryService = $motorCategoryService;
        $this->productTypeService = $productTypeService;
    }

    #[Computed]
    public function products(): array
    {
        return $this->productService->getAllProducts(
            $this->selectedCategoryCode ?: null,
            $this->selectedMaterial ?: null,
            $this->search ?: null,
            $this->selectedSubProductType ?: null
        );
    }

    #[Computed]
    public function motorCategories(): array
    {
        return $this->motorCategoryService->getAllCategory();
    }

    #[Computed]
    public function productTypes(): array
    {
        return $this->productTypeService->index();
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
