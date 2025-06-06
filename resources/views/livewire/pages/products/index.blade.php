<div class="flex flex-col gap-4 p-4 md:p-8">
    <!-- Breadcrumb -->
    {{-- @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Produk', 'url' => route('products.index')],
    ]]) --}}

    <div class="grid grid-cols-5 gap-4 mb-10">
        {{-- menu radio --}}
        <div class="col-span-1">
            <div class="flex flex-col gap-3 max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow-sm">
                <span class="text-lg font-semibold">Produk</span>
                <div class="flex items-center">
                    <input id="default-radio-1" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 ">Semua Produk</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Vario - Scoopy - Beat</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">PCX - ADV</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Mio - Nouvo - Freego</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Baut M 4 Drat 6</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Baut M 5 Drat 8</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Baut M 6 Drat 10</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Baut M 8 Drat 12</label>
                </div>
                <div class="flex items-center">
                    <input checked id="default-radio-2" type="radio" value="" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 ">Baut M 10 Drat 14</label>
                </div>
            </div>
        </div>

        <div class="col-span-4">
            <div class="flex flex-col gap-2">
                {{-- Filter search --}}
                <div class="flex items-center">
                    {{-- Search input --}}
                    <form class="w-full max-w-md">
                        <label for="search-input" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="search-input" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search..." required />
                            <button type="submit" class="text-white absolute end-2.5 bottom-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                Search
                            </button>
                        </div>
                    </form>
        
                    {{-- Select Sort By --}}
                    <div class="ms-auto">
                        <select id="sort-by" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <option value="latest">Sort by: Latest</option>
                            <option value="popular">Sort by: Popular</option>
                            <option value="price_low">Sort by: Price (Low to High)</option>
                            <option value="price_high">Sort by: Price (High to Low)</option>
                        </select>
                    </div>
                </div>
                <span class="text-lg font-semibold">Semua Produk</span>

                @if (Session::has('success'))
                    <div id="toast-success" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm " role="alert">
                        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg ">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="sr-only">Check icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">Berhasil menambahkan ke cart!</div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif

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
  
</div>