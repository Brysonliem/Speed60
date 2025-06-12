<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 mt-10">
    <!-- Tombol Back + Title -->
    <div class="flex items-center gap-4">
        <!-- Tombol Kembali -->
        <a href="{{ url()->previous() }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <!-- Divider -->
        <div class="w-px h-5 bg-gray-300"></div>

        <!-- Title -->
        @if (isset($title))
            <h1 class="text-lg sm:text-xl font-semibold text-gray-900 leading-none sm:leading-tight">
                {{ $title }}
            </h1>
        @endif
    </div>
</div>
