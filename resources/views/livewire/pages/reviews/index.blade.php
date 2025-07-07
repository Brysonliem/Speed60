<div class="mt-20">
    <div class="bg-white w-full p-4 border rounded-lg my-4 text-center hover:shadow-lg transition-shadow duration-300">
        <div class="relative overflow-x-auto">

            <!-- Header + Search -->
            <div class="flex flex-col sm:flex-row flex-wrap items-center justify-between pb-4 space-y-4 sm:space-y-0 mt-5">
                <div class="relative">
                    <label for="review-search" class="sr-only">Search</label>
                    <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 
                                  3.476l4.817 4.817a1 1 0 01-1.414 
                                  1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <input type="text" id="review-search" placeholder="Cari review..."
                           class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Table -->
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 min-w-[120px]">Nama Produk</th>
                        <th class="px-6 py-3 min-w-[150px]">User</th>
                        <th class="px-6 py-3 min-w-[80px]">Rating</th>
                        <th class="px-6 py-3 min-w-[300px]">Isi Review</th>
                        <th class="px-6 py-3 min-w-[120px]">Tanggal</th>
                        <th class="px-6 py-3 min-w-[200px]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $review->product->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $review->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $review->rating_point }} / 5
                            </td>
                            <td class="px-6 py-4">
                                {{ Str::limit($review->content, 100) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $review->created_at->format('d-m-Y H:i:s') }}
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="#"
                                   class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700">
                                    Detail
                                </a>
                                <form method="POST" action="#" class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus review ini?');">
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
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada review.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>