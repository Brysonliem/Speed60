<div class="w-full overflow-x-auto">
    <ul class="flex items-center md:grid md:grid-cols-6 gap-0 overflow-x-auto">
        @foreach ($vehicles as $vehicle)
            <li class="group min-w-fit">
                <input type="radio" 
                    id="{{ $vehicle['id'] }}" 
                    name="hosting" 
                    value="{{ $vehicle['value'] }}"
                    class="hidden peer" required />
                <label for="{{ $vehicle['id'] }}"
                    class="block w-full cursor-pointer">
                    <a href="{{ route($vehicle['route'], ['motor_type' => $vehicle['value']]) }}"
                        class="flex flex-col gap-3 items-center justify-between p-5 text-gray-500 border-b-2 border-transparent peer-checked:border-red-600 peer-checked:text-red-600 group-hover:text-red-600 group-hover:border-red-600">
                        <p class="text-uppercase font-medium peer-checked:font-semibold">
                            {{ $vehicle['label'] }}
                        </p>
                    </a>

                </label>
            </li>
        @endforeach


    </ul>
</div>