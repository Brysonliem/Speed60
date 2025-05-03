<footer class="bg-gray-900 text-white py-10 text-sm">
    <div class="max-w-7xl mx-auto px-10 lg:px-0">
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-7 gap-8">

            <div class="md:col-span-2">
                <img src="/images/speed60_resized.png" alt="Logo" class="w-3/4 lg:w-full">
            </div>

            <!-- Layanan Pelanggan -->
            <div class="col-span-1">
                <h3 class="font-bold text-sm">Layanan Pelanggan</h3>
                <p class="mt-2 flex gap-1">
                    <span>📞</span>
                    <span class="flex-1">0821-3345-9876</span>
                </p>

                <p class="mt-2 flex gap-1">
                    <span>🏠 </span>
                    <span class="flex-1">JL Pangeran Tubagus Angke No 20, Ruko Angke Megah Blok B 15-16</span>
                </p>


                <p class="mt-2 flex gap-1">
                    <span>📧</span>
                    <span class="flex-1">Speed60@gmail.com</span>
                </p>
            </div>

            <!-- Produk -->
            <div class="col-span-1">
                <h3 class="font-bold text-sm">Produk</h3>
                <ul class="mt-3 space-y-2">
                    <li>🚀 PCX · ADV</li>
                    <li>🏍️ Nmax · Aerox · Lexi</li>
                    <li>⚡ Satria FU</li>
                    <li>🔩 Baut M 4 Drat 6</li>
                    <li>🔩 Baut M 5 Drat 8</li>
                </ul>
                <a href="#" class="text-sm font-semibold mt-4 inline-block hover:underline">Lihat Semua Produk
                    →</a>
            </div>

            <!-- Links -->
            <div class="col-span-1">
                <h3 class="font-bold text-sm">Links</h3>
                <ul class="mt-3 space-y-2">
                    @if (Auth::check())
                        @php
                            $dashboardRoute = match (Auth::user()->role->level) {
                                1 => route('dashboard.superadmin'),
                                2 => route('dashboard.admin'),
                                default => route('dashboard.user'),
                            };
                        @endphp
                        <li><a href="{{ $dashboardRoute }}" class="hover:underline">🏠 Beranda</a></li>
                    @endif
                    <li><a href="{{ route('cart') }}" class="hover:underline">🛒 Cart</a></li>
                    <li><a href="{{ route('support') }}" class="hover:underline">📞 Layanan Customer</a></li>
                    <li><a href="{{ route('track_order') }}" class="hover:underline">📦 Track Order</a></li>
                </ul>
            </div>

            <!-- Ikuti Kami -->
            <div class="lg:col-span-2">
                <h3 class="font-bold text-sm">Ikuti Kami</h3>
                <p>Daftar di bawah untuk mendapatkan pemberitahuan tentang penjualan dan rilis produk baru</p>
                <div class="flex items-center gap-2 my-3">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path
                                    d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                <path
                                    d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                            </svg>
                        </div>
                        <input type="text" id="email-address-icon"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@flowbite.com" />
                    </div>
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Join</button>
                </div>

                <ul class="grid grid-cols-3 gap-5 items-center">
                    <li>
                        <a href="https://www.tokopedia.com" target="_blank" rel="noopener noreferrer">
                            <img src="https://images.tokopedia.net/assets-tokopedia-lite/v2/zeus/production/e5b8438b.svg"
                                alt="Tokopedia" class="w-full h-auto" />
                        </a>
                    </li>
                    <li>
                        <a href="https://shopee.co.id" target="_blank" rel="noopener noreferrer">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/2560px-Shopee.svg.png"
                                alt="Shopee" class="w-full h-auto" />
                        </a>
                    </li>
                    <li>
                        <a href="https://www.lazada.co.id" target="_blank" rel="noopener noreferrer">
                            <img src="https://img.lazcdn.com/g/tps/images/ims-web/TB1Hs8GaMFY.1VjSZFnXXcFHXXa.png"
                                alt="Lazada" class="w-full h-auto" />
                        </a>
                    </li>
                </ul>


            </div>
        </div>
    </div>

    <!-- Footer Logo -->
    <div class="mt-12 pt-6 flex justify-center bg-gray-900 py-6">
        <img src="/images/speed60.png" alt="Logo" class="w-16">
    </div>
</footer>