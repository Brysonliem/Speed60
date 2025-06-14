<?php

namespace App\Livewire\Pages\Products;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\CartCreateForm;
use App\Services\CartService;
use App\Services\MotorCategoryService;
use App\Services\ProductService;
use Livewire\Attributes\On;

class Index extends BaseComponent
{
    public $products;

    protected ProductService $productService;
    protected MotorCategoryService $motorCategoryService;

    public CartCreateForm $cartForm;

    public $motorCategories = [];
    public $materialProducts = [
        ['name' => 'Stainless', 'code' => 'STAINLESS'],
        ['name' => 'Titanium', 'code' => 'TITANIUM'],
        ['name' => 'Other', 'code' => 'OTHER'],
    ];
    
    public $selectedCategoryCode = '';

    protected $queryString = [
        'selectedCategoryCode' => [
            'as' => 'motor_type',
            'except' => ''
        ]
    ];

    public function boot(
        ProductService $productService, 
        MotorCategoryService $motorCategoryService
    )
    {
        $this->productService = $productService;
        $this->motorCategoryService = $motorCategoryService;
    }

    public function loadMotorCategories()
    {
        $this->motorCategories = $this->motorCategoryService->getAllCategory();
    }

    public function loadProducts()
    {
        if($this->selectedCategoryCode) {
            $this->products = $this->productService->getAllProducts($this->selectedCategoryCode);
        } else {
            $this->products = $this->productService->getAllProducts(null);
        }
    }

    public function updatedSelectedCategoryCode()
    {
        $this->loadProducts();
    }


    public function mount()
    {
        $this->loadProducts();
        $this->loadMotorCategories();
    }

    public function render()
    {
        return view('livewire.pages.products.index');
    }
}
