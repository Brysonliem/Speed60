<div class="flex flex-col gap-4">
    <!-- Breadcrumb -->
    {{-- @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Produk', 'url' => route('products.index')],
        ['name' => 'Probolt Titanium', 'url' => route('products.detail', ['product' => 7])]
    ]]) --}}

    <div class="grid grid-cols-6 gap-2">
        <div class="col-span-3">
            {{-- products image --}}
            <div id="indicators-carousel" class="relative w-full" data-carousel="static">
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

        <div class="col-span-3">
            <div class="flex flex-col gap-3">

                {{-- title product --}}
                <span class="text-lg font-semibold">
                    {{ $detailProduct->name }}
                </span>

                {{-- information product --}}
                <div class="flex justify-between">
                    <div class="flex flex-col gap-2">
                        <span class="text-sm text-gray-500">Sisa Stok : 
                            <span class="text-black">{{ $detailProduct->current_stock }}</span></span>
                        <span class="text-sm text-gray-500">Kondisi : 
                            <span class="text-black">{{$detailProduct->condition}}</span>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-sm text-gray-500">Stock : 
                            <span class="text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm 
                                {{ $detailProduct->current_stock > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                TERSEDIA
                            </span>

                        </span>
                        <span class="text-sm text-gray-500">Category :  
                            <span class="text-black">{{ $detailProduct->productType->name }}</span>
                        </span>
                    </div>
                </div>

                {{-- price --}}
                <span class="text-2xl text-blue-400 font-semibold">@idr($detailProduct->price)</span>

                {{-- divider --}}
                <div class="w-full border-t border-gray-300 my-4"></div>


                {{-- choosing types --}}
                <div class="grid grid-cols-2">
                    <div class="col-span-1"> 
                        <div class="flex flex-col gap-4">
                            <span class="text-gray-600">Warna : Abu Abu</span>
                            <div class="flex gap-2 flex-wrap">
                                <div class="flex items-center me-4">
                                    <input checked id="red-radio" type="radio" name="colored-radio" class="w-6 h-6 scale-150 text-gray-600 bg-gray-100 border-gray-300 focus:ring-gray-500 focus:ring-2">
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="green-radio" type="radio" name="colored-radio" class="w-6 h-6 scale-150 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-2">
                                </div>
                                <div class="flex items-center me-4">
                                    <input id="purple-radio" type="radio" name="colored-radio" class="w-6 h-6 scale-150 text-purple-600 bg-gray-100 border-gray-300 focus:ring-purple-500 focus:ring-2">
                                </div>
                            </div>
                        </div>     
                    </div>
                    <div class="col-span-1">
                        <div class="flex flex-col gap-3">
                            <span class="text-gray-500">Pilih Set : </span>
                            <div class="grid grid-cols-2 gap-2">
                                <button type="button" class="text-blue-500 border border-blue-500 hover:bg-blue-200 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    1 Set 2 Baut
                                </button>
                                <button type="button" class="text-blue-500 border border-blue-500 hover:bg-blue-200 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    1 Set 2 Baut
                                </button>
                                <button type="button" class="text-blue-500 border border-blue-500 hover:bg-blue-200 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    1 Set 2 Baut
                                </button>
                                <button type="button" class="text-blue-500 border border-blue-500 hover:bg-blue-200 focus:ring-2 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    1 Set 2 Baut
                                </button>
                            </div>                            
                        </div>
                    </div>
                </div>

                {{-- buttons of actions --}}
                <div class="flex items-end gap-4 ms-auto">

                    {{-- quantity button --}}
                    <div class="max-w-xs">
                        <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 ">Quantity :</label>
                        <div class="relative flex items-center max-w-[8rem]">
                            <button wire:click="incrementQuantity" type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            <input wire:model="quantity" type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 " placeholder="999" required />
                            <button wire:click="decrementQuantity" type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
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
                            <div class="ms-3 text-sm font-normal">Berhasil menambahkan ke cart!</div>
                            <button x-on:click="show = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                    @endif

                    <button
                        type="button"
                        wire:click="addToCart"
                        wire:loading.attr="disabled"
                        wire:target="addToCart"
                        class="px-5 h-11 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300 inline-flex items-center justify-center"
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


                    <button wire:click="redirectCheckout" type="button" class="px-5 h-11 text-base font-medium text-center text-blue-700 rounded-lg border border-blue-500 hover:bg-blue-100 focus:ring-2 focus:outline-none focus:ring-blue-300">
                        BELI SEKARANG
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- tabs description --}}
    <div class="grid grid-cols-3">
        <div class="col-span-2">
            <div class="mb-4 border-b border-gray-200 ">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg" id="description-tab" data-tabs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="false">DESKRIPSI</button>
                    </li>
                    <li class="me-2" role="presentation">
                        <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300" id="review-tab" data-tabs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">ULASAN</button>
                    </li>
                </ul>
            </div>
            <div id="default-tab-content">
                <div class="hidden p-4 rounded-lg " id="description" role="tabpanel" aria-labelledby="description-tab" wire:ignore>
                    <p class="text-sm text-gray-600 ">
                        {{ $detailProduct->description }}
                    </p>
                </div>
                <div class="hidden p-4 rounded-lg " id="review" role="tabpanel" aria-labelledby="review-tab">
                    <p class="text-sm text-gray-600 ">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                </div>
            </div>
        </div>
        <div class="col-span-1 flex justify-center items-center">
            <div class="flex flex-col gap-3 py-10">
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
        </div>        
    </div>

    <div class="flex flex-col gap-2">
        <span class="text-lg font-semibold">Produk Lainnya</span>
        <div class="grid grid-cols-4 gap-3">
            @foreach ($products as $product)
                @livewire('components.product-card', [
                    'product' => $product,
                    'image' => $product['product_images'][0]['image_path'] ?
                               asset('storage/'.$product['product_images'][0]['image_path']) : 
                               'images/default.png',
                    'title' => $product['name'],
                    'price' => 'Rp. ' . number_format($product['price'], 0, ',', '.'),
                    'rating' => round($product['reviews_avg_rating_point'], 2),
                    'reviews' => $product['reviews_count']
                ])
            @endforeach
        </div>
    </div>
</div>
