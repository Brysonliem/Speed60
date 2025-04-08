<!-- Header -->
<header class="bg-black text-white py-2">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center px-4 space-y-2 sm:space-y-0">
        <div class="flex items-center text-sm">
            <span class="material-icons text-base mr-1">phone</span>
            0821-3345-9876
        </div>
        <div class="text-center text-sm">
            Follow Us and get a chance to win 50% off
        </div>
        <div class="flex items-center space-x-4 text-sm">
            <span class="hidden sm:inline">Follow us</span>
            <div class="flex space-x-2">
                <a href="#" class="text-white hover:text-gray-300">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-300">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="#" class="text-white hover:text-gray-300">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
</header>

<!-- Navbar -->
<nav class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <img class="h-60 sm:h-16 md:h-60 w-auto" src="/images/speed60.png" alt="Logo">
            </div>

            <!-- Mobile menu button -->
            <button class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-900 hover:text-gray-600" id="mobile-menu-button">
                <span class="material-icons">menu</span>
            </button>

        <!-- Navigation Links - Desktop -->
        @php
            $user = Auth::user();
            $dashboardRoute = match ($user->role->level) {
                1 => route('dashboard.superadmin'),
                2 => route('dashboard.admin'),
                default => route('dashboard.user'),
            };
        @endphp

        <div class="hidden md:flex md:space-x-8">
            @if (Auth::check())
                {{-- Beranda: semua role --}}
                <a href="{{ $dashboardRoute }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
                    Beranda
                </a>

                {{-- Role 1 & 2 hanya tampilkan Buat Produk --}}
                @if (in_array($user->role->level, [1, 2]))
                    <a href="{{ route('products.index.admin') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
                        Buat Produk
                    </a>
                @endif

                {{-- Role 3: tampilkan semua menu lainnya --}}
                @if ($user->role->level === 3)
                    <a href="{{ route('products.index') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
                        Produk
                    </a>
                    <a href="{{ route('track_order') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
                        Track Order
                    </a>
                    <a href="{{ route('dealers') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
                        Dealers
                    </a>
                    <a href="{{ route('support') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
                        Customer Support
                    </a>
                @endif
            @endif
        </div>


        <!-- Right side icons -->
        <div class="flex items-center relative gap-4">

            @if (!in_array($user->role->level, [1, 2]))
                <div class="flex">
                    <a href="{{ route('carts.index') }}" class="material-icons">shopping_cart</a>
                </div>

                <div class="flex">
                    <span class="material-icons">search</span>
                </div>
            @endif            

            <div id="dropdownProfileButton" data-dropdown-toggle="dropdownProfile" class="flex cursor-pointer">
                <span class="material-icons text-gray-900">person</span>
            </div>

            <!-- Dropdown menu -->
            <div id="dropdownProfile" class="hidden absolute right-0 top-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 z-50">
                <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownProfileButton">
                    <li>
                        <a href="{{ route('profile.show', Auth::user()->id) }}" class="flex px-4 py-2 hover:bg-gray-100 items-center gap-2">
                            <i class="material-icons">person</i>
                            Akun Saya
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" class="flex px-4 py-2 hover:bg-gray-100 items-center gap-2">
                            <i class="material-icons">logout</i>
                            Keluar
                        </a>
                    </li>
                </ul>
            </div>

            
        </div>


        <!-- Mobile menu - Hidden by default -->
        <div class="md:hidden hidden" id="mobile-menu">
            
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">Beranda</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">
                    Produk
                    <span class="material-icons text-sm ml-1 inline-block">expand_more</span>
                </a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">Track order</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">Dealers</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">Customer Support</a>
            </div>
        </div>
    </div>
</nav>

<!-- Required CSS -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<!-- JavaScript for mobile menu toggle -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    document.getElementById('search-button').addEventListener('click', function() {
        let searchBar = document.getElementById('search-bar');
        searchBar.classList.toggle('hidden');
        if (!searchBar.classList.contains('hidden')) {
            searchBar.querySelector('input').focus();
        }
    });
</script>