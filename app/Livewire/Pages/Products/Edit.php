<?php

namespace App\Livewire\Pages\Products;

use App\Livewire\Forms\ProductCreateForm;
use App\Livewire\Forms\ProductVariantCreateForm;
use App\Livewire\Forms\ProductVariantEditForm;
use App\Livewire\BaseComponent;
use App\Livewire\Forms\ProductEditForm;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductVariant;
use App\Services\MotorCategoryService;
use App\Services\ProductImageService;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class Edit extends Component
{
    use WithFileUploads;

    protected ProductService $productService;
    protected ProductImageService $productImageService;
    protected MotorCategoryService $motorCategoryService;

    public ProductCreateForm $form;
    public array $variantForms = [];
    public array $newImages = [];
    public array $previewNewImages = [];
    public array $existingImages = [];
    public $product_types;
    public $motorCategories;
    public array $selectedMotorCategoryIds = [];
    public array $deletedImageIds = [];


    public Product $product;

    public function boot(
        ProductService $productService,
        ProductImageService $productImageService,
        MotorCategoryService $motorCategoryService
    ) {
        $this->productService = $productService;
        $this->productImageService = $productImageService;
        $this->motorCategoryService = $motorCategoryService;
    }

    public function mount(Product $product)
    {
        $this->product = $product->load(['images', 'variants', 'motorCategories']);
        $this->product_types = ProductType::all();
        $this->motorCategories = $this->motorCategoryService->getAllCategory();

        $this->form = new ProductCreateForm($this, 'form');
        $this->form->name = $product->name;
        $this->form->description = $product->description;
        $this->form->condition = $product->condition;
        $this->form->product_type_id = $product->product_type_id;
        $this->form->material = $product->material;

        $this->selectedMotorCategoryIds = $product->motorCategories->pluck('id')->toArray();

        $this->existingImages = $product->images->toArray();

        foreach ($product->variants as $index => $variant) {
            $form = new ProductVariantCreateForm($this, "variantForms.$index");
            $form->fillFromModel($variant); // Anda bisa membuat method `fillFromModel` di form class
            $this->variantForms[] = $form;
        }

        if (empty($this->variantForms)) {
            $this->addVariant();
        }
    }

    public function updatedNewImages()
    {
        $this->previewNewImages = [];

        foreach ($this->newImages as $image) {
            $this->previewNewImages[] = $image->temporaryUrl();
        }
    }

    public function addVariant()
    {
        $nextIndex = count($this->variantForms);
        $this->variantForms[] = new ProductVariantCreateForm($this, "variantForms.$nextIndex");
    }

    public function removeVariant(int $index)
    {
        if (count($this->variantForms) === 1) {
            session()->flash('error', 'There has to be at least one variant!');
            return;
        }

        array_splice($this->variantForms, $index, 1);

        foreach ($this->variantForms as $newIndex => $oldForm) {
            $rebound = new ProductVariantCreateForm($this, "variantForms.$newIndex");

            foreach (get_object_vars($oldForm) as $var => $value) {
                $rebound->$var = $value;
            }

            $this->variantForms[$newIndex] = $rebound;
        }
    }

    public function removeExistingImage(int $imageId): void
    {
        $this->deletedImageIds[] = $imageId;

        // Hapus dari tampilan (optional)
        $this->existingImages = array_filter($this->existingImages, fn ($img) => $img['id'] !== $imageId);
    }

    public function removeImage(int $index)
    {
        // Pastikan index valid
        if (isset($this->newImages[$index])) {
            unset($this->newImages[$index]);
            $this->newImages = array_values($this->newImages); // Reset index array

            // Jangan lupa reset preview juga
            unset($this->previewNewImages[$index]);
            $this->previewNewImages = array_values($this->previewNewImages);
        }
    }



    public function deleteImage(int $id)
    {
        $image = $this->productImageService->getProductImageById($id);

        Storage::disk('public')->delete("product_images/" . $image->image_path);

        $this->productImageService->deleteProductById($image->id);

        $this->product->load('images');
        $this->existingImages = $this->product->images->toArray();
    }

    public function update()
    {
        DB::transaction(function () {
            $updatedProduct = $this->productService->updateProduct($this->product->id, [
                'name' => $this->form->name,
                'description' => $this->form->description,
                'condition' => $this->form->condition,
                'product_type_id' => $this->form->product_type_id,
                'material' => $this->form->material,
            ]);

            // Sync motor categories
            $updatedProduct->motorCategories()->sync($this->selectedMotorCategoryIds);

            // check images is has deleted
            if (!empty($this->deletedImageIds)) {
                $imagesToDelete = $this->product->images()->whereIn('id', $this->deletedImageIds)->get();

                foreach ($imagesToDelete as $img) {
                    // Hapus file dari storage
                    Storage::disk('public')->delete($img->image_path);

                    // Hapus dari database
                    $img->delete();
                }
            }

            // Upload new images
            foreach ($this->newImages as $index => $image) {
                $path = $image->store('product_images', 'public');

                $this->productImageService->createProductImage([
                    'image_path' => $path,
                    'is_main' => $index === 0,
                    'product_id' => $updatedProduct->id,
                ]);
            }

            // Reset & recreate variants
            $updatedProduct->variants()->delete();

            foreach ($this->variantForms as $variant) {
                $variant->product_id = $updatedProduct->id;
                $this->productService->createVariant($variant->toArray());
            }
        });

        session()->flash('success', 'Produk berhasil diperbarui.');

        return redirect()->route('products.index.admin');
    }

    public function render()
    {
        return view('livewire.pages.products.edit');
    }
}


