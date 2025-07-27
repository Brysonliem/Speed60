<!-- Header -->
{{-- <div id="sticky-banner" tabindex="-1" class="fixed top-0 start-0 z-50 w-full border-b border-gray-200 bg-black text-white">
    <div class="max-w-7xl mx-auto px-4 py-2 flex flex-col sm:flex-row justify-between items-center gap-2 text-sm">
        <div class="flex items-center">
            <svg class="w-4 h-4 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                <path d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1-.24 11.36 11.36 0 0 0 3.56.57 1 1 0 0 1 1 1v3.61a1 1 0 0 1-1 1A17 17 0 0 1 3 6a1 1 0 0 1 1-1h3.61a1 1 0 0 1 1 1 11.36 11.36 0 0 0 .57 3.56 1 1 0 0 1-.24 1l-2.32 2.23Z"/>
            </svg>
            <span>0821-3345-9876</span>
        </div>

        <div class="text-center">
            Follow Us and get a chance to win <strong class="text-yellow-400">50% off</strong>
        </div>

        <div class="flex items-center gap-3">
            <span class="hidden sm:inline">Follow us:</span>
            <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-tiktok"></i></a>
            <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-youtube"></i></a>
            <a href="#" class="text-white hover:text-gray-300"><i class="fab fa-instagram"></i></a>
        </div>

        <!-- Tombol Close -->
        <button data-dismiss-target="#sticky-banner" type="button" class="sm:absolute top-1 right-1 inline-flex justify-center w-7 h-7 items-center text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close banner</span>
        </button>
    </div>
</div> --}}


@php
    $user = Auth::user();
    $userLevel = $user?->role->level;

    $dashboardRoute = match ($userLevel) {
        1 => route('dashboard.superadmin'),
        2 => route('dashboard.admin'),
        default => route('dashboard.user'),
    };

    $productTypes = \App\Models\ProductType::get()->map(function ($type) {
        return [
            "id" => $type->id,
            "name" => $type->name,
            "link" => route('products.index'),
            "childrens" => [],
        ];
    })->toArray();

    $subchildrens = [];

    $subchildrensTitanium = [];

    for ($i = 1; $i <= 10; $i++) {
        $subchildrens[] = [
            'name' => "M{$i} Hardware Size",
            'link' => route('products.index', [
                'material' => 'STAINLESS',
                'product_type' => 'Baut',
                'sub_product_type' => "B_M{$i}",
            ]),
        ];
    }

    for ($i = 1; $i <= 10; $i++) {
        $subchildrensTitanium[] = [
            'name' => "M{$i} Hardware Size",
            'link' => route('products.index', [
                'material' => 'TITANIUM',
                'product_type' => 'Baut',
                'sub_product_type' => "B_M{$i}",
            ]),
        ];
    }


    $links = [
        [
            "id" => "HOMEPAGE",
            "name" => "Home",
            "link" => $dashboardRoute,
            "childrens" => [],
        ],
        [
            "id" => "PRODUCT",
            "name" => "Products",
            "link" => route('products.index'),
            "childrens" => [],
        ],
        [
            "id" => "STAINLESS",
            "name" => "Stainless",
            "link" => route('products.index'),
            "childrens" => [
                [
                    "id" => "BAUT_STAINLESS",
                    "name" => "Baut",
                    'subchildrens' => $subchildrens
                ],
                [
                    "id" => "MUR_STAINLESS",
                    "name" => "Mur",
                    "link" => route('products.index', ['material' => 'STAINLESS','product_type' => 'Mur'])
                ],
                [
                    "id" => "ASRODA_STAINLESS",
                    "name" => "As Roda",
                    "link" => route('products.index', ['material' => 'STAINLESS','product_type' => 'As Roda'])
                ],
                [
                    "id" => "SELANG_REM_STAINLESS",
                    "name" => "Selang Rem",
                    "link" => route('products.index', ['material' => 'STAINLESS','product_type' => 'Selang Rem'])
                ],
                [
                    "id" => "AKSESORIS_REM_STAINLESS",
                    "name" => "Aksesoris",
                    "link" => route('products.index', ['material' => 'STAINLESS','product_type' => 'Aksesoris'])
                ]
            ],
        ],
        [
            "id" => "TITANIUM",
            "name" => "Titanium",
            "link" => route('products.index'),
            "childrens" => [
                [
                    "id" => "BAUT_STAINLESS",
                    "name" => "Baut",
                    'subchildrens' => $subchildrensTitanium
                ],
                [
                    "id" => "MUR_STAINLESS",
                    "name" => "Mur",
                    "link" => route('products.index', ['material' => 'TITANIUM','product_type' => 'Mur'])
                ],
                [
                    "id" => "ASRODA_STAINLESS",
                    "name" => "As Roda",
                    "link" => route('products.index', ['material' => 'TITANIUM','product_type' => 'As Roda'])
                ],
                [
                    "id" => "SELANG_REM_STAINLESS",
                    "name" => "Selang Rem",
                    "link" => route('products.index', ['material' => 'TITANIUM','product_type' => 'Selang Rem'])
                ],
                [
                    "id" => "AKSESORIS_REM_STAINLESS",
                    "name" => "Aksesoris",
                    "link" => route('products.index', ['material' => 'TITANIUM','product_type' => 'Aksesoris'])
                ]
            ],
        ],
        
        [
            "id" => "CUSTOMER_SERVICE",
            "name" => "Customer Service",
            "link" => "https://wa.me/6281293886489?text=Halo%2C%20saya%20ingin%20bertanya",
            "childrens" => [],
        ],
    ];

    if(Auth::check()) {
        $links[5] = [
            "id" => "ORDERS",
            "name" => "My Orders",
            "link" => route('profile.show', ['user' => $user->id,'tab' => 'my-orders']),
            "childrens" => [],
        ];
    }

    // if (in_array($userLevel, [1, 2])) {
    //     $links = array_merge($links, [
    //         [
    //             "id" => "CREATE_PRODUCT",
    //             "name" => "Buat Produk",
    //             "link" => route('products.index.admin'),
    //             "childrens" => [],
    //         ],
    //         [
    //             "id" => "CREATE_VOUCHER",
    //             "name" => "Buat Voucher",
    //             "link" => route('vouchers.index'),
    //             "childrens" => [],
    //         ],
    //     ]);
    // }

    // Menu tambahan untuk user level 3 (pengunjung biasa)
    // $userLinks = [
    //     [
    //         "id" => "PRODUCT",
    //         "name" => "Products",
    //         "link" => route('products.index'),
    //         "childrens" => [],
    //     ],
    //     [
    //         "id" => "STAINLESS",
    //         "name" => "Stainless",
    //         "link" => route('products.index'),
    //         "childrens" => [],
    //     ],
    //     [
    //         "id" => "TITANIUM",
    //         "name" => "Titanium",
    //         "link" => route('products.index'),
    //         "childrens" => [],
    //     ],
    //     [
    //         "id" => "ORDERS",
    //         "name" => "My Orders",
    //         "link" => route('products.index'),
    //         "childrens" => [],
    //     ],
    //     [
    //         "id" => "CUSTOMER_SERVICE",
    //         "name" => "Customer Service",
    //         "link" => "https://wa.me/6281293886489?text=Halo%2C%20saya%20ingin%20bertanya",
    //         "childrens" => [],
    //     ],
    // ];

    // // Tambahkan jika bukan level 1 atau 2
    // if (!in_array($userLevel, [1, 2])) {
    //     $links = array_merge($links, $userLinks);
    // }
