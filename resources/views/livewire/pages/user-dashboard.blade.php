<div class="flex flex-col gap-4 ">
    {{-- image section --}}
    <div class="flex items-center min-h-screen z-0">
        <figure class="relative w-full transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
            <a href="#">
                <img class="rounded-lg w-full" src="{{ asset('images/dashboard-imgs.jpg') }}" alt="image description">
            </a>
            <figcaption class="absolute inset-0 flex flex-col justify-center items-center text-center bg-gradient-to-t from-black/70 via-black/30 to-transparent rounded-lg p-4">
                <span class="text-5xl text-white mb-4 font-bold">
                    ONE STOP DETAILING <br> SOLUTION!
                </span>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Belanja Sekarang
                </button>
                {{-- <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    Notify Me
                </button> --}}
            </figcaption>
        </figure>
    </div>
    
    {{-- information section
    <div class="grid grid-cols-4 gap-10 mb-5">
        <!-- Item 1 -->
        <div class="flex items-center gap-5">
            <img src="{{ asset('icons/good-service.svg') }}" alt="Good Service" class="w-16 h-16">
            <div class="flex flex-col gap-2">
                <span class="mt-2 text-xl font-semibold">Produk Terjamin</span>
                <span class="text-lg font-light">Dari material terbaik</span>
            </div>
        </div>
        
        <!-- Item 2 -->
        <div class="flex items-center gap-5">
            <img src="{{ asset('icons/good-support.svg') }}" alt="Good Support" class="w-16 h-16">
            <div class="flex flex-col gap-2">
                <span class="mt-2 text-xl font-semibold">Garansi Produk</span>
                <span class="text-lg font-light">Garansi 2 Bulan</span>
            </div>
        </div>
        
        <!-- Item 3 -->
        <div class="flex items-center gap-5">
            <img src="{{ asset('icons/good-security.svg') }}" alt="Good Security" class="w-16 h-16">
            <div class="flex flex-col gap-2">
                <span class="mt-2 text-xl font-semibold">Transaksi Terjamin</span>
                <span class="text-lg font-light">Jaminan Transaksi</span>
            </div>
        </div>
        
        <!-- Item 4 -->
        <div class="flex items-center gap-5">
            <img src="{{ asset('icons/good-waranty.svg') }}" alt="Good Warranty" class="w-16 h-16">
            <div class="flex flex-col gap-2">
                <span class="mt-2 text-xl font-semibold">24/7 Support</span>
                <span class="text-lg font-light">Support 24 Jam</span>
            </div>
        </div>
    </div> --}}

    <div class="grid grid-cols-5 gap-4 mb-10">

        {{-- Ad --}}
        <div class="col-span-1">
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
                <div class="flex">
                    <div class="text-sm font-medium text-center text-gray-500 dark:text-gray-400 dark:border-gray-700">
                        <ul class="flex flex-wrap -mb-px">
                            <li class="me-2">
                                <a href="#" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500" aria-current="page">
                                    Best Seller Produk
                                </a>
                            </li>
                            <li class="me-2">
                                <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                                    PCR - ADV
                                </a>
                            </li>
                            <li class="me-2">
                                <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                                    NMAX - Aerox - Lexi
                                </a>
                            </li>
                            <li class="me-2">
                                <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                                    Satria FU Rider
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
        
                {{-- products content --}}
                <div class="grid grid-cols-3 gap-3">
                    @foreach ($products as $product)
                        @livewire('components.product-card', [
                            'product' => $product,
                            'image' => $product['product_images'][0]['image_path'] ?? 'images/default.png',
                            'title' => $product['name'],
                            'price' => 'Rp ' . number_format($product['price'], 0, ',', '.'),
                            'rating' => round($product['reviews_avg_rating_point'], 2),
                            'reviews' => $product['reviews_count']
                        ])
                    @endforeach
                </div>                
            </div>
        </div>
    </div>

    <div class="flex flex-wrap justify-center gap-6 p-4">
        <div class="w-40 text-center">  
          <img src="images/1.jpg" alt="NMAX - AEROX - XMAX - LEXI" class="w-full rounded-xl">
          <p class="mt-2 text-sm font-medium">NMAX - AEROX - XMAX - LEXI</p>
        </div>
        <div class="w-40 text-center">
          <img src="images/2.jpg" alt="HONDA VARIO - SCOOPY - BEAT" class="w-full rounded-xl">
          <p class="mt-2 text-sm font-medium">HONDA VARIO - SCOOPY - BEAT</p>
        </div>
        <div class="w-40 text-center">
          <img src="images/3.jpg" alt="RX KING" class="w-full rounded-xl">
          <p class="mt-2 text-sm font-medium">RX KING</p>
        </div>
        <div class="w-40 text-center">
          <img src="images/4.jpg" alt="SATRIA FU RAIDER" class="w-full rounded-xl">
          <p class="mt-2 text-sm font-medium">SATRIA FU RAIDER</p>
        </div>
        <div class="w-40 text-center">
          <img src="images/5.jpg" alt="YAMAHA MIO - FINO - NOUVO" class="w-full rounded-xl">
          <p class="mt-2 text-sm font-medium">YAMAHA MIO - FINO - NOUVO</p>
        </div>
        <div class="w-40 text-center">
          <img src="images/6.jpg" alt="PCX ADV" class="w-full rounded-xl">
          <p class="mt-2 text-sm font-medium">PCX ADV</p>
        </div>
      </div>         
    
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

    <div class="-mx-40 flex flex-col bg-gray-800 text-white px-40 py-6 gap-12">
        <div class="flex items-center justify-between">
            {{-- TITLE --}}
            <div class="flex flex-col gap-2">
                <span class="font-light">Featured Products</span>
                <span class="text-xl font-bold">BESTSELLER PRODUCTS</span>
            </div>
        
            {{-- BUTTON TITLE --}}
            <button type="button" 
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Belanja Sekarang
            </button>
        </div>

        <div class="flex justify-between  max-w-6xl mx-auto ">
            <!-- Hubungi Kami -->
            <div class="flex flex-col gap-3 flex-1">
                <span class="text-xl font-medium">Hubungi Kami</span>
                <div class="flex flex-col">
                    <span class="text-lg font-light">0889-7697-2688</span>
                    <span class="text-lg font-light">speed@gmail.com</span>
                </div>
            </div>
        
            <!-- Ikuti Kami -->
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