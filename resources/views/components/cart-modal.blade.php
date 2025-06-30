<div 
    x-cloak 
    x-show="$store.modal.open" 
    x-transition.opacity 
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
>
    <div 
        x-show="$store.modal.open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        @click.away="$store.modal.hide()"
        class="bg-white rounded-lg shadow-lg w-full max-w-md p-4 sm:p-6"
    >
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold sm:text-xl text-gray-800">Tambah ke Keranjang</h2>
            <button @click="$store.modal.hide()" class="text-gray-500 hover:text-gray-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Produk Info -->
        <div class="flex flex-col sm:flex-row gap-4 mb-6">
            <template x-if="$store.modal.product?.image">
                <img :src="$store.modal.product.image" alt="Product Image" class="w-full sm:w-32 h-32 object-contain rounded" />
            </template>
            <div class="flex-1 space-y-2 text-center sm:text-left">
                <h3 class="text-base font-semibold text-gray-800" x-text="$store.modal.product?.title"></h3>
                <p class="text-black font-medium text-lg">
                    Rp. <span class="text-black font-medium text-lg" x-text="$store.modal.product?.price"></span>
                </p>
                <!-- Deskripsi -->
                <div class="text-left px-2 bg-white border rounded shadow-sm p-1">
                    <div class="text-sm text-gray-700 line-clamp-3" x-html="$store.modal.product?.productDescription"></div>
                    <div class="mt-1">
                        <a :href="'{{ route('products.detail', ['product' => '__ID__']) }}'.replace('__ID__', $store.modal.product.productId)" 
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
                <template x-for="variant in $store.modal.product?.variants || []" :key="variant.id">
                    <div 
                        class="p-2 border rounded cursor-pointer hover:border-red-500"
                        :class="{ 'border-red-600 bg-red-50': $store.modal.selectedVariant?.id === variant.id }"
                        @click="$store.modal.selectedVariant = variant"
                    >
                        <p class="text-sm font-medium text-gray-800" x-text="variant.color"></p>
                        <p class="text-xs text-gray-500">Stok: <span x-text="variant.current_stock"></span></p>
                    </div>
                </template>
            </div>

            <!-- ⬇️ Tambahkan di sini -->
            <template x-if="$store.modal.selectedVariant">
                <div class="relative flex items-center max-w-[8rem] my-3 justify-end">
                    <button @click="$store.modal.quantity = Math.max(1, $store.modal.quantity - 1)" type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                        <svg class="w-3 h-3 text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                        </svg>
                    </button>
                    <input 
                        type="text" 
                        id="quantity-input" 
                        data-input-counter aria-describedby="helper-text-explanation" 
                        class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5" 
                        min="1" 
                        :max="$store.modal.selectedVariant?.current_stock" 
                        x-model.number="$store.modal.quantity" 
                        placeholder="" required />
                    <button @click="$store.modal.quantity = Math.min($store.modal.quantity + 1, $store.modal.selectedVariant?.current_stock)" type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100  focus:ring-2 focus:outline-none">
                        <svg class="w-3 h-3 text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                        </svg>
                    </button>
                </div>
            </template>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-2">
            <button 
                @click="$store.modal.hide()" 
                class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 rounded"
            >
                Batal
            </button>
            <button 
                class="px-4 py-2 text-sm bg-red-600 text-white hover:bg-red-700 rounded disabled:opacity-50"
                :disabled="!$store.modal.selectedVariant"
                @click="
                    Livewire.dispatch('add-to-cart-from-modal', {
                        variantId: $store.modal.selectedVariant.id,
                        quantity: $store.modal.quantity
                    });
                    $store.modal.hide();
                "
            >
                Tambahkan
            </button>
        </div>
    </div>
</div>