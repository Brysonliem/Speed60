
<div>
    @livewire('components.carousel',[
        "images" => [
            "/images/Slide 1 rev.jpg",
            "/images/Slide 2 New.jpg",
            "/images/Slide 3 Rev.jpg",  
            "/images/Slide 6 v1.jpg",
        ]
    ])
<div class="flex flex-col gap-4 p-4 md:p-8">
<div class=" mt-10">
   <div class="px-3 lg:px-40"> 
    {{-- information section --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-10">

        {{-- Ad --}}
        <div class="col-span-5 lg:col-span-1">
            <div class="text-center flex flex-col gap-3 max-w-sm p-6 bg-gray-900 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-800">
                <span class="text-sm font-light text-white">Gratis Gantungan Kunci Min Pembelian</span>
                <span class="text-xl  text-white">Rp 199.000 - <br> Stok Terbatas</span>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Belanja Sekarang
                </button>
                
                <img class="h-auto max-w-lg rounded-lg mt-4" src="{{ asset('images/ad.png') }}" alt="image description">

            </div>
        </div>

        {{-- content --}}
        <div class="col-span-4">
            <div class="flex flex-col gap-2">
                {{-- tab --}}
                
                @livewire('components.product-radio-filter')
        
                {{-- products content --}}

                <div class="grid md:grid-cols-6 h-full grid-cols-2 gap-2 mt-4">
                    {{-- @livewire('components.product-card', [
                        'product' => [
                            "id" => 1,
                        ],
                        'image' => '/images/product.png',
                        'title' => "Product Test",
                        'discount_percentage'=> 55,
                        'price' =>  number_format(1000000, 0, ',', '.'),
                        'rating' => round(3, 2),
                        'reviews' => 100 
                    ])
                    @livewire('components.product-card', [
                        'product' => [
                            "id" => 1,
                        ],
                        'image' => '/images/product.png',
                        'title' => "Product Test",
                        'discount_percentage'=> 55,
                        'price' =>  number_format(1000000, 0, ',', '.'),
                        'rating' => round(3, 2),
                        'reviews' => 100 
                    ])
                    @livewire('components.product-card', [
                        'product' => [
                            "id" => 1,
                        ],
                        'image' => '/images/product.png',
                        'title' => "Product Test",
                        'discount_percentage'=> 55,
                        'price' =>  number_format(1000000, 0, ',', '.'),
                        'rating' => round(3, 2),
                        'reviews' => 100 
                    ])
                    @livewire('components.product-card', [
                        'product' => [
                            "id" => 1,
                        ],
                        'image' => '/images/product.png',
                        'title' => "Product Test",
                        'discount_percentage'=> 55,
                        'price' =>  number_format(1000000, 0, ',', '.'),
                        'rating' => round(3, 2),
                        'reviews' => 100 
                    ]) --}}
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
                        ])
                    @endforeach
                </div>                
            </div>
        </div>
    </div>

    <div class="w-full overflow-x-auto">
        <div class="flex items-center lg:justify-center gap-6 p-4">
            <div class="min-w-fit w-24 flex flex-col items-center">  
                <img src="images/1.jpg" alt="NMAX - AEROX - XMAX - LEXI" class="w-32 lg:w-full rounded-xl">
                <p class="mt-2 text-sm font-medium">NMAX - AEROX - XMAX - LEXI</p>
            </div>
            <div class="min-w-fit w-24 flex flex-col items-center">
                <img src="images/2.jpg" alt="HONDA VARIO - SCOOPY - BEAT" class="w-32 lg:w-full rounded-xl">
                <p class="mt-2 text-sm text-center font-medium">HONDA VARIO - SCOOPY - BEAT</p>
            </div>
            <div class="min-w-fit w-24 flex flex-col items-center">
                <img src="images/3.jpg" alt="RX KING" class="w-32 lg:w-full rounded-xl">
                <p class="mt-2 text-sm font-medium">RX KING</p>
            </div>
            <div class="min-w-fit w-24 flex flex-col items-center">
                <img src="images/4.jpg" alt="SATRIA FU RAIDER" class="w-32 lg:w-full rounded-xl">
                <p class="mt-2 text-sm font-medium">SATRIA FU RAIDER</p>
            </div>
            <div class="min-w-fit w-24 flex flex-col items-center">
                <img src="images/5.jpg" alt="YAMAHA MIO - FINO - NOUVO" class="w-32 lg:w-full rounded-xl">
                <p class="mt-2 text-sm font-medium">YAMAHA MIO - FINO - NOUVO</p>
            </div>
            <div class="min-w-fit w-24 flex flex-col items-center">
                <img src="images/6.jpg" alt="PCX ADV" class="w-32 lg:w-full rounded-xl">
                <p class="mt-2 text-sm font-medium">PCX ADV</p>
            </div>
        </div>         
        </div> 
    </div>


    @livewire('components.carousel',[
        "images" => [
            "/images/assets/influence/7.jpg",
            "/images/assets/influence/8.jpg",
            "/images/assets/influence/11.jpg",  
            "/images/assets/influence/12.jpg",
            "/images/assets/influence/13.jpg",
            "/images/assets/influence/14.jpg",
        ]
    ])
   
   <div class="px-5 md:px-40 my-10">


    <div class="flex flex-col gap-4">
        <span class="text-2xl font-bold text-center">Kebijakan Toko</span>
        
        <div id="accordion-flush" data-accordion="collapse" data-active-classes="text-gray-900 dark:text-gray-900" data-inactive-classes="text-gray-500 dark:text-gray-400">
            <h2 id="accordion-flush-heading-1">
            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                <span>What is Flowbite?</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
            </h2>
            <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of interactive components built on top of Tailwind CSS including buttons, dropdowns, modals, navbars, and more.</p>
                <p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a href="/docs/getting-started/introduction/" class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and start developing websites even faster with components on top of Tailwind CSS.</p>
            </div>
            </div>
            <h2 id="accordion-flush-heading-2">
            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                <span>Is there a Figma file available?</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
            </h2>
            <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and designed using the Figma software so everything you see in the library has a design equivalent in our Figma file.</p>
                <p class="text-gray-500 dark:text-gray-400">Check out the <a href="https://flowbite.com/figma/" class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a> based on the utility classes from Tailwind CSS and components from Flowbite.</p>
            </div>
            </div>
            <h2 id="accordion-flush-heading-3">
            <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-3" aria-expanded="false" aria-controls="accordion-flush-body-3">
                <span>What are the differences between Flowbite and Tailwind UI?</span>
                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                </svg>
            </button>
            </h2>
            <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
            <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                <p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core components from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product. Another difference is that Flowbite relies on smaller and standalone components, whereas Tailwind UI offers sections of pages.</p>
                <p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using both Flowbite, Flowbite Pro, and even Tailwind UI as there is no technical reason stopping you from using the best of two worlds.</p>
                <p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:</p>
                <ul class="ps-5 text-gray-500 list-disc dark:text-gray-400">
                <li><a href="https://flowbite.com/pro/" class="text-blue-600 dark:text-blue-500 hover:underline">Flowbite Pro</a></li>
                <li><a href="https://tailwindui.com/" rel="nofollow" class="text-blue-600 dark:text-blue-500 hover:underline">Tailwind UI</a></li>
                </ul>
            </div>
            </div>
        </div>
    </div>


   </div>
    
