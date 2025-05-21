<div class="flex flex-col gap-4 h-[70rem] p-4 md:p-8">
    <!-- Breadcrumb -->
    @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Produk', 'url' => route('products.index')],
    ]])

    <div class="grid grid-cols-7">
        <div class="col-span-2">
            <ul class="flex-column text-sm font-medium md:me-4 md:mb-0 shadow-md" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                <li role="presentation">
                    <button class="inline-flex items-center px-4 py-3 hover:text-gray-900 text-white bg-blue-700 active w-full rounded-t-md" aria-current="page"
                        id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"
                    >
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>
                        Dashboard
                    </button>
                </li>
                <li role="presentation">
                    <button class="inline-flex items-center px-4 py-3 text-white hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full"
                        id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false"
                    >
                        <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/></svg>
                        Order History
                    </button>
                </li>
                <li role="presentation">
                    <button class="inline-flex items-center px-4 py-3 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                        <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 7.5h-.423l-.452-1.09.3-.3a1.5 1.5 0 0 0 0-2.121L16.01 2.575a1.5 1.5 0 0 0-2.121 0l-.3.3-1.089-.452V2A1.5 1.5 0 0 0 11 .5H9A1.5 1.5 0 0 0 7.5 2v.423l-1.09.452-.3-.3a1.5 1.5 0 0 0-2.121 0L2.576 3.99a1.5 1.5 0 0 0 0 2.121l.3.3L2.423 7.5H2A1.5 1.5 0 0 0 .5 9v2A1.5 1.5 0 0 0 2 12.5h.423l.452 1.09-.3.3a1.5 1.5 0 0 0 0 2.121l1.415 1.413a1.5 1.5 0 0 0 2.121 0l.3-.3 1.09.452V18A1.5 1.5 0 0 0 9 19.5h2a1.5 1.5 0 0 0 1.5-1.5v-.423l1.09-.452.3.3a1.5 1.5 0 0 0 2.121 0l1.415-1.414a1.5 1.5 0 0 0 0-2.121l-.3-.3.452-1.09H18a1.5 1.5 0 0 0 1.5-1.5V9A1.5 1.5 0 0 0 18 7.5Zm-8 6a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7Z"/>
                        </svg>
                        Orders
                    </button>
                </li>
                <li role="presentation">
                    <button class="inline-flex items-center px-4 py-3 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 w-full rounded-b-md" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">
                        <svg class="w-4 h-4 me-2 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M7.824 5.937a1 1 0 0 0 .726-.312 2.042 2.042 0 0 1 2.835-.065 1 1 0 0 0 1.388-1.441 3.994 3.994 0 0 0-5.674.13 1 1 0 0 0 .725 1.688Z"/>
                            <path d="M17 7A7 7 0 1 0 3 7a3 3 0 0 0-3 3v2a3 3 0 0 0 3 3h1a1 1 0 0 0 1-1V7a5 5 0 1 1 10 0v7.083A2.92 2.92 0 0 1 12.083 17H12a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h1a1.993 1.993 0 0 0 1.722-1h.361a4.92 4.92 0 0 0 4.824-4H17a3 3 0 0 0 3-3v-2a3 3 0 0 0-3-3Z"/>
                        </svg>
                        My Account
                    </button>
                </li>
            </ul>
        </div>
        <div class="col-span-5">
            <div id="default-tab-content">
                <div class="p-4 rounded-lg bg-gray-50 shadow-md flex flex-col gap-3" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="grid grid-cols-3 gap-2">
                        <div class="col-span-1">
                            @livewire('components.order-card' ,[
                                'count' => 34
                            ])
                        </div>
                        <div class="col-span-1">
                            @livewire('components.order-card', [
                                'color' => 'yellow',
                                'count' => 14,
                                'label' => 'Pending Orders',
                                'icon' => 'receipt'
                            ])
                        </div>
                        <div class="col-span-1">
                            @livewire('components.order-card', [
                                'color' => 'green',
                                'count' => 20,
                                'label' => 'Completed Orders',
                                'icon' => 'widgets'
                            ])
                        </div>
                    </div>
            
                    @php
                        $columns = ['ORDER ID', 'STATUS', 'DATE', 'TOTAL', 'ACTION'];
                        $data = [
                            ['#28937619', 'IN PROGGRESS', 'Jan 20, 2025 05:12', 'Rp 120.000 (5 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                            ['#12786382', 'COMPLETED', 'Jan 12, 2025 04:10', 'Rp 150.120 (2 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                            ['#12837293', 'CANCELED', 'Jan 15, 2025 09:00', 'Rp 32.500 (1 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                            ['#91237774', 'COMPLETED', 'Feb 16, 2025 07:55', 'Rp 560.400 (2 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                            ['#91283123', 'COMPLETED', 'Feb 29, 2025 03:05', 'Rp 245.600 (4 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                        ];
                    @endphp

                    <div class="flex flex-col gap-2">
                        <div class="flex">
                            <span class="text-sm font-medium">ORDER HISTORY</span>
                            <a href="#" class="text-sm font-medium ms-auto text-blue-600">VIEW ALL</a>
                        </div>
                        <livewire:components.dynamic-table :columns="$columns" :data="$data" />
                    </div>
            
            
                    </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 shadow-md" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            @php
                                $columns = ['ORDER ID', 'STATUS', 'DATE', 'TOTAL', 'ACTION'];
                                $data = [
                                    ['#28937619', 'IN PROGGRESS', 'Jan 20, 2025 05:12', 'Rp 120.000 (5 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                    ['#12786382', 'COMPLETED', 'Jan 12, 2025 04:10', 'Rp 150.120 (2 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                    ['#12837293', 'CANCELED', 'Jan 15, 2025 09:00', 'Rp 32.500 (1 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                    ['#91237774', 'COMPLETED', 'Feb 16, 2025 07:55', 'Rp 560.400 (2 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                    ['#91283123', 'COMPLETED', 'Feb 29, 2025 03:05', 'Rp 245.600 (4 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                ];
                            @endphp

                            <div class="flex flex-col gap-2">
                                <div class="flex">
                                    <span class="text-sm font-medium">ORDER HISTORY</span>
                                    <a href="#" class="text-sm font-medium ms-auto text-blue-600">VIEW ALL</a>
                                </div>
                                <livewire:components.dynamic-table :columns="$columns" :data="$data" />
                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 shadow-md" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                            <div class="flex flex-col gap-3">
                                <div class="flex w-100 bg-blue-300 items-center p-4 rounded-md">
                                    <div class="flex flex-col">
                                        <span class="text-lg text-black font-semibold">#27837656</span>
                                        <span class="text-sm text-gray-500 font-medium">4 Produk - Pesanan Dibuat 17 Feb 2025 07:30</span>
                                    </div>
                                    <span class="text-2xl font-bold ms-auto text-blue-900">Rp 60.000</span>
                                </div>

                                {{-- STEPPER --}}
                                <div class="flex w-100 justify-center">
                                    <ol class="flex items-center w-full">
                                        <li class="flex w-full items-center text-blue-800  after:content-[''] after:w-full after:h-1 after:border-b after:border-blue-100 after:border-4 after:inline-block ">
                                            <span class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12  shrink-0">
                                                <svg class="w-3.5 h-3.5 text-blue-800 lg:w-4 lg:h-4 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
                                            <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12  shrink-0">
                                                <svg class="w-4 h-4 text-gray-500 lg:w-5 lg:h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                                    <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                                                </svg>
                                            </span>
                                        </li>
                                        <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
                                            <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12  shrink-0">
                                                <svg class="w-4 h-4 text-gray-500 lg:w-5 lg:h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                    <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                                                </svg>   
                                            </span>
                                        </li>
                                        <li class="flex items-center w-full">
                                            <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12  shrink-0">
                                                <svg class="w-4 h-4 text-gray-500 lg:w-5 lg:h-5 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                    <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                                                </svg>
                                            </span>
                                        </li>
                                    </ol>
                                </div>

                                <div class="mt-3 flex flex-col gap-1">
                                    <span class="text-md font-semibold">Produk <span class="text-gray-600 text-md">(02)</span></span>

                                    @php
                                        $columns = ['ORDER ID', 'STATUS', 'DATE', 'TOTAL', 'ACTION'];
                                        $data = [
                                            ['#28937619', 'IN PROGGRESS', 'Jan 20, 2025 05:12', 'Rp 120.000 (5 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                            ['#12786382', 'COMPLETED', 'Jan 12, 2025 04:10', 'Rp 150.120 (2 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                            ['#12837293', 'CANCELED', 'Jan 15, 2025 09:00', 'Rp 32.500 (1 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                            ['#91237774', 'COMPLETED', 'Feb 16, 2025 07:55', 'Rp 560.400 (2 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                            ['#91283123', 'COMPLETED', 'Feb 29, 2025 03:05', 'Rp 245.600 (4 PRODUK)', '<a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>'],
                                        ];
                                    @endphp

                                    <livewire:components.dynamic-table :columns="$columns" :data="$data" />
                                </div>

                            </div>
                        </div>
                        <div class="hidden p-4 rounded-lg bg-gray-50 shadow-md" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                            <div class="flex gap-5">
                                @if ($user_profile)
                                    <img class="rounded-full w-52 h-52" src="{{ asset('/storage'.$user_profile) }}" alt="image description">
                                @else
                                    <img class="rounded-full w-52 h-52" src="{{ asset('images/avatar.jpg') }}" alt="image description">
                                @endif

                                {{-- FORM PROFILE --}}
                                <form class="grid grid-cols-2 gap-2 w-full">
                                    <div class="col-span-1">
                                        <label for="display-name" class="block mb-2 text-sm font-medium text-gray-900">Display Name</label>
                                        <input type="display-name" id="display-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                    </div>
                                    <div class="col-span-1">
                                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                                        <input type="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                    </div>
                                    <div class="col-span-1">
                                        <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                                        <input type="fullname" id="fullname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                    </div>
                                    <div class="col-span-1">
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                        <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                    </div>
                                    <div class="col-span-1">
                                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                                        <input type="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                    </div>
                                    <div class="col-span-2 mt-3 flex gap-2">
                                        <input 
                                            type="file" 
                                            wire:model="newPhoto" 
                                            id="photoUpload" 
                                            class="hidden"
                                        >
                                        <button 
                                            type="button"
                                            onclick="document.getElementById('photoUpload').click()"
                                            class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">
                                            Change Profile  
                                        </button>
                                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Save Changes</button>
                                    </div>
                                </form>
  
                            </div>

                            <div class="border-t border-gray-300/50 my-4"></div>

                            <span class="text-lg font-medium mb-2">Destination Address</span>
                            <form class="grid grid-cols-2 gap-2 w-full">
                                <div class="col-span-1">
                                    <label for="display-name" class="block mb-2 text-sm font-medium text-gray-900">Display Name</label>
                                    <input type="display-name" id="display-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-1">
                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                                    <input type="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-1">
                                    <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                                    <input type="fullname" id="fullname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-1">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                                    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-1">
                                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                                    <input type="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-1">
                                    <label for="display-name" class="block mb-2 text-sm font-medium text-gray-900">Display Name</label>
                                    <input type="display-name" id="display-name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-1">
                                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
                                    <input type="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-1">
                                    <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                                    <input type="fullname" id="fullname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-2 mt-3">
                                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Save Changes</button>
                                </div>
                            </form>

                            <div class="border-t border-gray-300/50 my-4"></div>

                            <span class="text-lg font-medium mb-2">CHANGE PASSWORD</span>
                            <form class="grid grid-cols-2 gap-2 w-full">
                                <div class="col-span-2">
                                    <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900">Current Password</label>
                                    <input type="current-password" id="current-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-2">
                                    <label for="new-password" class="block mb-2 text-sm font-medium text-gray-900 ">New Password</label>
                                    <input type="new-password" id="new-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-2">
                                    <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 ">Confirm Password</label>
                                    <input type="confirm-password" id="confirm-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                                </div>
                                <div class="col-span-2 mt-3">
                                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const tabs = document.querySelectorAll('[role="tab"]');
            
            tabs.forEach(tab => {
                tab.addEventListener("click", function () {
                    // Hapus semua kelas aktif dari tombol
                    tabs.forEach(t => {
                        t.classList.remove("bg-blue-700", "text-white");
                        t.classList.add("bg-gray-50", "hover:bg-gray-100", "text-gray-500");
                    });
        
                    // Tambahkan kelas aktif ke tab yang dipilih
                    this.classList.add("bg-blue-700", "text-white");
                    this.classList.remove("bg-gray-50", "hover:bg-gray-100", "text-gray-500");
                });
            });
        });
    </script>
    
</div>
