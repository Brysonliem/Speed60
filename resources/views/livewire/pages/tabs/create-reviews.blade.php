<div class="min-h-screen p-4 md:p-8 bg-white">
    <h1 class="text-2xl font-semibold mb-6">Produk yang Telah Dibeli</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($product_to_reviews as $product)
        <div class="border rounded-lg shadow-sm p-4 bg-white flex flex-col">
            <!-- Gambar Produk -->
            <img src="{{ Storage::url($product->image_path) }}" alt="Product Image" class="w-full h-40 object-cover rounded-md mb-3">

            <!-- Info Produk -->
            <div class="flex-1">
                <h2 class="text-lg font-semibold text-gray-800">{{ $product->product_name }}</h2>
                <p class="text-sm text-gray-600">Warna: {{ $product->variant_name }}</p>
                <p class="text-sm text-gray-500">Dibeli pada: {{ \Carbon\Carbon::parse($product->buy_at)->format('d M Y') }}</p>
            </div>

            <!-- Harga -->
            <div class="mt-3">
                <span class="text-red-600 font-bold text-md">Rp {{ number_format($product->sub_total, 0, ',', '.') }}</span>
            </div>

            <!-- Tombol Review -->
            <div class="mt-4">
                <button
                    wire:click="redirectStoring({{ $product->variant_id }}, {{ $product->detail_id }})"
                    class="block text-center px-4 py-2 text-sm bg-red-600 text-white rounded hover:bg-red-700 transition"
                >
                    Tulis Ulasan
                </button>

            </div>
        </div>
        @endforeach
    </div>
</div>