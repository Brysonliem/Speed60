<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speed60</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Include stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Josefin Sans', sans-serif;
        }

        footer {
            font-family: 'Josefin Sans', sans-serif;
            font-weight: 700; /* untuk Futura Bold */
        }
    </style>

    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

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
                "childrens" => [],
            ],
            [
                "id" => "TITANIUM",
                "name" => "Titanium",
                "link" => route('products.index'),
                "childrens" => [],
            ],
            [
                "id" => "ORDERS",
                "name" => "My Orders",
                "link" => route('products.index'),
                "childrens" => [],
            ],
            [
                "id" => "CUSTOMER_SERVICE",
                "name" => "Customer Service",
                "link" => "https://wa.me/6281293886489?text=Halo%2C%20saya%20ingin%20bertanya",
                "childrens" => [],
            ],
        ];

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

        // Tambahkan jika bukan level 1 atau 2
        // if (!in_array($userLevel, [1, 2])) {
        //     $links = array_merge($links, $userLinks);
        // }
    @endphp

    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 lg:px-5 lg:pl-3 min-h-20 flex items-center">
            <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 ">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="https://flowbite.com" class="flex ms-2 md:me-14">
                    <img src="{{ asset('/images/speed60_resized.png') }}" class="h-10 me-3" alt="FlowBite Logo" />
                </a>
                {{-- Menu admin --}}
                <div class="hidden lg:flex lg:justify-center h-full">
                    @foreach($links as $link)
                        @if(is_array($link['childrens']) && count($link["childrens"]) > 0)
                            <!-- Link with dropdown -->
                            <div class="relative group">
                                <a href="{{ $link['link'] }}"
                                    class="text-gray-900 hover:text-white hover:bg-red-500 py-2 md:px-5 mr-0 text-sm font-medium h-full flex items-center">
                                    {{ $link['name'] }}
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                                <div class="absolute left-0 hidden group-hover:block z-10">
                                    <div class="bg-white border-x border-b w-48">
                                        @foreach($link['childrens'] as $child)
                                            <a href="{{ $child['link'] }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-500 hover:text-white">
                                                {{ $child['name'] }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Regular link without dropdown -->
                            <a href="{{ $link['link'] }}"
                                class="text-gray-900 hover:text-white hover:bg-red-500 py-2 md:px-5 mr-0 text-sm font-medium h-full flex items-center">
                                {{ $link['name'] }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            {{-- <div class="flex items-center  ms-auto">
                
                <div class="flex items-center">
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 " aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm " id="dropdown-user">
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900" role="none">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}

        </div>
    </nav>

    @php
        $user = Auth::user();
        $userLevel = $user?->role->level;

        $dashboardRoute = match ($userLevel) {
            1 => route('dashboard.superadmin'),
            2 => route('dashboard.admin'),
            default => route('dashboard.user'),
        };
    @endphp

    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 " aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ $dashboardRoute }}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 group {{ request()->routeIs('dashboard.*') ? 'bg-red-600 font-semibold text-white hover:bg-red-400' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>

                    <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index.admin') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('products.*') ? 'bg-red-600 font-semibold text-white hover:bg-red-400' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    <span class="flex-1 ms-3 whitespace-nowrap">Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('vouchers.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('vouchers.*') ? 'bg-red-600 font-semibold text-white hover:bg-red-400' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.99 14.993 6-6m6 3.001c0 1.268-.63 2.39-1.593 3.069a3.746 3.746 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043 3.745 3.745 0 0 1-3.068 1.593c-1.268 0-2.39-.63-3.068-1.593a3.745 3.745 0 0 1-3.296-1.043 3.746 3.746 0 0 1-1.043-3.297 3.746 3.746 0 0 1-1.593-3.068c0-1.268.63-2.39 1.593-3.068a3.746 3.746 0 0 1 1.043-3.297 3.745 3.745 0 0 1 3.296-1.042 3.745 3.745 0 0 1 3.068-1.594c1.268 0 2.39.63 3.068 1.593a3.745 3.745 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.297 3.746 3.746 0 0 1 1.593 3.068ZM9.74 9.743h.008v.007H9.74v-.007Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Vouchers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('reviews.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('reviews.*') ? 'bg-red-600 font-semibold text-white hover:bg-red-400' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('transaction.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('transaction.*') ? 'bg-red-600 font-semibold text-white hover:bg-red-400' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Transactions</span>

                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-red-800 bg-red-100 rounded-full">3</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('refunds.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('refunds.*') ? 'bg-red-600 font-semibold text-white hover:bg-red-400' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.25-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                        </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Request Refunds</span>

                        <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-red-800 bg-red-100 rounded-full">3</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('refunds.*') ? 'bg-red-600 font-semibold text-white hover:bg-red-400' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                        </svg>


                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>

                        {{-- <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-red-800 bg-red-100 rounded-full">3</span> --}}
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        {{ $slot }}
    </div>


    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
</body>

</html>