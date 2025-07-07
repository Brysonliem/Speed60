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
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96" >
                    @foreach ($detailProduct->productImages as $image)
                        <div 
                            class="duration-700 ease-in-out {{ $image->is_main ? 'active' : 'hidden' }}"
                            data-carousel-item
                            data-color-code="{{ $image->color_code }}"
                        >
                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                class="absolute inset-0 m-auto max-w-full max-h-full"
                                alt="{{ $image->color_code }}">
                        </div>
                    @endforeach

                </div>

                
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white group-focus:outline-none">
                        <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </div>  

        <div class="col-span-1 space-y-4">
            <div class="bg-white p-5 space-y-4 rounded-md border">
                {{-- Product Title --}}
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ Str::upper($detailProduct->name)  }}
                </h1>
    
                {{-- Sold & Rating Info --}}
                <div class="flex flex-wrap items-center gap-x-4 text-sm text-gray-700">
                    <div class="flex items-center gap-1">
                        <span>Sold</span>
                        <span class="font-semibold text-gray-800">4</span>
                    </div>
                    <span class="text-gray-300">|</span>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M21.57 9.14a2.37 2.37 0 0 0-1.93-1.63L15.9 7l-1.68-3.4a2.38 2.38 0 0 0-4.27 0L8.27 7l-3.75.54a2.39 2.39 0 0 0-1.32 4.04l2.71 2.64L5.27 18a2.38 2.38 0 0 0 2.35 2.79 2.42 2.42 0 0 0 1.11-.27l3.35-1.76 3.35 1.76a2.41 2.41 0 0 0 2.57-.23 2.369 2.369 0 0 0 .89-2.29l-.64-3.73L21 11.58a2.38 2.38 0 0 0 .57-2.44Z"/>
                        </svg>
                        <span class="font-semibold text-gray-800">5</span>
                        <span class="text-gray-500 font-medium">(100 rating)</span>
                    </div>
                </div>
    
                {{-- Price --}}
                <div class="text-3xl font-extrabold border-b pb-3">
                    @idr($currentVariant->price ?? 0)
                </div>
    
                {{-- Variant Color --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">Choosen Color:</span>
                        <span class="text-gray-600">{{ $currentVariant?->color ?? '' }}</span>
                    </div>

                    <div class="grid grid-cols-3 gap-2">
                        @foreach ($variants as $index => $variant)
                            @php
                                $selected = $currentVariant && $variant->id === $currentVariant->id;
                                $image = $detailProduct->productImages->firstWhere('color_code', $variant->color);
                            @endphp

                            <div 
                                wire:click="setSelectedVariant({{ $index }})"
                                class="flex items-center gap-4 p-2 border rounded cursor-pointer transition-all duration-200
                                    hover:border-red-500 
                                    {{ $selected ? 'border-red-600 bg-red-50' : 'border-gray-200 bg-white' }}"
                            >
                                {{-- Gambar --}}
                                @if ($image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" 
                                        alt="{{ $variant->color }}"
                                        class="w-14 h-14 object-cover rounded" />
                                @else
                                    <div class="w-14 h-14 bg-gray-100 rounded flex items-center justify-center text-xs text-gray-400">
                                        No Image
                                    </div>
                                @endif

                                {{-- Info Warna + Stok --}}
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-700">{{ $variant->color }}</span>
                                    <span class="text-sm text-gray-500">Stock: {{ $variant->current_stock }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>


            </div>


            

            <div 
                x-data="{
                    activeTab: '{{ request()->query('tab', 'description') }}',
                    switchTab(tab) {
                        this.activeTab = tab;
                        const url = new URL(window.location.href);
                        url.searchParams.set('tab', tab);
                        history.replaceState(null, '', url.toString());

                        // trigger Livewire jika perlu
                        if (tab === 'reviews') {
                            Livewire.dispatch('loadReviews');
                        }
                    }
                }"
            >
                <div class="mb-4 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="me-2">
                            <button
                                :class="activeTab === 'description' ? 'text-red-600 border-b-2 border-red-600' : 'text-gray-500'"
                                class="inline-block p-4 border-b-2 rounded-t-lg"
                                @click="switchTab('description')"
                            >Description</button>
                        </li>
                        <li class="me-2">
                            <button
                                :class="activeTab === 'reviews' ? 'text-red-600 border-b-2 border-red-600' : 'text-gray-500'"
                                class="inline-block p-4 border-b-2 rounded-t-lg"
                                @click="switchTab('reviews')"
                            >Reviews</button>
                        </li>
                    </ul>
                </div>

                <div id="default-tab-content">
                    <div 
                        x-show="activeTab === 'description'" 
                        class="border p-4 rounded bg-white"
                    >
                        {!! $detailProduct->description !!}
                    </div>

                    <div 
                        x-show="activeTab === 'reviews'" 
                        class="border p-4 rounded bg-white"
                    >
                        @if (!empty($reviews))
                            @foreach ($reviews as $review)
                                                                
                                <div class="flex items-start gap-2.5" >
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('/images/admin.jpg') }}" alt="User Image">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex flex-col w-full max-w-[326px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl">
                                            <div class="flex flex-col gap-2 mb-2">
                                                <div class="flex items-center space-x-2 rtl:space-x-reverse mb-2">
                                                    <span class="text-sm font-semibold text-gray-900">{{ $review->user->name }}</span>
                                                    <span class="text-sm font-normal text-gray-500">
                                                        {{ $review->created_at->format('d-m-Y H:i') }}
                                                    </span>

                                                </div>

                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                                    </svg>
                                                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                                    </svg>
                                                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                                    </svg>
                                                    <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                                    </svg>
                                                    <svg class="w-4 h-4 text-gray-300 me-1 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                                    </svg>
                                                    <p class="ms-1 text-sm font-medium text-gray-500">4.95</p>
                                                    <p class="ms-1 text-sm font-medium text-gray-500">out of</p>
                                                    <p class="ms-1 text-sm font-medium text-gray-500">5</p>
                                                </div>
                                            </div>

                                            <p class="text-sm font-normal text-gray-900">{{ $review->content }}</p>
                                            @foreach ($reviews as $review)
                                                <div class="border rounded-lg p-4 space-y-3 bg-white shadow-sm">
                                                    <!-- Gambar-gambar Review -->
                                                    @if ($review->reviewImages->count())
                                                        <div class="grid grid-cols-2  gap-3 mt-3">
                                                            @foreach ($review->reviewImages as $image)
                                                                <div class="w-full h-32 bg-gray-100 rounded overflow-hidden">
                                                                    <img src="{{ Storage::url($image->image_path) }}" alt="Review Image" class="w-full h-full object-cover">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-sm text-gray-500">Belum ada review.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div
            class="md:sticky top-2 flex flex-col gap-4 col-span-1 px-4 py-5 bg-white rounded-lg shadow-md border border-gray-200 w-full max-w-full md:max-w-[380px] h-fit"
        >
            {{-- Quantity + Stock Info --}}
           <div class="flex flex-col gap-2">
                @if ($currentVariant)
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <button
                                type="button"
                                wire:click="decrementQuantity"
                                aria-label="Kurangi jumlah"
                                @disabled($quantity === 1)
                                class="h-11 w-11 flex items-center justify-center rounded-l-lg border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors"
                            >
                                <svg class="w-3 h-3 text-gray-700" viewBox="0 0 18 2" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>

                            <input
                                type="number"
                                wire:model.lazy="quantity"
                                inputmode="numeric"
                                min="1"
                                max="{{ $currentVariant->current_stock }}"
                                class="h-11 flex-grow text-center text-gray-900 bg-gray-50 border-t border-b border-gray-300 focus:ring-red-500 focus:border-red-500 focus:outline-none px-2"
                            />

                            <button
                                type="button"
                                wire:click="incrementQuantity"
                                aria-label="Tambah jumlah"
                                @disabled($quantity >= $currentVariant->current_stock)
                                class="h-11 w-11 flex items-center justify-center rounded-r-lg border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors"
                            >
                                <svg class="w-3 h-3 text-gray-700" viewBox="0 0 18 18" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                        </div>

                        <div class="flex-1 flex items-center ps-4">
                            <span class="text-sm text-gray-600 mr-1">Stok:</span>
                            @if($currentVariant->current_stock === 0)
                                <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">Habis</span>
                            @elseif($currentVariant->current_stock <= 10)
                                <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-700 rounded-full">Sisa {{ $currentVariant->current_stock }}</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">{{ $currentVariant->current_stock }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Subtotal --}}
                    <div class="flex justify-between items-center py-2 border-t">
                        <span class="text-gray-500">Subtotal</span>
                        <span class="text-2xl font-bold">@idr($subTotal)</span>
                    </div>
                @else
                    <div class="text-gray-500 text-sm italic">Silakan pilih variasi terlebih dahulu untuk mengatur jumlah dan melihat stok.</div>
                @endif
            </div>


            {{-- Buttons --}}
            <div class="flex flex-col gap-3">
                <button
                    type="button"
                    wire:click="addToCart"
                    wire:loading.attr="disabled"
                    wire:target="addToCart"
                    class="h-11 flex items-center justify-center bg-red-500 text-white font-semibold rounded-lg hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-red-300 transition-colors"
                    @disabled(! $currentVariant || $currentVariant->current_stock === 0 || $quantity < 1)
                >
                    <svg wire:loading wire:target="addToCart" class="w-5 h-5 me-2 text-white animate-spin" viewBox="0 0 100 101" fill="none">
                        <!-- loader SVG -->
                    </svg>
                    <span wire:loading.remove wire:target="addToCart">ADD TO CART</span>
                    <span wire:loading wire:target="addToCart">Menambahkan...</span>
                </button>

                <button
                    type="button"
                    wire:click="purchaseNow"
                    wire:loading.attr="disabled"
                    wire:target="purchaseNow"
                    class="h-11 flex items-center justify-center border border-red-500 text-red-700 font-semibold rounded-lg hover:bg-red-100 focus:ring-2 focus:outline-none focus:ring-red-300 transition-colors"
                    @disabled(! $currentVariant || $currentVariant->current_stock === 0 || $quantity < 1)
                >
                    BELI SEKARANG
                </button>
            </div>


            {{-- Product Features --}}
            <div class="space-y-2 pt-3 border-t">
                <span class="text-lg font-semibold">Fitur</span>
                <ul class="space-y-1">
                    <li class="flex items-center gap-2 text-gray-700">
                        <span class="material-icons text-red-400">workspace_premium</span>
                        Garansi 1 Bulan
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <span class="material-icons text-red-400">local_shipping</span>
                        Pengiriman Hari Sama
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <span class="material-icons text-red-400">headset_mic</span>
                        24/7 Bantuan Pelanggan
                    </li>
                    <li class="flex items-center gap-2 text-gray-700">
                        <span class="material-icons text-red-400">verified_user</span>
                        Pembayaran Terjamin
                    </li>
                </ul>
            </div>
        </div>


        {{-- <div class="flex flex-col w-full items-center gap-4 col-span-1 md:col-span-2">
            REVIEW
        </div> --}}

        <div class="flex flex-col gap-2 lg:col-span-2 border-t-2 pt-5">
            <div class="flex justify-between">
                <span class="text-lg font-semibold">Produk Lainnya</span>
                
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center text-base font-medium text-gray-500">
                    <span class="w-full">Lihat semua</span>
                    <svg class="w-4 h-4 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a> 

            </div>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
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
</div>

<script>
    Livewire.on('variantSelected', colorCode => {
        const items = document.querySelectorAll('[data-carousel-item]');

        items.forEach(item => {
            if (item.dataset.colorCode === colorCode) {
                item.classList.add('active');
                item.classList.remove('hidden');
            } else {
                item.classList.remove('active');
                item.classList.add('hidden');
            }
        });
    });

</script>


