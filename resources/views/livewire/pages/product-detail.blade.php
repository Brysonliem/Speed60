<div class="flex flex-col gap-4 p-4 md:p-8">
    <!-- Breadcrumb -->
    {{-- @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Produk', 'url' => route('products.index')],
        ['name' => 'Probolt Titanium', 'url' => route('products.detail', ['product' => 7])]
    ]]) --}}

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1">
            {{-- products image --}}
            <div id="indicators-carousel" class="w-full sticky top-2" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96" wire:ignore>
                    @foreach ($detailProduct->productImages as $image)
                        <div class="{{ $image['is_main'] ? '' : 'hidden' }} duration-700 ease-in-out"
                             data-carousel-item="{{ $image['is_main'] ? 'active' : '' }}">
                            <img src="{{ asset('storage/'.$image['image_path']) }}" 
                                 class="absolute inset-0 m-auto max-w-full max-h-full"
                                 alt="Product Image">
                        </div>
                    @endforeach
                </div>
                
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>  

        <div class="flex flex-col flex-wrap col-span-1">
            <span class="text-lg font-semibold">
                {{ $detailProduct->name }}
            </span>
            <div class="flex space-x-1 text-sm">
                <div class="flex space-x-1">
                    <span>Terjual</span>
                    <span class="text-gray-400 font-semibold">4</span>
                </div>
                <span aria-hidden="true">•</span>
                <div class="flex">
                    <span>
                        <svg class="unf-icon" viewBox="0 0 24 24" width="16" height="16" fill="var(--YN300, #FFD45F)" style="display: inline-block; margin-right: 5px; vertical-align: middle;" aria-hidden="true">
                            <path d="M21.57 9.14a2.37 2.37 0 0 0-1.93-1.63L15.9 7l-1.68-3.4a2.38 2.38 0 0 0-4.27 0L8.27 7l-3.75.54a2.39 2.39 0 0 0-1.32 4.04l2.71 2.64L5.27 18a2.38 2.38 0 0 0 2.35 2.79 2.42 2.42 0 0 0 1.11-.27l3.35-1.76 3.35 1.76a2.41 2.41 0 0 0 2.57-.23 2.369 2.369 0 0 0 .89-2.29l-.64-3.73L21 11.58a2.38 2.38 0 0 0 .57-2.44Z"></path>
                        </svg>
                    </span>
                    <span class="font-semibold mr-1">5</span>
                    <span class="text-gray-400 font-semibold">&#40;100 rating&#41;</span>
                </div>
            </div>
            <span class="text-3xl font-bold border-b border-gray-300 pb-2">
                @idr($currentVariant->price)
            </span>

            <div class="flex flex-col gap-4">
                <div class="flex gap-2 items-center">
                    <span class="font-bold">Choose color:</span>
                    <span class="text-gray-600">{{ $currentVariant->color }}</span>
                </div>

                <div class="flex gap-2 flex-wrap">
                    @foreach ($variants as $index => $variant)
                        <div class="flex items-center me-4" wire:key="{{ $variant->id }}">
                            <input
                                @if ($variant->id === $currentVariant->id) checked @endif 
                                id="red-radio"
                                type="radio"
                                name="colored-radio"
                                class="w-6 h-6 scale-150 border-gray-300 focus:ring-gray-500 focus:ring-2"
                                style="background: {{ $variant->color_code }}; color: {{ $variant->color_code }}"
                                wire:change="setSelectedVariant({{ $index }})"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

            <p class="mt-2">
                {{ $detailProduct->description }}
            </p>
        </div>

        <div class="sticky top-2 flex flex-col gap-3 col-span-1 px-2 py-4 bg-white rounded-lg shadow-md border border-gray-200 w-full md:max-w-fit h-fit">
            <div class="flex gap-2">
                <div class="max-w-xs">
                    <div class="relative flex items-center max-w-[8rem]">
                        <button
                            wire:click="decrementQuantity"
                            type="button" id="decrement-button"
                            data-input-counter-decrement="quantity-input"
                            class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none @if ($quantity === 1) hover:cursor-not-allowed @endif"
                            @if ($quantity === 1) disabled @endif
                        >
                            <svg class="w-3 h-3 text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                            </svg>
                        </button>
                        <input wire:model.live="quantity" type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 " placeholder="999" required />
                        <button
                            wire:click="incrementQuantity"
                            type="button"
                            id="increment-button"
                            data-input-counter-increment="quantity-input"
                            class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none @if ($quantity >= $currentVariant->current_stock) hover:cursor-not-allowed @endif"
                            @if ($quantity >= $currentVariant->current_stock) disabled @endif
                        >
                            <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex flex-1 space-x-1 items-center">
                    <span>Stok Total: </span>
                    @if ($currentVariant->current_stock === 0)
                        <span class="text-red-500 font-semibold">
                            Out of stock
                        </span>
                    @elseif ($currentVariant->current_stock <= 10)
                        <span class="text-orange-400 font-semibold">
                            {{ $currentVariant->current_stock }} left!
                        </span>
                    @else
                        <span class="font-semibold">
                            {{ $currentVariant->current_stock }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-gray-400">Subtotal</span>
                <span class="text-2xl font-bold">@idr($subTotal)</span>
            </div>

            <button
                type="button"
                wire:click="addToCart"
                wire:loading.attr="disabled"
                wire:target="addToCart"
                class="px-5 h-11 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 inline-flex items-center justify-center @if ($detailProduct->current_stock === 0 || $quantity === 0) hover:cursor-not-allowed @endif"
                @if ($currentVariant->current_stock === 0 || $quantity === 0) disabled @endif
            >
                <svg
                    wire:loading
                    wire:target="addToCart"
                    aria-hidden="true"
                    role="status"
                    class="inline w-4 h-4 me-2 text-white animate-spin"
                    viewBox="0 0 100 101"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB"
                    />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor"
                    />
                </svg>
                <span wire:loading.remove wire:target="addToCart">ADD TO CART</span>
                <span wire:loading wire:target="addToCart">Menambahkan...</span>
            </button>

            <button
                wire:click="purchaseNow"
                type="button"
                class="px-5 h-11 text-base font-medium text-center text-blue-700 rounded-lg border border-blue-500 hover:bg-blue-100 focus:ring-2 focus:outline-none focus:ring-blue-300 @if ($detailProduct->current_stock === 0 || $quantity === 0) hover:cursor-not-allowed @endif"
                @if ($currentVariant->current_stock === 0 || $quantity === 0) disabled @endif
            >
                BELI SEKARANG
            </button>

            <span class="text-lg font-semibold">Feature</span>
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-2">
                    <span class="material-icons text-blue-400">workspace_premium</span>
                    Garansi 1 Bulan
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-icons text-blue-400">local_shipping</span>
                    Jaminan Pengiriman Di Hari Yang Sama
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-icons text-blue-400">headset_mic</span>
                    24/7 Layanan Customer
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-icons text-blue-400">verified_user</span>
                    Pembayaran Terjamin
                </div>
            </div>
        </div>

        {{-- <div class="flex flex-col w-full items-center gap-4 col-span-1 md:col-span-2">
            REVIEW
        </div> --}}

    <div class="flex flex-col gap-2">
        <span class="text-lg font-semibold">Produk Lainnya</span>
        <div class="grid grid-cols-4 gap-3">
            @foreach ($products as $product)
                @livewire('components.product-card', [
                    'product' => $product,
                    'image' => !empty($product['product_images'])
                            ? asset('storage/'.$product['product_images'][0]['image_path'])
                            : 'storage/images/default.png',
                    'title' => $product['name'],
                    'price' => !empty($product['variants']) 
                            ? number_format($product['variants'][0]['price'], 0, ',', '.')
                            : '0',
                    'rating' => round($product['reviews_avg_rating_point'], 2),
                    'reviews' => $product['reviews_count']
                ], key(md5('product-'.$product['id'].'-'.$product['name'])))
            @endforeach
        </div>
    </div>
    @if (Session::has('success'))
    <div x-data="{show: true}" x-show="show" id="toast-success" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm " role="alert">
        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg ">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
            </svg>
            <span class="sr-only">Check icon</span>
        </div>
        <div class="ms-3 text-sm font-normal">{{ Session::get('success') }}</div>
        <button x-on:click="show = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endif
</div>
