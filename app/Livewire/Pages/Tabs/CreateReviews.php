<?php

namespace App\Livewire\Pages\Tabs;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateReviews extends Component
{
    public $product_to_reviews;

    public function mount()
    {
        $this->product_to_reviews = $this->indexCompletedTransactionsProduct();
    }

    public function indexCompletedTransactionsProduct()
    {
        $products = DB::table('transaction_details as td')
            ->join('transactions as tx', 'tx.id', '=', 'td.detail_master')
            ->join('products as p', 'p.id', '=', 'td.product_id')
            ->join('product_variants as pv', 'pv.id', '=', 'td.detail_variant')
            ->leftJoin('product_images as pi', 'pi.color_code', '=', 'pv.color')
            ->where('tx.transaction_status', 'completed')
            ->where('td.has_reviewed','=',0) // where not reviewed yet
            ->select(
                'td.id as detail_id', 
                'p.id as product_id',
                'pv.id as variant_id',
                'p.name as product_name',
                'p.created_at as buy_at',
                'pv.color as variant_name',
                'td.detail_subtotal as sub_total',
                'pi.image_path'
            )
            ->get();

        return $products;
    }

    public function redirectStoring($variant_id, $detail_id)
    {
        return redirect(route('reviews.store', ['variant_id' => $variant_id,'detail_id' => $detail_id]));
    }

    public function render()
    {
        return view('livewire.pages.tabs.create-reviews');
    }
}
