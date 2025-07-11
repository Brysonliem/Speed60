<?php

namespace App\Livewire\Pages\Products;

use App\Services\ProductService;
use App\Livewire\BaseComponent;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class IndexAdmin extends Component
{
    public $products;

    protected ProductService $productService;


    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function loadProducts()
    {
        $this->products = $this->productService->getAllProducts(null, null, null);
    }

    public function mount()
    {
        $this->loadProducts();
    }

    public function deleteProduct(int $id)
    {
        $this->productService->deleteProduct($id);

        $this->loadProducts();

        session()->flash('success', 'Produk Berhasil Dihapus');
    }

    public function render()
    {
        return view('livewire.pages.products.index-admin');
    }
}
