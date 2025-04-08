<div class="flex flex-col my-3">
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
                                Rp {{ number_format($product['price'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($product['reviews_avg_rating_point'] ?? 0, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product['reviews_count'] ?? 0 }} ulasan
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="#"
                                   class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-xs font-semibold rounded hover:bg-yellow-600">
                                    Edit
                                </a>
        
                                <form action="#" method="POST" class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
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
        </div>
        

    </div>
</div>
