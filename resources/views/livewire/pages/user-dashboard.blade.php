<div x-data x-on:open-modal.window="$store.modal.show($event.detail)">
    <!-- Drawer Component -->
    @auth
        @livewire('components.voucher-modal')
    @endauth


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
        <div class="grid grid-cols-1 lg:grid-cols-6 gap-4 mb-10">


            {{-- content --}}
            <div class="col-span-6">
                <div class="flex flex-col gap-2">
                    
                    {{-- Voucher Section --}}
                    <div class="overflow-x-auto sm:overflow-visible scrollbar-hide">
                        <div class="flex sm:grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($vouchers as $voucher)
                                <div class="min-w-[240px] sm:min-w-0 flex border border-red-500 rounded-lg overflow-hidden bg-white hover:shadow-md transition-shadow duration-200">
                                    {{-- Kiri (diskon) --}}
                                    <div class="bg-red-500 text-white px-4 py-6 flex flex-col items-start justify-start w-24 sm:w-28">
                                        <span class="text-base sm:text-xl font-bold leading-5">{{ $voucher['voucher_discount_percentage'] }} %</span>
                                        <span class="text-xs sm:text-sm font-medium">{{ $voucher['voucher_name'] }}</span>
                                    </div>

                                    {{-- Kanan (deskripsi) --}}
                                    <div class="flex-1 p-3 sm:p-4 flex flex-col justify-between">
                                        <div class="text-gray-800 text-xs sm:text-sm font-medium mb-1">
                                            {{ $voucher['voucher_description'] }}
                                        </div>
                                        <div class="text-gray-500 text-[10px] sm:text-xs mb-2">
                                            Min. belanja {{ $voucher['voucher_minimum_transaction'] }} • Berlaku s/d {{ $voucher['voucher_end_date'] }}
                                        </div>
                                        <div>
                                            <button class="text-xs sm:text-sm font-semibold text-red-500 border border-red-500 rounded px-2 py-1 sm:px-3 hover:bg-red-50 transition">
                                                Gunakan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>




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
                    
                    {{-- blade component --}}
                    @livewire('components.cart-modal')
                    {{-- <x-cart-modal /> --}}
                </div>
            </div>
        </div>

        <div class="w-full overflow-x-auto px-3 lg:px-40">
            <div class="flex items-center lg:justify-center gap-3 sm:gap-4 p-3">
                @php
                    $vehicles = [
                        ['src' => 'images/1.jpg', 'alt' => 'NMAX', 'label' => 'NMAX', 'code' => 'nmax'],
                        ['src' => 'images/2.jpg', 'alt' => 'HONDA VARIO', 'label' => 'HONDA VARIO 160', 'code' => 'vario-160'],
                        ['src' => 'images/3.jpg', 'alt' => 'RX KING', 'label' => 'RX KING', 'code' => 'rx-king'],
                        ['src' => 'images/4.jpg', 'alt' => 'SATRIA FU RAIDER', 'label' => 'SATRIA FU', 'code' => 'satria-fu'],
                        ['src' => 'images/5.jpg', 'alt' => 'YAMAHA MIO', 'label' => 'YAMAHA MIO M3', 'code' => 'mio-m3'],
                        ['src' => 'images/6.jpg', 'alt' => 'PCX ADV', 'label' => 'PCX 160', 'code' => 'pcx-160'],
                    ];
                @endphp

                @foreach ($vehicles as $vehicle)
                    <a href="{{ route('products.index', ['motor_type' => $vehicle['code']]) }}" class="min-w-fit flex flex-col items-center">
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

    <div class="video">
        <video autoplay muted loop playsinline class="rounded-xl shadow-md w-full h-auto">
            <source src="{{ asset('videos/slideshooww.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

<div class="relative rounded-3xl overflow-hidden shadow-lg mt-6 mx-4 md:mx-16">
  <!-- Gambar background -->
  <img src="/images/kawasakis60.png" alt="Kawasaki Display" class="w-full h-[400px] md:h-[500px] object-cover object-center">

  <!-- Overlay hitam 60% -->
  <div class="absolute inset-0 bg-black/60"></div>

  <!-- Overlay Text dan Button -->
  <div class="absolute inset-0 flex flex-col items-center justify-center text-white text-center p-4 md:p-6 z-10">
    <h2 class="text-xl sm:text-2xl md:text-4xl font-bold mb-3 md:mb-4">
      Elevate Your Ride with Premium Motorcycle Parts
    </h2>
    <p class="text-xs sm:text-sm md:text-lg mb-4 md:mb-6 max-w-sm sm:max-w-md md:max-w-xl">
      Discover high-performance components that bring out the best in your machine. Quality, precision, and speed—all in one place.
    </p>
    <a href="{{ route('category', ['category' => 'kawasaki']) }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 md:py-3 md:px-6 rounded-full transition duration-300 text-sm md:text-base">
      Get Your Bolts Now →
    </a>
  </div>
</div>


</div>
</div>


