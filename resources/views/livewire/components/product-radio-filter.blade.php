<div class="w-full overflow-x-auto">
    <ul class="flex items-center md:grid md:grid-cols-6 gap-0 overflow-x-auto">
        @foreach ($vehicles as $vehicle)
            <li class="group min-w-fit">
                <input type="radio" id="{{ $vehicle['id'] }}" name="hosting" value="{{ $vehicle['value'] }}"
                    class="hidden peer" required />
                <label for="{{ $vehicle['id'] }}"
                    class="flex flex-col gap-3 items-center justify-between w-full p-5 text-gray-500 cursor-pointer border-b-2  peer-checked:border-blue-600 peer-checked:text-blue-600">
                    {{-- <img src="{{ $vehicle['url']}}"
                        class="h-40 object-contain group-hover:scale-110 group-hover:duration-75 duration-75" /> --}}
                    <p class="text-uppercase font-medium peer-checked:font-semibold">{{ $vehicle['label'] }}</p>
                </label>
            </li>
        @endforeach
    </ul>
</div>