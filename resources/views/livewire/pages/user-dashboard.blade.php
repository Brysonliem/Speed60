
<div>
    <!-- Drawer Component -->
    <div id="drawer-top-example"
        class="fixed top-0 left-0 right-0 z-50 w-full bg-white shadow-lg transition-transform -translate-y-full"
        tabindex="-1" aria-labelledby="drawer-top-label">

        <div class="max-w-6xl mx-auto h-full px-4 py-6 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-center gap-8 md:gap-12 min-h-[300px]">

            <!-- Gambar -->
            <div class="w-full md:w-1/3 flex justify-center md:justify-end">
                <img src="{{ asset('/images/promo_image_speed60.jpg') }}"
                    alt="Promo Image"
                    class="w-48 h-48 md:w-72 md:h-72 object-cover rounded-md shadow-md" />
            </div>

                   <!-- Konten -->
            <div class="w-full md:w-2/3 text-center md:text-left flex flex-col justify-center">
                <div class="text-center md:text-left">
                    <h2 class="text-xl sm:text-3xl font-bold text-gray-800">
                        Want <span class="text-red-500">10% OFF*</span>
                    </h2>
                    <h2 class="text-xl sm:text-3xl font-bold text-gray-800">
                        Your First Order?
                    </h2>
                </div>

                <!-- Form -->
                <form class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-2xl w-full">
                    @csrf

                    <!-- Email - Full width -->
                    <div class="sm:col-span-2">
                        <input type="email" name="email" required placeholder="Email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <!-- First Name -->
                    <div>
                        <input type="text" name="first_name" required placeholder="First Name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <input type="text" name="last_name" required placeholder="Last Name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <!-- Date of Birth - Full width -->
                    <div class="sm:col-span-2">
                        <input type="date" name="dob" required placeholder="Date of Birth"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" />
                    </div>

                    <!-- Submit Button - Full width -->
                    <div class="sm:col-span-2">
                        <button type="submit"
                                class="w-full px-6 py-3 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition">
                            Get 10% Off
                        </button>
                    </div>
                </form>
            </div>

        </div>


        <!-- Tombol Tutup -->
        <button type="button"
            data-drawer-hide="drawer-top-example"
            aria-controls="drawer-top-example"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="sr-only">Tutup</span>
        </button>
    </div>


    @livewire('components.carousel',[
        "images" => [
            "/images/Slide 1 rev.jpg",
            "/images/Slide 2 New.jpg",
            "/images/Slide 3 Rev.jpg",  
            "/images/Slide 6 v1.jpg",
        ]
    ])
<div class="flex flex-col gap-4 p-4 md:p-8">
<div class="">
    <div class="px-3 lg:px-40"> 
    {{-- information section --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-10">

            {{-- Ad --}}
            <div class="col-span-5 lg:col-span-1">
                <div
                    class="flex flex-row lg:flex-col items-center gap-3 w-full max-w-xs lg:max-w-[200px] p-4 sm:p-6 bg-gray-900 border border-gray-200 rounded-lg shadow-sm hover:bg-gray-800 mx-auto"
                >
                    <!-- Gambar -->
                    <img
                    class="w-24 sm:w-full h-auto rounded-lg"
                    src="{{ asset('images/ad.png') }}"
                    alt="image description"
                    />

                    <!-- Konten -->
                    <div class="flex flex-col text-white text-sm text-left lg:text-center flex-1">
                    <span class="font-light">Gratis Gantungan Kunci Min Pembelian</span>
                    <span class="text-lg sm:text-xl">Rp 199.000 - <br class="hidden sm:block" />Stok Terbatas</span>

                    <button
                        type="button"
                        class="mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                        Belanja Sekarang
                    </button>
                    </div>
                </div>
            </div>



            {{-- content --}}
            <div class="col-span-4">
                <div class="flex flex-col gap-2">
                    {{-- tab --}}
                    
                    @livewire('components.product-radio-filter')
            
                    {{-- products content --}}

                    <div class="grid md:grid-cols-6 h-full grid-cols-2 gap-2 mt-4">
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
            <div class="flex items-center lg:justify-center gap-3 sm:gap-4 p-3">
                @php
                    $vehicles = [
                        ['src' => 'images/1.jpg', 'alt' => 'NMAX', 'label' => 'NMAX '],
                        ['src' => 'images/2.jpg', 'alt' => 'HONDA VARIO', 'label' => 'HONDA VARIO'],
                        ['src' => 'images/3.jpg', 'alt' => 'RX KING', 'label' => 'RX KING'],
                        ['src' => 'images/4.jpg', 'alt' => 'SATRIA FU RAIDER', 'label' => 'SATRIA FU RAIDER'],
                        ['src' => 'images/5.jpg', 'alt' => 'YAMAHA MIO', 'label' => 'YAMAHA MIO'],
                        ['src' => 'images/6.jpg', 'alt' => 'PCX ADV', 'label' => 'PCX ADV'],
                    ];
                @endphp

                @foreach ($vehicles as $vehicle)
                    <a href="{{ route('products.index') }}" class="min-w-fit flex flex-col items-center">
                        <div class="w-24 sm:w-28 md:w-32 lg:w-36 aspect-square rounded-md overflow-hidden bg-gray-100">
                            <img src="{{ asset($vehicle['src']) }}" alt="{{ $vehicle['alt'] }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                        </div>

                        <p class="mt-1 text-xs text-center font-medium leading-tight">
                            {{ $vehicle['label'] }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>


    </div>
    <div class="tiktok-wrapper">
        <blockquote 
            class="tiktok-embed" 
            cite="https://www.tiktok.com/@speed60_id/video/7497188594050747653" 
            data-video-id="7497188594050747653" > 
                <section></section>
        </blockquote> 
        
        <blockquote 
            class="tiktok-embed" 
            cite="https://www.tiktok.com/@speed60_id/video/7512035906648296710" 
            data-video-id="7512035906648296710" 
            > 
            <section> 
            </section>
        </blockquote>
        
        <blockquote 
            class="tiktok-embed" 
            cite="https://www.tiktok.com/@speed60_id/video/7486055971479883063" 
            data-video-id="7486055971479883063" 
        > 
            <section></section>
        </blockquote> 
    </div>

    <script async src="https://www.tiktok.com/embed.js"></script>


   
</div>
</div>

</div>


