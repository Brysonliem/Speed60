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
    public array $images = [];
    public array $imagePreviews = [];
    public $product_types;
    public $motorCategories;
    public array $selectedMotorCategoryIds = [];

    public function boot(
        ProductService $productService, 
        ProductImageService $productImageService,
        MotorCategoryService $motorCategoryService
    )
    {
        $this->productImageService = $productImageService;
        $this->productService = $productService;
        $this->motorCategoryService = $motorCategoryService;
    }

    public function mount()
    {
        $types = ProductType::all();
        
        $this->motorCategories = $this->motorCategoryService->getAllCategory();
        $this->product_types = $types;
        $this->form->product_type_id = $types[0]->id;
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

        foreach ($this->variantForms as $newIndex => $oldForm) {
            $rebound = $this->makeVariantForm($newIndex);

            $vars = get_object_vars($oldForm);
            foreach ($vars as $var => $value) {
                if (isset($oldForm->$var)) {
                    $rebound->$var = $value;
                }
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
        // $this->validate(); // ini line 54

        DB::transaction(function () {
            $createdProduct = $this->productService->createProduct([
                'name' => $this->form->name,
                'description' => $this->form->description,
                'condition' => $this->form->condition,
                'created_by' => Auth::user()->id,
                'product_type_id' => $this->form->product_type_id,
                'images' => $this->images,
                'material' => $this->form->material
            ]);

            //attaching the motor categories
            $createdProduct->motorCategories()->attach($this->selectedMotorCategoryIds);

            foreach ($this->images as $index => $image) {
                $path = $image->store('product_images', 'public');

                $this->productImageService->createProductImage([
                    'image_path' => $path,
                    'is_main' => $index === 0,
                    'product_id' => $createdProduct->id,
                ]);
            }

            foreach ($this->variantForms as $index => $variant) {
                $variant->product_id = $createdProduct->id;
                $this->productService->createVariant($variant->toArray());
            }
        });

        session()->flash('success', 'Product created successfully.');

        return $this->redirect(route('products.index.admin'), true);
    }

    public function render()
    {
        return view('livewire.pages.products.create');
    }
}
