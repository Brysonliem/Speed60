<div x-show="activeTab === 'my-orders'" x-cloak class="p-4 rounded-lg bg-gray-50 shadow-md" id="my-orders" role="tabpanel" aria-labelledby="my-orders-tab">
    <div class="flex flex-col gap-3">
        @if ($detail_transaction)
            <div class="flex flex-col md:flex-row w-full bg-red-600 items-start md:items-center p-4 rounded-md mb-4 gap-2">
                <div class="flex flex-col text-white">
                    <span class="text-lg font-semibold">{{ $detail_transaction->transaction_number }}</span>
                    <span class="text-sm font-medium">
                        {{ $detail_transaction->total_product }} Produk - 
                        Pesanan Dibuat {{ \Carbon\Carbon::parse($detail_transaction->created_at)->translatedFormat('d M Y H:i') }}
                    </span>
                </div>
                <span class="text-2xl font-bold md:ms-auto text-white">
                    @idr($detail_transaction->grand_total)
                </span>
            </div>

            {{-- STEPPER --}}
            <div class="w-full overflow-x-auto">
                <ol class="flex items-center w-full max-w-full mx-auto min-w-[480px] mb-5">
                    {{--  --}}
                    <li class="flex items-center w-full after:content-[''] after:w-full after:h-1 after:border-b after:border-red-100 after:border-4 after:inline-block">
                        <span class="flex items-center justify-center w-10 h-10 bg-red-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-4 h-4 text-red-800 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                            </svg>
                        </span>
                    </li>

                    {{-- Step 2 --}}
                    <li class="flex items-center w-full after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
                        <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-4 h-4 text-gray-500 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z"/>
                            </svg>
                        </span>
                    </li>

                    {{-- Step 3 --}}
                    <li class="flex items-center w-full after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block">
                        <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-4 h-4 text-gray-500 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                            </svg>
                        </span>
                    </li>

                    {{-- Step 4 --}}
                    <li class="flex items-center w-full">
                        <span class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 shrink-0">
                            <svg class="w-4 h-4 text-gray-500 lg:w-5 lg:h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z"/>
                            </svg>
                        </span>
                    </li>
                </ol>
            </div>

        @endif

        @php
            $columns = ['ORDER ID', 'STATUS', 'TRANSACTION DATE', 'TOTAL'];
        @endphp

        <div class="flex flex-col gap-2">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            @foreach ($columns as $column)
                                <th scope="col" class="px-3 md:px-6 py-2 md:py-4">
                                    {{ $column }}
                                </th>
                            @endforeach
                            <th scope="col" class="px-3 md:px-6 py-2 md:py-4">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $index => $trx)
                            @php
                                $color_status = match($trx->transaction_status) {
                                    'PAID' => 'green',
                                    'REFUND' => 'orange',
                                    'CANCELLED' => 'red',
                                    'PENDING' => 'yellow',
                                    default => 'gray'
                                };
                            @endphp

                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-3 md:px-6 py-2 md:py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $trx->transaction_number }}
                                </td>
                                <td class="px-3 md:px-6 py-2 md:py-4">
                                    <span class="bg-{{ $color_status }}-100 text-{{ $color_status }}-800 text-sm font-medium me-2 px-2.5 py-1 rounded-sm">
                                        {{ $trx->transaction_status }}
                                    </span>
                                </td>
                                <td class="px-3 md:px-6 py-2 md:py-4">
                                    {{ \Carbon\Carbon::parse($trx->transaction_date)->format('d-m-Y H:i') }}
                                </td>
                                <td class="px-3 md:px-6 py-2 md:py-4">
                                    @idr($trx->grand_total) ({{ $trx->total_product }} BARANG)
                                </td>
                                <td class="px-3 md:px-6 py-2 md:py-4 text-right">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <button
                                            wire:click="showDetail({{ $trx->id }})"
                                            data-tooltip-target="tooltip-detail-{{ $index }}"
                                            type="button"
                                            class="inline-block font-medium text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded">
                                            Detail
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3 md:px-6 py-4 text-center text-gray-500">
                                    <span class="text-lg">Transaksi tidak ditemukan.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
