<?php

namespace App\Livewire\Pages\Products;

use App\Livewire\Forms\ProductCreateForm;
use App\Models\ProductType;
use App\Services\MotorCategoryService;
use App\Services\ProductService;
use App\Livewire\Forms\ProductVariantCreateForm;
use App\Services\ProductImageService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
class Create extends Component
{
    use WithFileUploads;

    protected ProductService $productService;
    protected ProductImageService $productImageService;
    protected MotorCategoryService $motorCategoryService;

    public ProductCreateForm $form;
    public array $variantForms = [];
    public array $images = []; // global product images (non-variant)
    public array $imagePreviews = [];
    public array $variantImages = []; // variant-specific images
    public $product_types;
    public $motorCategories;
    public array $selectedMotorCategoryIds = [];

    public function boot(
        ProductService $productService,
        ProductImageService $productImageService,
        MotorCategoryService $motorCategoryService
    ) {
        $this->productImageService = $productImageService;
        $this->productService = $productService;
        $this->motorCategoryService = $motorCategoryService;
    }

    public function mount()
    {
        $types = ProductType::all();
        $this->product_types = $types;
        $this->motorCategories = $this->motorCategoryService->getAllCategory();
        $this->form->product_type_id = $types[0]->id ?? null;
        $this->variantForms[] = $this->makeVariantForm(0);
    }

    public function updatedImages()
    {
        $this->imagePreviews = [];

        foreach ($this->images as $image) {
            $this->imagePreviews[] = $image->temporaryUrl();
        }
    }

    public function addVariant()
    {
        $nextIndex = count($this->variantForms);
        $this->variantForms[] = $this->makeVariantForm($nextIndex);
    }

    public function removeVariant(int $index)
    {
        if (count($this->variantForms) === 1) {
            session()->flash('error', 'There has to be at least one variant!');
            return;
        }

        array_splice($this->variantForms, $index, 1);
        array_splice($this->variantImages, $index, 1);

        foreach ($this->variantForms as $newIndex => $oldForm) {
            $rebound = $this->makeVariantForm($newIndex);
            foreach (get_object_vars($oldForm) as $var => $value) {
                $rebound->$var = $value;
            }
            $this->variantForms[$newIndex] = $rebound;
        }
    }

    protected function makeVariantForm(int $index): ProductVariantCreateForm
    {
        return new ProductVariantCreateForm($this, "variantForms.$index");
    }

    public function store()
    {
        // $this->validate($this->rules());

        DB::transaction(function () {
            // Simpan produk
            $createdProduct = $this->productService->createProduct([
                'name' => $this->form->name,
                'description' => $this->form->description,
                'condition' => $this->form->condition,
                'created_by' => Auth::id(),
                'product_type_id' => $this->form->product_type_id,
                'material' => $this->form->material
            ]);

            // Relasi kategori motor
            $createdProduct->motorCategories()->attach($this->selectedMotorCategoryIds);

            // Simpan gambar umum (non-variant)
            foreach ($this->images as $index => $image) {
                $path = $image->store('product_images', 'public');

                $this->productImageService->createProductImage([
                    'image_path' => $path,
                    'is_main' => $index === 0,
                    'product_id' => $createdProduct->id,
                    'color_code' => null,
                ]);
            }

            // Simpan variant + gambar variannya
            foreach ($this->variantForms as $index => $variant) {
                $variantData = $variant->toArray();
                unset($variantData['image']); // image & color_code tidak disimpan di variants
                $variantData['product_id'] = $createdProduct->id;

                $createdVariant = $this->productService->createVariant($variantData);

                $image = $this->variantImages[$index] ?? null;

                if ($image) {
                    $path = $image->store('product_images', 'public');

                    $this->productImageService->createProductImage([
                        'image_path' => $path,
                        'is_main' => false,
                        'product_id' => $createdProduct->id,
                        'color_code' => $variant->color, // gunakan color dari variant
                    ]);
                }
            }
        });

        session()->flash('success', 'Product created successfully.');
        return $this->redirect(route('products.index.admin'), true);
    }

    // public function rules()
    // {
    //     $rules = [
    //         'form.name' => 'required|string|max:255',
    //         'form.description' => 'nullable|string',
    //         'form.condition' => 'required|string',
    //         'form.product_type_id' => 'required|exists:product_types,id',
    //         'form.material' => 'nullable|string',
    //         'images.*' => 'nullable|image|max:2048',
    //         'selectedMotorCategoryIds' => 'array',
    //     ];

    //     foreach ($this->variantForms as $i => $variant) {
    //         $rules["variantForms.$i.color"] = 'required|string|max:50';
    //         $rules["variantForms.$i.current_stock"] = 'required|integer|min:0';
    //         $rules["variantForms.$i.price"] = 'required|numeric|min:0';
    //         $rules["variantForms.$i.purchase_unit"] = 'required|string';
    //         $rules["variantForms.$i.unit_per_set"] = 'nullable|numeric';
    //         $rules["variantImages.$i"] = 'nullable|image|max:2048';
    //     }

    //     return $rules;
    // }

    public function render()
    {
        return view('livewire.pages.products.create');
    }
}
