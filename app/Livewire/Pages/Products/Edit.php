<?php

namespace App\Livewire\Pages\Products;

use App\Livewire\BaseComponent;
use App\Livewire\Forms\ProductEditForm;
use App\Models\Product;
use App\Models\ProductType;
use App\Services\ProductImageService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends BaseComponent
{
    use WithFileUploads;

    protected ProductService $productService;
    protected ProductImageService $productImageService;

    public ProductEditForm $form;

    public array $newImages = [];
    public array $previewNewImages = [];
    public array $existingImages = [];
    public $product_types;

    public function boot(ProductService $productService, ProductImageService $productImageService)
    {
        $this->productService = $productService;
        $this->productImageService = $productImageService;
    }

    public function mount(Product $product)
    {
        $this->product_types = ProductType::all();
        $this->form->setProduct($product);
    }

    public function updatedNewImages()
    {
        $this->previewNewImages = [];

        foreach ($this->newImages as $image) {
            $this->previewNewImages[] = $image->temporaryUrl();
        }
    }

    public function deleteImage(int $id)
    {
        $image = $this->productImageService->getProductImageById($id);

        Storage::disk('public')->delete("product_images/".$image->image_path);

        $this->productImageService->deleteProductById($image->id);

        $this->form->product->load('images');
    }

    public function update()
    {
        // $this->validate();

        $updatedData = $this->productService->updateProduct($this->form->product->id, [
            'name' => $this->form->name,
            'description' => $this->form->description,
            'price' => $this->form->price,
            'current_stock' => $this->form->current_stock,
            'condition' => $this->form->condition,
            'product_type_id' => $this->form->product_type_id,
        ]);

        // Simpan gambar baru kalau ada
        foreach ($this->newImages as $index => $image) {
            $path = $image->store('product_images', 'public');

            $this->productImageService->createProductImage([
                'image_path' => $path,
                'is_main' => $index === 0,
                'product_id' => $updatedData->id,
            ]);
        }

        session()->flash('success', 'Produk berhasil diperbarui');

        $this->redirect(route('products.index.admin'), true);
    }

    public function render()
    {
        return view('livewire.pages.products.edit');
    }
}
