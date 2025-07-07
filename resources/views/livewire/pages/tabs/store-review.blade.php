<div class="min-h-screen p-4 md:p-8 bg-white">
    <h1 class="text-2xl font-semibold mb-6">Tulis Ulasan Produk</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- SECTION KIRI -->
        <div class="bg-white p-4 rounded-lg shadow space-y-4">
            <!-- Gambar Produk -->
            <div class="w-fit h-60 bg-gray-100 rounded-lg overflow-hidden shadow mx-auto">
                <img src="{{ Storage::url($product->image_path) }}" alt="Gambar Produk" class="w-full h-full object-cover">
            </div>

            <!-- Harga -->
            <div>
                <span class="text-gray-500 text-sm">Harga:</span>
                <div class="text-xl font-bold text-red-600">@idr($product->price)</div>
            </div>

            <!-- Warna -->
            <div>
                <span class="text-gray-500 text-sm">Warna:</span>
                <div class="inline-block mt-1 px-3 py-1 rounded-full bg-gray-100 text-sm font-medium text-gray-800">
                    {{ $product->color }}
                </div>
            </div>
        </div>

        <!-- SECTION KANAN -->
        <form wire:submit.prevent="submit" class="bg-white p-4 rounded-lg shadow space-y-6" x-data="{ rating: @entangle('rating'), imagesPreview: [] }" x-init="$watch('rating', val => rating = val)">
            <!-- Nama Produk -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h2>
            </div>

            <!-- Rating Bintang -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Rating</label>
                <div class="flex items-center gap-2">
                    <template x-for="star in 5" :key="star">
                        <button type="button" @click="rating = star" :class="rating >= star ? 'text-yellow-400' : 'text-gray-300'" class="focus:outline-none">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.63-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.45 4.73L5.82 21z" />
                            </svg>
                        </button>
                    </template>
                </div>
            </div>

            <!-- Textarea Review -->
            <div>
                <label for="review" class="block mb-2 text-sm font-medium text-gray-700">Ulasan</label>
                <textarea id="review" wire:model.defer="review" rows="5" class="w-full p-3 border border-gray-300 rounded-md focus:ring-red-500 focus:border-red-500" placeholder="Tulis ulasan kamu di sini..."></textarea>
            </div>

            <!-- Upload Gambar (Flowbite Dropzone Style) -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Upload Gambar (maks 4)</label>
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                            <p class="text-xs text-gray-500">PNG, JPG maksimal 4 gambar.</p>
                        </div>
                        <input id="dropzone-file" type="file" wire:model="images" multiple accept="image/*" class="hidden" />
                    </label>
                </div>

                <!-- Preview Gambar -->
                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach ($images as $image)
                        <div>
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-24 object-cover rounded-md border" />
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit" class="w-full px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md">
                    Kirim Ulasan
                </button>
            </div>
        </form>
    </div>
</div>
