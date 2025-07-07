<?php

namespace App\Livewire\Pages\Tabs;

use App\Models\Product;
use App\Models\ReviewImages;
use App\Models\Reviews;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class StoreReview extends Component
{
    use WithFileUploads;

    public $variant_id;
    public $detail_id;
    public $product;
    public $rating = 0;
    public $review;
    public $images = [];

    public function mount($variant_id,$detail_id)
    {
        $this->variant_id = $variant_id;
        $this->detail_id = $detail_id;
        $this->product = $this->loadProduct();
    }

    public function loadProduct()
    {
        return DB::table('product_variants as pv')
            ->select([
                'p.id',
                'p.name',
                'pv.price',
                'pv.color',
                DB::raw("(SELECT pi.image_path FROM product_images pi WHERE pi.color_code = pv.color LIMIT 1) as image_path")
            ])
            ->join('products as p','p.id','=','pv.product_id')
            // ->join('product_images as pi','pi.color_code','=','pv.color')
            ->where('pv.id', '=', $this->variant_id)
            ->first();
    }

    public function updatedImages()
    {
        if (count($this->images) > 4) {
            $this->images = array_slice($this->images, 0, 4);
            session()->flash('error', 'Maksimal 4 gambar yang diperbolehkan.');
        }
    }

    public function submit()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:10',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $tx_detail = TransactionDetail::findOrFail($this->detail_id);

        // menandakan bahwa sudah di review biar gak muncul lagi di section need to review nich
        $tx_detail->update(['has_reviewed' => true]);

        $review = Reviews::create([
            'product_id' => $this->product->id,
            'user_id' => Auth::id(),
            'rating_point' => $this->rating,
            'content' => $this->review,
            'transaction_detail_id' => $tx_detail->id
        ]);


        foreach ($this->images as $image) {
            $path = $image->store('review_images','public');
            ReviewImages::create([
                'review_id' => $review->id,
                'image_path' => $path,
            ]);
        }

        session()->flash('success', 'Ulasan berhasil dikirim.');
        return redirect()->route('profile.show',['user' => Auth::id(),'tab' => 'create-reviews']);
    }

    public function render()
    {
        return view('livewire.pages.tabs.store-review');
    }
}