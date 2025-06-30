<div
    x-data="{ open: @entangle('show') }"
    x-show="open"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
>
    <div
        x-show="open"
        x-transition
        @click.away="open = false; $wire.close()"
        class="relative bg-white rounded-lg shadow-lg max-w-4xl w-full mx-4 overflow-hidden"
    >
        <!-- Tombol Silang -->
        <button
            @click="open = false; $wire.close()"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-10"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="sr-only">Close</span>
        </button>

        <!-- Konten Modal -->
        <div class="flex flex-col md:flex-row items-center gap-6 p-6 md:p-10">

            <!-- Gambar -->
            <div class="md:w-1/3 flex justify-center">
                <img src="{{ asset('/images/promo_image_speed60.jpg') }}"
                     alt="Promo"
                     class="w-40 h-40 md:w-64 md:h-64 object-cover rounded-md shadow-md" />
            </div>

            <!-- Konten -->
            <div class="md:w-2/3 text-center md:text-left">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                    Want <span class="text-red-500">10% OFF*</span>
                </h2>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                    Your First Order?
                </h2>

                <form wire:submit.prevent="submit" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @csrf

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <input wire:model="form.email" type="email" name="email" required placeholder="Email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-red-500 focus:outline-none" />
                    </div>

                    <!-- First Name -->
                    <div>
                        <input wire:model="form.first_name" type="text" name="first_name" required placeholder="First Name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-red-500 focus:outline-none" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <input wire:model="form.last_name" type="text" name="last_name" required placeholder="Last Name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-red-500 focus:outline-none" />
                    </div>

                    <!-- Nomor Telefon -->
                    <div class="sm:col-span-2">
                        <input wire:model="form.phone" name="phone" required placeholder="Number phone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-red-500 focus:outline-none" />
                    </div>

                    <!-- Submit -->
                    <div class="sm:col-span-2">
                        <button type="submit" 
                            class="w-full px-6 py-3 text-white bg-red-500 hover:bg-red-600 font-semibold rounded-md transition">
                            Get 10% Off
                        </button>
                    </div>
                </form>

                <!-- Toast Notification -->
                @if (session()->has('success'))
                    <div id="toast-success"
                        x-data="{ show: true }"
                        x-init="setTimeout(() => show = false, 4000)"
                        x-show="show"
                        x-transition
                        class="flex items-center w-full mt-4 p-4 text-red-800 bg-red-300 rounded-md shadow"
                        role="alert"
                    >
                        <svg class="w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 5.707 8.293a1 1 0 00-1.414 1.414l4 4a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                        </svg>
                        <div class="text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>
</div>
