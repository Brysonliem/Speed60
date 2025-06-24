<div 
    wire:ignore.self
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
    x-cloak
    x-show="@entangle('open')"
>
    <div 
        class="bg-white rounded-lg shadow-lg w-full max-w-md p-4 sm:p-6"
        @click.away="$wire.set('open', false)"
    >
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold sm:text-xl text-gray-800">Tambah ke Keranjang</h2>
            <button wire:click="$set('open', false)" class="text-gray-500 hover:text-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Produk Info -->
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            @if (!empty($product['image']))
                <img src="{{ $product['image'] }}" alt="Product Image" class="w-full sm:w-32 h-32 object-contain rounded" />
            @endif
            <div class="flex-1 space-y-2 text-center sm:text-left">
                <h3 class="text-base font-semibold text-gray-800">{{ $product['title'] ?? '' }}</h3>
                <p class="text-black font-medium text-lg">
                    Rp. <span class="text-black font-medium text-lg">{{ $product['price'] ?? 0 }}</span>
                </p>
                <!-- Deskripsi -->
                <div class="text-left px-2 bg-white border rounded shadow-sm p-1">
                    <div class="text-sm text-gray-700 line-clamp-3">{!! $product['productDescription'] ?? '' !!}</div>
                    <div class="mt-1">
                        <a href="{{ route('products.detail', ['product' => $product['productId'] ?? 0]) }}" 
                            class="text-red-600 text-xs hover:underline"
                        >
                            See More
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Variant Section -->
        <div class="mb-6">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Pilih Varian</h4>
            <div class="grid grid-cols-2 gap-2 sm:grid-cols-3">
                @foreach($product['variants'] ?? [] as $variant)
                    <div 
                        wire:click="selectVariant({{ $variant['id'] }})"
                        class="p-2 border rounded cursor-pointer hover:border-red-500 {{ $selectedVariant['id'] ?? null === $variant['id'] ? 'border-red-600 bg-red-50' : '' }}"
                    >
                        <p class="text-sm font-medium text-gray-800">{{ $variant['color'] }}</p>
                        <p class="text-xs text-gray-500">Stok: {{ $variant['current_stock'] }}</p>
                    </div>
                @endforeach
            </div>

            @if ($selectedVariant)
                <div class="relative flex items-center max-w-[8rem] my-3 justify-end">
                    <button wire:click="decrementQuantity" type="button" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11">
                        <svg class="w-3 h-3 text-gray-900 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                        </svg>
                    </button>
                    <input 
                        type="text" 
                        class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm block w-full py-2.5" 
                        min="1" 
                        max="{{ $selectedVariant['current_stock'] }}" 
                        wire:model.live="quantity" 
                        required />
                    <button wire:click="incrementQuantity" type="button" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11">
                        <svg class="w-3 h-3 text-gray-900 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-2">
            <button 
                wire:click="$set('open', false)" 
                class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded"
            >
                Batal
            </button>
            <button 
                wire:click="addToCart" 
                class="px-4 py-2 text-sm bg-red-600 text-white hover:bg-red-700 rounded {{ !$selectedVariant ? 'opacity-50 cursor-not-allowed' : '' }}"
                @if (!$selectedVariant) disabled @endif
            >
                Tambahkan
            </button>
        </div>
    </div>
</div>