</div>

    <div class="flex flex-col bg-gray-800 text-white px-5 md:px-40 py-6 gap-12">
        <div class="flex items-center justify-between">
            <div class="flex flex-col gap-2">
                <span class="font-light">Featured Products</span>
                <span class="text-xl font-bold">BESTSELLER PRODUCTS</span>
            </div>
        
            <button type="button" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Belanja Sekarang
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3  lg:max-w-6xl lg:mx-auto ">
            <div class="flex flex-col gap-3 flex-1">
                <span class="text-xl font-medium">Hubungi Kami</span>
                <div class="flex flex-col">
                    <span class="text-lg font-light">0889-7697-2688</span>
                    <span class="text-lg font-light">speed@gmail.com</span>
                </div>
            </div>
        
            <div class="flex flex-col gap-3 flex-1">
                <span class="text-xl font-medium">Ikuti Kami</span>
                <div class="flex flex-col">
                    <span class="text-lg font-light">Tokopedia</span>
                    <span class="text-lg font-light">Tiktok Shop</span>
                    <span class="text-lg font-light">Shopee</span>
                    <span class="text-lg font-light">Lazada</span>
                </div>
            </div>
        
            <!-- Lokasi -->
            <div class="flex flex-col gap-3 flex-1">
                <span class="text-xl font-medium">Lokasi</span>
                <div class="flex flex-col rounded-lg">
                    <span class="text-lg font-light">JL Pangeran Tubagus Angke No 20, Ruko Angke Megah Blok B 15 - 16, Jl. Pangeran Tubagus Angke No.20/B 16, RT.13/RW.7, Jelambar Baru, Grogol Petamburan, Jakarta 11460</span>
                </div>
            </div>
        </div>
        
    </div>


</div>

</div>


