<div class="flex flex-col gap-6 min-h-screen p-4 md:p-8 bg-white">
    <!-- Judul halaman -->
    <h1 class="text-2xl font-semibold text-gray-800">Tulis Ulasan</h1>

    <!-- Form Ulasan -->
    <form class="space-y-6">
        <!-- Rating Bintang -->
        <div>
            <label for="rating" class="block mb-2 text-sm font-medium text-gray-700">Rating</label>
            <div class="flex items-center space-x-1">
                <!-- Placeholder bintang, bisa diganti dengan input radio atau komponen interaktif -->
                <svg class="w-6 h-6 text-gray-300 hover:text-yellow-400 cursor-pointer" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.21 3.717a1 1 0 00.95.69h3.904c.969 0 1.371 1.24.588 1.81l-3.16 2.296a1 1 0 00-.364 1.118l1.21 3.717c.3.921-.755 1.688-1.54 1.118l-3.16-2.296a1 1 0 00-1.176 0l-3.16 2.296c-.785.57-1.84-.197-1.54-1.118l1.21-3.717a1 1 0 00-.364-1.118L2.397 9.144c-.783-.57-.38-1.81.588-1.81h3.904a1 1 0 00.95-.69l1.21-3.717z"/>
                </svg>
                <!-- Ulangi 5x untuk 5 bintang -->
            </div>
        </div>

        <!-- Deskripsi Ulasan -->
        <div>
            <label for="review" class="block mb-2 text-sm font-medium text-gray-700">Deskripsi Ulasan</label>
            <textarea id="review" rows="5" class="block w-full p-3 text-sm border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500" placeholder="Tulis ulasanmu di sini..."></textarea>
        </div>

        <!-- Upload Gambar -->
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-700">Upload Gambar (maks. 4)</label>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <!-- Input Upload -->
                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 border-gray-300">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                        </svg>
                        <p class="text-sm text-gray-500 text-center">Klik untuk upload<br><span class="text-xs">PNG, JPG maksimal 4 gambar</span></p>
                    </div>
                    <input type="file" class="hidden" multiple accept="image/*" />
                </label>
                <!-- Preview gambar (jika ada) -->
                <!-- <img src="..." class="w-full h-32 object-cover rounded-lg border border-gray-200" /> -->
            </div>
        </div>

        <!-- Tombol Kirim -->
        <div>
            <button type="submit" class="px-6 py-3 text-white bg-red-600 hover:bg-red-700 rounded-lg text-sm font-medium">
                Kirim Ulasan
            </button>
        </div>
    </form>
</div>
