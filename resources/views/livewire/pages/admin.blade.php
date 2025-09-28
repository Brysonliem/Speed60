<div class="mt-20">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
        <!-- Products Card -->
        <div class="flex items-center justify-between h-24 rounded-sm bg-white shadow px-4">
            <div>
                <p class="text-gray-500 text-sm">Products</p>
                <p class="text-xl font-semibold text-gray-800">{{ $products_count }}</p>
            </div>
            <div class="text-blue-600 bg-blue-100 p-2 rounded-full">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884l7.197-4.2a1 1 0 011.6.8v14.032a1 1 0 01-1.6.8l-7.197-4.2a1 1 0 010-1.6l7.197-4.2a1 1 0 010-1.6l-7.197-4.2a1 1 0 010-1.6z" />
                </svg>
            </div>
            </div>

            <!-- Vouchers Card -->
            <div class="flex items-center justify-between h-24 rounded-sm bg-white shadow px-4">
                <div>
                    <p class="text-gray-500 text-sm">Vouchers</p>
                    <p class="text-xl font-semibold text-gray-800">{{ $vouchers_count }}</p>
                </div>
                <div class="text-green-600 bg-green-100 p-2 rounded-full">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 6.293l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586l7.293-7.293a1 1 0 111.414 1.414z" />
                    </svg>
                </div>
                </div>

                <!-- Reviews Card -->
                <div class="flex items-center justify-between h-24 rounded-sm bg-white shadow px-4">
                <div>
                    <p class="text-gray-500 text-sm">Reviews</p>
                    <p class="text-xl font-semibold text-gray-800">{{ $reviews_count }}</p>
                </div>
                <div class="text-yellow-600 bg-yellow-100 p-2 rounded-full">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.966h4.175c.969 0 1.371 1.24.588 1.81l-3.38 2.455 1.286 3.966c.3.921-.755 1.688-1.54 1.118l-3.38-2.455-3.38 2.455c-.784.57-1.838-.197-1.539-1.118l1.285-3.966-3.379-2.455c-.784-.57-.38-1.81.588-1.81h4.175L9.05 2.927z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Greetings Card -->
        <div class="relative overflow-hidden flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-900 text-white p-6 text-center">
            <!-- Gambar Background Asap -->
            <img 
                src="{{ asset('/images/speed60_resized.png') }}" 
                alt="Background Smoke" 
                class="absolute w-[600px] h-auto top-5 -left-10 rotate-12 opacity-25 blur-sm transform pointer-events-none select-none"
            />

            <!-- Konten -->
            <div class="relative z-10">
                {{-- <img src="{{ asset('/images/speed60_resized.png') }}" alt=""> --}}
                <h2 class="text-2xl font-bold mb-2">Welcome Back, Admin! 👋</h2>
                <p class="text-sm">Here’s a quick overview of your platform activity today. Let’s make the most of it!</p>
            </div>
        </div>

    {{-- <div class="grid grid-cols-2 gap-4 mb-4">
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400 ">
            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400 ">
            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400 ">
            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            </p>
        </div>
        <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
            <p class="text-2xl text-gray-400 ">
            <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
            </svg>
            </p>
        </div>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50">
            <p class="text-2xl text-gray-400 ">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
            </p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
                <p class="text-2xl text-gray-400 ">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
                <p class="text-2xl text-gray-400 ">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
                <p class="text-2xl text-gray-400 ">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
                </p>
            </div>
            <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
                <p class="text-2xl text-gray-400 ">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
                </p>
            </div>
        </div>
    </div> --}}
</div>