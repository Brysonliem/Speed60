<footer class="bg-blue-50 mt-10">
    <div class="max-w-7xl mx-auto px-5">
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 text-gray-700">
            
            <!-- Layanan Pelanggan -->
            <div>
                <h3 class="font-bold text-lg">Layanan Pelanggan</h3>
                <p class="mt-2">📞 0821-3345-9876</p>
                <p class="mt-2">🏠 JL Pangeran Tubagus Angke No 20, Ruko Angke Megah Blok B 15-16</p>
                <p class="mt-2">📧 Speed60@gmail.com</p>
            </div>

            <!-- Produk -->
            <div>
                <h3 class="font-bold text-lg">PRODUK</h3>
                <ul class="mt-3 space-y-2">
                    <li>🚀 PCX · ADV</li>
                    <li>🏍️ Nmax · Aerox · Lexi</li>
                    <li>⚡ Satria FU</li>
                    <li>🔩 Baut M 4 Drat 6</li>
                    <li>🔩 Baut M 5 Drat 8</li>
                </ul>
                <a href="#" class="text-blue-500 font-semibold mt-4 inline-block hover:underline">Lihat Semua Produk →</a>
            </div>

            <!-- Links -->
            <div>
                <h3 class="font-bold text-lg">LINKS</h3>
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
            <div>
                <h3 class="font-bold text-lg">IKUTI KAMI</h3>
                <ul class="mt-3 space-y-2">
                    <li><a href="#" class="hover:underline">🛍️ Tokopedia</a></li>
                    <li><a href="#" class="hover:underline">🛒 Shopee</a></li>
                    <li><a href="#" class="hover:underline">📦 Lazada</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Logo -->
    <div class="mt-12 border-t border-gray-300 pt-6 flex justify-center bg-gray-900 py-6">
        <img src="/images/speed60.png" alt="Logo" class="w-16">
    </div>
</footer>