@endphp


<!-- Navbar -->
<nav class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-4">
        
        <div class="flex justify-between items-center h-20 px-4 sm:px-6 lg:px-8">
            <!-- Hamburger (visible on mobile only) -->
            <button class="lg:hidden text-gray-700 focus:outline-none" 
                data-drawer-target="sidebar-drawer" 
                data-drawer-show="sidebar-drawer" 
                data-drawer-placement="top" 
                aria-controls="sidebar-drawer"
            >
                <span class="material-icons text-3xl">menu</span>
            </button>

            <!-- drawer component -->
            <div id="sidebar-drawer" class="fixed top-0 left-0 right-0 z-40 w-full p-4 transition-transform -translate-y-full bg-white" tabindex="-1" aria-labelledby="drawer-top-label">
                <button type="button" data-drawer-hide="sidebar-drawer" aria-controls="sidebar-drawer" 
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg 
                        text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close menu</span>
                </button>

                {{-- Navigasi konten --}}
                <nav class="flex flex-col items-center justify-center text-center mt-10 space-y-4">
                    @foreach($links as $link)
                        @if(is_array($link['childrens']) && count($link["childrens"]) > 0)
                            <div class="w-full">
                                <p class="text-gray-500 text-sm font-semibold uppercase mb-1">{{ $link['name'] }}</p>
                                @foreach($link['childrens'] as $child)
                                    <a href="{{ $child['link'] ?? '#' }}"
                                    class="block text-gray-700 text-base font-medium hover:text-blue-600 py-1">
                                        {{ $child['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <a href="{{ $link['link'] }}" 
                            class="text-gray-700 text-base font-medium hover:text-blue-600">
                                {{ $link['name'] }}
                            </a>
                        @endif
                    @endforeach
                </nav>


                {{-- Tombol jika belum login --}}
                @if (!Auth::check())
                    <div class="flex items-center justify-center mt-8 gap-2">
                        <a href="{{ route('register') }}"
                            class="px-6 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Register
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-6 py-2 text-sm font-medium text-center text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-4 focus:ring-blue-200">
                            Login
                        </a>
                    </div>
                @endif
            </div>


            <!-- Logo -->
            <div class="flex justify-center sm:justify-start">
                <img
                    class="h-20 sm:h-12 md:h-28 w-auto"
                    src="/images/speed60.png"
                    alt="Logo"
                >
            </div>

            <div class="hidden lg:flex lg:justify-center h-full">
                @foreach($links as $link)
                    @if(is_array($link['childrens']) && count($link["childrens"]) > 0)
                        <div class="relative group">
                            <a href="{{ $link['link'] }}"
                            class="text-gray-900 hover:text-white hover:bg-red-500 py-2 md:px-5 text-sm font-medium h-full flex items-center">
                                {{ $link['name'] }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>

                            <!-- Dropdown menu -->
                            <div class="absolute left-0 hidden group-hover:block z-10">
                                <div class="bg-white border-x border-b w-48">
                                    @foreach($link['childrens'] as $child)
                                        <div class="relative group">
                                            <a href="{{ !empty($child['link']) ? $child['link'] : '#' }}"
                                               class="flex justify-between items-center px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white w-full {{ empty($child['link']) ? 'cursor-default' : '' }}">

                                                {{ $child['name'] }}
                                                @if(isset($child['subchildrens']) && count($child['subchildrens']) > 0)
                                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                @endif
                                            </a>

                                            <!-- Subchildren submenu -->
                                            @if(isset($child['subchildrens']) && count($child['subchildrens']) > 0)
                                                <div class="absolute left-full top-0 hidden group-hover:block z-20 bg-white border w-48">
                                                    @foreach($child['subchildrens'] as $sub)
                                                        <a href="{{ $sub['link'] }}"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white">
                                                            {{ $sub['name'] }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ $link['link'] }}"
                        class="text-gray-900 hover:text-white hover:bg-red-500 py-2 md:px-5 text-sm font-medium h-full flex items-center">
                            {{ $link['name'] }}
                        </a>
                    @endif
                @endforeach
            </div>

            <!-- Right side icons -->
            <div class="w-1/3 flex justify-end items-center gap-4">

                @if (!in_array($user?->role->level, [1, 2]))
                    <div class="flex">
                        <a data-tooltip-target="tooltip-bottom" data-tooltip-placement="bottom" href="{{ route('carts.index') }}" class="material-icons">shopping_cart</a>
                    </div>

                    <div id="tooltip-bottom" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip whitespace-nowrap">
                        Your Carts
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                @endif

                <div id="dropdownProfileButton" data-dropdown-toggle="dropdownProfile" class="flex cursor-pointer">
                    <span class="material-icons text-gray-900">person</span>
                </div>

                <!-- Dropdown menu -->
                <div id="dropdownProfile"
                    class="hidden absolute right-0 top-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 z-50">
                    <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownProfileButton">
                        @if (Auth::check())
                            <li>
                                <a href="{{ route('profile.show', Auth::user()->id) }}"
                                    class="flex px-4 py-2 hover:bg-gray-100 items-center gap-2">
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
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="flex px-4 py-2 hover:bg-gray-100 items-center gap-2">
                                    <i class="material-icons">login</i>
                                    Login
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" class="flex px-4 py-2 hover:bg-gray-100 items-center gap-2">
                                    <i class="material-icons">menu</i>
                                    Register
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>


            </div>


            <!-- Mobile menu - Hidden by default -->
            <div class="md:hidden hidden" id="mobile-menu">

                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#"
                        class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">Beranda</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">
                        Produk
                        <span class="material-icons text-sm ml-1 inline-block">expand_more</span>
                    </a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">Track
                        order</a>
                    <a href="#"
                        class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">Dealers</a>
                    <a href="#" class="block px-3 py-2 text-base font-medium text-gray-900 hover:text-gray-600">Customer
                        Support</a>
                </div>
            </div>
        </div>
</nav>

<!-- Required CSS -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<!-- JavaScript for mobile menu toggle -->
<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    document.getElementById('search-button').addEventListener('click', function () {
        let searchBar = document.getElementById('search-bar');
        searchBar.classList.toggle('hidden');
        if (!searchBar.classList.contains('hidden')) {
            searchBar.querySelector('input').focus();
        }
    });
</script>