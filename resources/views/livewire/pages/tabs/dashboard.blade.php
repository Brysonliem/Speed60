{{-- dashboard --}}
<div class="p-4 rounded-lg bg-gray-50 shadow-md flex flex-col gap-3" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">

    @php
        $columns = ['ORDER ID', 'STATUS', 'TRANSACTION DATE', 'TOTAL'];
        $rows = $transactions;
    @endphp

    {{-- Table --}}
    <div class="flex flex-col gap-2 ">
        <div class="flex items-center">
            <span class="text-sm font-medium">ORDER HISTORY</span>
            <a href="#" class="text-sm font-medium ms-auto text-blue-600">VIEW ALL</a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 whitespace-nowrap">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        @foreach ($columns as $column)
                            <th scope="col" class="px-4 py-3">
                                {{ $column }}
                            </th>
                        @endforeach
                        <th scope="col" class="px-4 py-3">
                            <span class="sr-only">Action</span>
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
                                'COMPLETED' => 'green'
                            };
                        @endphp

                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $trx->transaction_number }}</td>
                            <td class="px-4 py-3">
                                <span class="bg-{{ $color_status }}-100 text-{{ $color_status }}-800 text-xs font-medium px-2.5 py-1 rounded">
                                    {{ $trx->transaction_status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($trx->transaction_date)->format('d-m-Y H:i') }}
                            </td>
                            <td class="px-4 py-3">
                                @idr($trx->grand_total) ({{ $trx->total_product }} BARANG)
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button
                                    type="button"
                                    class="inline-block font-medium text-white bg-yellow-400 hover:bg-yellow-500 px-3 py-1 rounded">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                <span class="text-sm">Transaksi tidak ditemukan.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
