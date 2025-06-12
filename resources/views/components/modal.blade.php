<div 
    x-cloak 
    x-show="open" 
    x-transition.opacity 
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
    {{-- id="{{ $id }}" --}}
>
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        @click.away="open = false"
        class="bg-white rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-2/3 lg:w-1/2 xl:max-w-md p-6"
    >
        @isset($title)
            <h2 class="text-xl font-semibold mb-4 text-center">{{ $title }}</h2>
        @endisset

        <div class="mb-6">
            {{ $slot }}
        </div>

        @isset($footer)
            <div class="flex gap-2">
                {{ $footer }}
            </div>
        @endisset
    </div>
</div>
