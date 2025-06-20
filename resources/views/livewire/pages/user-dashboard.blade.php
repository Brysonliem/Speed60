
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
            <h2 class="font-bold text-[30px] mb-4 text-center">
                Category Motorcycle
            </h2>
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


