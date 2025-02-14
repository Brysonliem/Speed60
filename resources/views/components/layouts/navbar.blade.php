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
<div class="hidden md:flex md:space-x-8">
    <a href="{{ route('home') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
        Beranda
    </a>

    <!-- Produk dengan Dropdown -->
    <div class="relative group">
        <a href="{{ route('products') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
            Produk
            <span class="material-icons text-sm ml-1">expand_more</span>
        </a>
        <div class="absolute hidden group-hover:block bg-white shadow-md rounded-lg mt-2 w-40">
            <a href="{{ route('category', ['category' => 'helm']) }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 text-sm">Helm</a>
            <a href="{{ route('category', ['category' => 'jaket']) }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 text-sm">Jaket</a>
            <a href="{{ route('category', ['category' => 'sarung-tangan']) }}" class="block px-4 py-2 text-gray-900 hover:bg-gray-100 text-sm">Sarung Tangan</a>
        </div>
    </div>

    <a href="{{ route('track_order') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
        Track Order
    </a>
    <a href="{{ route('dealers') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
        Dealers
    </a>
    <a href="{{ route('support') }}" class="text-gray-900 hover:text-gray-600 py-2 text-sm font-medium flex items-center">
        Customer Support
    </a>
</div>

<!-- Right side icons -->
<div class="flex items-center space-x-4 md:space-x-6">
    <!-- Cart -->
    <a href="{{ route('cart') }}" class="flex items-center space-x-1">
        <span class="material-icons text-gray-900">shopping_cart</span>
        <span class="text-sm text-gray-900 hidden sm:inline">$items</span>
    </a>

    <!-- Search Button -->
    <button class="p-1 hidden sm:block" id="search-button">
        <span class="material-icons text-gray-900">search</span>
    </button>

    <!-- Search Bar (Hidden by Default) -->
    <div id="search-bar" class="hidden absolute right-20 top-16 bg-white shadow-md rounded-lg p-2">
        <input type="text" class="border border-gray-300 rounded-lg px-3 py-1 w-64 focus:outline-none focus:ring-2 focus:ring-gray-500" placeholder="Search...">
    </div>

    <!-- Profile -->
    <a href="{{ route('profile') }}" class="p-1 hidden sm:block">
        <span class="material-icons text-gray-900">person</span>
    </a>
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