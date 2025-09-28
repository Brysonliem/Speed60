<?php

namespace App\Livewire\Pages\Reviews;

use App\Models\Reviews;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Show extends Component
{
    public Reviews $review;

    public $review_detail;
    public array $review_images = [];
    public array $product_details = [];

    public function mount(Reviews $review)
    {
        $this->review = $review;

        $this->review_detail  = $this->loadDetailReview();
        $this->review_images  = $this->loadDetailImages(); // <- hasil sudah URL
        $this->product_details = $this->loadVariantProducts();
    }

    public function loadDetailReview()
    {
        return DB::table('reviews as r')
            ->select([
                'r.id',
                'r.content',
                'r.rating_point',
                'p.name as product_name',
                'p.description as product_description',
                'u.name as user_name',
                'u.email as user_email',
            ])
            ->leftJoin('products as p', 'p.id', '=', 'r.product_id')
            ->leftJoin('users as u', 'u.id', '=', 'r.user_id')
            ->where('r.id', $this->review->id)
            ->first();
    }

    public function loadDetailImages(): array
    {
        return DB::table('review_images')
            ->where('review_id', $this->review->id)
            ->pluck('image_path')            // ["uploads/abc.jpg", ...]
            ->map(function ($path) {
                $path = ltrim((string) $path, '/');
                return Storage::url($path);  // "/storage/uploads/abc.jpg"
            })
            ->all();                         // array of URLs
    }

    public function loadVariantProducts()
    {
        return DB::table('reviews', 'r')
            ->select([
                'td.detail_qty',
                'td.detail_subtotal',
                'pv.color',
                'pv.price'
            ])
            ->join('transaction_details as td','td.id','=','r.transaction_detail_id')
            ->leftJoin('product_variants as pv','pv.id','=','td.detail_variant')
            ->where('r.id', $this->review->id)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.pages.reviews.show');
    }
}
