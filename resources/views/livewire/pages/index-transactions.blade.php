{{-- @dd($transactions) --}}

<div class="mt-14">
    <div class="bg-white border p-3 max-w-screen min-h-[30rem] hover:shadow">
        <div class="relative overflow-x-auto sm:rounded-lg p-3">
            <!-- Overlay Spinner (Menutupi seluruh card saat loading) -->
            <div wire:loading wire:target="selectedStatusFilter"
                class="absolute inset-0 z-50 bg-white/70 flex justify-center items-center rounded-lg">
                <div role="status">
                    <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 ..." fill="currentColor" />
                        <path d="M93.9676 39.0409C96.393 ..." fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white">
                <div>
                    <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-white bg-red-600 border border-red-300 focus:outline-none hover:bg-red-400 focus:ring-4 focus:ring-red-100 font-medium rounded-lg text-sm px-3 py-1.5" type="button">
                        <span class="sr-only">Action button</span>
                        Transaction Status
                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownAction" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 border p-1">
                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownActionButton">
                            @foreach ($transaction_status as $status)
                                <li>
                                    <a href="#" wire:click.prevent="$set('selectedStatusFilter', '{{ $status['code'] }}')" class="block px-4 py-2 hover:bg-red-600 hover:text-white rounded-md">
                                        {{ $status['code'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" id="table-search-users" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for users">
                </div>
            </div>
            

            <!-- Tabel akan disembunyikan saat loading -->
            <div class="min-h-[20rem]">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">Transaction Number</th>
                            <th scope="col" class="px-6 py-3">Transaction Status</th>
                            <th scope="col" class="px-6 py-3">Grand Total</th>
                            <th scope="col" class="px-6 py-3">Buyer Name</th>
                            <th scope="col" class="px-6 py-3">Use Voucher</th>
                            <th scope="col" class="px-6 py-3">Total Quantity</th>
                            <th scope="col" class="px-6 py-3">Checkout At</th>
                            <th scope="col" class="px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $index => $trx)
                            @php
                                $color_status = '';
                                match($trx->transaction_status) {
                                    'PAID' => $color_status = 'green',
                                    'REFUND' => $color_status = 'orange',
                                    'CANCELLED' => $color_status = 'red',
                                    'PENDING' => $color_status = 'yellow',
                                };
                            @endphp

                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $trx->transaction_number }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-{{ $color_status }}-100 text-{{ $color_status }}-800 text-sm font-medium me-2 px-2.5 py-1 rounded-sm">
                                        {{ $trx->transaction_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @idr($trx->grand_total)
                                </td>
                                <td class="px-6 py-4">
                                    {{ $trx->buyer_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $trx->has_voucher ? 'Yes' : 'No' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $trx->total_quantity }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($trx->proceed_at)->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-right flex gap-2">
                                    <button
                                        data-tooltip-target="tooltip-detail-{{ $index }}"
                                        type="button"
                                        class="inline-block font-medium text-white bg-yellow-500 hover:bg-yellow-700 px-3 py-1 rounded">
                                            Detail
                                    </button>

                                    <button
                                        data-tooltip-target="tooltip-process-{{ $index }}"
                                        type="button"
                                        class="inline-block font-medium text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded">
                                            Process
                                    </button>

                                    <div id="tooltip-process-{{ $index }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                        Proceed Transaction
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>

                                    <div id="tooltip-detail-{{ $index }}" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                        Detail Transaction
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
