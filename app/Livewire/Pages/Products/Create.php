<?php

namespace App\Livewire\Pages\Products;

use App\Livewire\Forms\ProductCreateForm;
use App\Models\ProductType;
use App\Services\ProductService;
use App\Livewire\BaseComponent;
use App\Models\Product;
use App\Models\ProductImages;
use App\Services\ProductImageService;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class Create extends BaseComponent
{
    use WithFileUploads;

    protected ProductService $productService;
    protected ProductImageService $productImageService;

    public ProductCreateForm $form;
    public array $images = [];
    public array $imagePreviews = [];
    public $product_types;

    public function boot(ProductService $productService, ProductImageService $productImageService)
    {
        $this->productImageService = $productImageService;
        $this->productService = $productService;
    }

    public function mount()
    {
        $types = ProductType::all();

        $this->product_types = $types;
    }

    public function updatedImages()
    {
        $this->imagePreviews = [];

        foreach ($this->images as $image) {
            $this->imagePreviews[] = $image->temporaryUrl();
        }
    }


    public function store()
    {
        // $this->validate(); // ini line 54
        info("CALLED!");

        $createdProduct = $this->productService->createProduct([
            'name' => $this->form->name,
            'description' => $this->form->description,
            'price' => $this->form->price,
            'current_stock' => $this->form->current_stock,
            'condition' => $this->form->condition,
            'created_by' => Auth::user()->id,
            'product_type_id' => $this->form->product_type_id,
            'images' => $this->images,
        ]);


        foreach($this->images as $index => $image) {
            $path = $image->store('product_images', 'public');

            $this->productImageService->createProductImage([
                'image_path' => $path,
                'is_main' => $index === 0,
                'product_id' => $createdProduct->id,
            ]);
        }


        session()->flash('success', 'Product created successfully.');

        return $this->redirect(route('products.index.admin'), true);
    }
    
    public function render()
    {
        return view('livewire.pages.products.create');
    }
}
