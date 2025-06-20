<style>
    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        animation: stroke 0.6s ease forwards;
    }

    .checkmark-check {
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.4s 0.6s ease forwards;
    }

    @keyframes stroke {
        to {
            stroke-dashoffset: 0;
        }
    }
</style>

<div class="flex flex-col gap-4 p-4 md:p-8">
    <!-- Breadcrumb -->
    {{-- @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Produk', 'url' => route('products.index')],
        ['name' => 'Checkout', 'url' => route('products.checkout')]
    ]]) --}}

    <div class="block w-full py-20 bg-white rounded-lg shadow-sm">
        <div class="flex flex-col justify-center items-center w-auto h-full">
            <svg class="w-24 h-24 text-green-600 mb-6" viewBox="0 0 52 52">
    <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" stroke="currentColor" stroke-width="2"/>
    <path class="checkmark-check" fill="none" stroke="currentColor" stroke-width="5" d="M14 27l7 7 16-16"/>
</svg>
            <span class="text-center text-xl font-semibold">
                Yeay, Pesanan anda berhasil!
            </span>
            <span class="text-center text-sm text-gray-400">
                Terimakasih telah berbelanja dengan kami! Pesanan anda sedang kami proses
            </span>
            <button wire:click="redirectToDashboardUser" type="button" class="mt-10 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Kembali Ke Utama
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </button>
        </div>
    </div>        

</div>
