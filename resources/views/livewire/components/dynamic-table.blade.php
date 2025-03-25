<div class="relative overflow-x-auto shadow-md border border-gray-100">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                @foreach($columns as $column)
                    <th scope="col" class="px-6 py-3">{{ $column }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
                <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-gray-50' }} border-b border-gray-200">
                    @foreach($columns as $key => $column)
                        <td class="px-6 py-4">{!! $row[$key] ?? '-' !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
