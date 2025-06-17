<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SeedRollbackTest extends Command
{
    protected $signature = 'seed:rollback-test';
    protected $description = 'Hapus data hasil seed testing';

    public function handle()
    {
        $products = Product::where('created_by', 1)->get();

        foreach ($products as $product) {
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }

            $product->variants()->delete();
            $product->delete();
        }

        $this->info('♻️  Semua data testing berhasil dihapus.');
    }
}
