{{-- @dd($products) --}}
<div class="flex flex-col mt-14">
    <div class="bg-white w-full p-4 border rounded-lg my-4 text-center hover:shadow-lg transition-shadow duration-300">
        <div class="relative overflow-x-auto">
            <div wire:loading wire:target="deleteProduct"
                class="absolute z-10 inset-0 bg-white/70 flex items-center justify-center">
                <div role="status">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin  fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
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
                <a href="{{ route('products.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none 
                           focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                    + Tambah Produk
                </a>
            </div>
            
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 rounded-s-lg">Gambar</th>
                        <th class="px-6 py-3">Nama Produk</th>
                        <th class="px-6 py-3">Variant</th>
                        <th class="px-6 py-3">Total Stok</th>
                        {{-- <th class="px-6 py-3">Harga</th> --}}
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
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{-- Tampilkan badges variant --}}
                                @if (!empty($product['variants']))
                                    <div class="grid grid-cols-3 gap-1">
                                        @foreach ($product['variants'] as $variant)
                                            <span class="flex justify-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                style="background-color: {{ $variant['color_code'] }}20; color: {{ $variant['color_code'] }};">
                                                {{ $variant['color'] }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                {{ (int) $product['variants_sum_current_stock'] }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                {{ $product['product_type']['name'] ?? '-' }}
                            </td> --}}
                            {{-- <td class="px-6 py-4">
                                @idr($product['variants'][0]['price'] ?? 0)
                            </td> --}}
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
        </div>
        
        

    </div>
</div>
