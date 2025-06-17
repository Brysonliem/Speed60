<div class="flex flex-col gap-4 p-4 md:p-8 min-h-screen">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">

        <!-- Drawer filter untuk mobile & sidebar untuk desktop -->
        <div id="drawer-filter"
            class="fixed top-0 left-0 z-50 w-72 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white border-r md:relative md:translate-x-0 md:block md:h-auto md:border md:rounded-lg"
            tabindex="-1" aria-labelledby="drawer-filter-label">

            <!-- Header drawer -->
            <h5 id="drawer-filter-label"
                class="mb-6 text-base font-semibold text-gray-500 uppercase md:hidden">
                Filter
            </h5>
            <button type="button" data-drawer-hide="drawer-filter" aria-controls="drawer-filter"
                class="md:hidden text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1 absolute top-4 right-4">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <!-- Form Filter -->
            <div class="flex flex-col gap-6">

                <!-- Filter Tipe Motor -->
                <div class="flex flex-col">
                    <span class="text-lg font-semibold mb-2">Tipe Motor</span>

                    <div class="flex flex-col gap-2 overflow-y-auto max-h-[50vh] pe-2">
                        <div class="flex items-center">
                            <input wire:model="selectedCategoryCode" type="radio" id="all" value="" class="w-4 h-4">
                            <label for="all" class="ms-2 text-sm font-medium">Semua Tipe</label>
                        </div>

                        @foreach($this->motorCategories as $category)
                            <div class="flex items-center">
                                <input wire:model="selectedCategoryCode" type="radio" id="cat-{{ $category->id }}" value="{{ $category->code }}" class="w-4 h-4">
                                <label for="cat-{{ $category->id }}" class="ms-2 text-sm font-medium">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Filter Tipe Bahan -->
                <div class="flex flex-col space-y-3">
                    <span class="text-lg font-semibold mb-2">Tipe Bahan</span>

                    @foreach ($materialProducts as $index => $material)
                        <div class="flex items-center">
                            <input wire:model="selectedMaterial" id="mat-{{ $index }}" type="radio" value="{{ $material['code'] }}" name="default-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ">
                            <label for="mat-{{ $index }}" class="ms-2 text-sm font-medium text-gray-900">{{ $material['name'] }}</label>
                        </div>    
                    @endforeach

                </div>

                
                <!-- Tombol Terapkan -->
                <div class="sticky bottom-0 bg-white py-2 mt-2">
                    <div class="flex flex-col gap-1">
                        <button 
                            wire:click="$refresh"
                            wire:loading.attr="disabled"
                            class="w-full px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow relative">
                            <span wire:loading.remove wire:target="$refresh">Terapkan Filter</span>
                            <span wire:loading wire:target="$refresh">Menerapkan Filter...</span>
                        </button>


                        <button 
                            wire:click="resetFilter"
                            wire:loading.attr="disabled"
                            class="w-full px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md shadow relative">
                            <span wire:loading.remove wire:target="resetFilter">Hapus Filter</span>
                            <span wire:loading wire:target="resetFilter">Menghapus Filter...</span>
                        </button>

                    </div>
                </div>

            </div>
        </div>

        <!-- Produk -->
        <div class="md:col-span-4">
            <div class="flex flex-col gap-2">
                <!-- Tombol Filter (mobile) -->
                <div class="md:hidden">
                    <button data-drawer-target="drawer-filter" data-drawer-show="drawer-filter" aria-controls="drawer-filter"
                        class="inline-flex items-center px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6h16M4 12h8m-8 6h16"></path>
                        </svg>
                        Filter
                    </button>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                    <form class="w-full max-w-md" wire:submit.prevent="loadProducts">
                        <label for="search-input" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input 
                                type="search" 
                                id="search-input"
                                wire:model.debounce.500ms="search"
                                class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Search Product"
                            />
                            <button 
                                type="submit"
                                wire:click="$refresh"
                                wire:loading.attr="disabled"
                                class="text-white absolute end-2.5 bottom-1 bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-4 py-2">
                                <span wire:loading.remove wire:target="$refresh">Search</span>
                                <span wire:loading wire:target="$refresh">Mencari...</span>
                            </button>

                        </div>
                    </form>
                </div>

                <span class="text-lg font-semibold mt-4">Semua Produk</span>

                @if (Session::has('success'))
                    <div id="toast-success" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm " role="alert">
                        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg ">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                        </div>
                        <div class="ms-3 text-sm font-normal">Berhasil menambahkan ke cart!</div>
                        <button type="button" class="ms-auto bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5 hover:bg-gray-100"
                            data-dismiss-target="#toast-success" aria-label="Close">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 14 14">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2 mt-4">
                    @foreach ($this->products as $product)
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