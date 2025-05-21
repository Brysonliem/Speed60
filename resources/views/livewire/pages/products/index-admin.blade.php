<div class="flex flex-col my-3 p-4 md:p-8">
    <div class="bg-white w-full p-4 border rounded-lg my-4 text-center hover:shadow-lg transition-shadow duration-300">
        <div class="relative overflow-x-auto">
            <div class="flex flex-col sm:flex-row flex-wrap items-center justify-between pb-4 space-y-4 sm:space-y-0 mx-1">
                {{-- Search Input --}}
                <div class="relative">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 
                                4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Search for items">
                </div>
            
                {{-- Tombol Aksi (Flowbite Button) --}}
                <a href="{{ route('products.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
                           focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center 
                           dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    + Tambah Produk
                </a>
            </div>
            
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 rounded-s-lg">Gambar</th>
                        <th class="px-6 py-3">Nama Produk</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Harga</th>
                        <th class="px-6 py-3">Rating</th>
                        <th class="px-6 py-3">Ulasan</th>
                        <th class="px-6 py-3 rounded-e-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                @if (!empty($product['product_images']))
                                    <img src="{{ asset('storage/' . $product['product_images'][0]['image_path']) }}"
                                        alt="Product Image"
                                        class="w-12 h-12 object-cover rounded" />
                                @else
                                    <span class="text-gray-400">No image</span>
                                @endif

                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $product['name'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product['product_type']['name'] ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if (!empty($products['variants']))
                                    @idr($product['variants'][0]['price'])
                                @else
                                    @idr(0)
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($product['reviews_avg_rating_point'] ?? 0, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product['reviews_count'] ?? 0 }} ulasan
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('products.edit', $product['id']) }}"
                                   class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-xs font-semibold rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                {{-- <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    Toggle modal
                                </button> --}}

                                <form
                                    wire:submit.prevent="deleteProduct({{ $product['id'] }})"
                                    wire:confirm="Yakin ingin menghapus produk ini?"
                                    class="inline-block"
                                >
                                    <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                            <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</div>
