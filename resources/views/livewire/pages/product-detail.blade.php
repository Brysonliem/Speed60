<div class="flex flex-col gap-4">
    <!-- Breadcrumb -->
    @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Produk', 'url' => route('products.index')],
        ['name' => 'Probolt Titanium', 'url' => route('products.detail', ['product' => 7])]
    ]])

    <div class="grid grid-cols-6 gap-2">
        <div class="col-span-3">
            {{-- products image --}}
            <div id="indicators-carousel" class="relative w-full" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <img src="{{ asset('images/product.png') }}" 
                            class="absolute inset-0 m-auto max-w-full max-h-full"
                            alt="...">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/product.png') }}" 
                            class="absolute inset-0 m-auto max-w-full max-h-full"
                            alt="...">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/product.png') }}" 
                            class="absolute inset-0 m-auto max-w-full max-h-full"
                            alt="...">
                    </div>
                    <!-- Item 4 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/product.png') }}" 
                            class="absolute inset-0 m-auto max-w-full max-h-full"
                            alt="...">
                    </div>
                    <!-- Item 5 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ asset('images/product.png') }}" 
                            class="absolute inset-0 m-auto max-w-full max-h-full"
                            alt="...">
                    </div>
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

        <div class="col-span-3 ">
            <div class="flex flex-col gap-3">

                {{-- title product --}}
                <span class="text-lg font-semibold">
                    Probolt Titanium NT Baut DUdukan Knalpot Kawasaki Ninja R RR SS Grade 5 King Nut New Tech - Athena
                </span>

                {{-- information product --}}
                <div class="flex justify-between">
                    <div class="flex flex-col gap-2">
                        <span class="text-sm text-gray-500">Sisa Stok : 
                            <span class="text-black">500</span></span>
                        <span class="text-sm text-gray-500">Kondisi : 
                            <span class="text-black">BARU</span>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="text-sm text-gray-500">Stock : 
                            <span class="bg-green-100 text-green-600 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm ">
                                Tersedia
                            </span>
                        </span>
                        <span class="text-sm text-gray-500">Category :  
                            <span class="text-black">Electronics Devices</span>
                        </span>
                    </div>
                </div>

                {{-- price --}}
                <span class="text-2xl text-blue-400 font-semibold">Rp 130.000</span>

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
                    <form class="max-w-xs">
                        <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 ">Quantity :</label>
                        <div class="relative flex items-center max-w-[8rem]">
                            <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            <input type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 " placeholder="999" required />
                            <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <button 
                        type="button" 
                        class="px-5 h-11 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-2 focus:outline-none focus:ring-blue-300"
                        
                    >
                        ADD TO CART
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
                <div class="hidden p-4 rounded-lg " id="description" role="tabpanel" aria-labelledby="description-tab">
                    <p class="text-sm text-gray-600 ">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores, ratione. Natus esse assumenda, in ducimus expedita perferendis quam obcaecati nulla soluta velit voluptatum iusto. Quis libero impedit itaque sit fugit!
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
            @for ($i = 0; $i < 5; $i++)
                @livewire('components.product-card', [
                    'image' => 'images/product.png',
                    'title' => 'Titanium Hardware Valve Cover Kit - Honda K20/K24 Titanium',
                    'price' => 'Rp 130.000',
                    'rating' => 4.95,
                    'reviews' => 73
                ])
            @endfor
        </div>
    </div>
</div>
