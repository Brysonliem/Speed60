<style>
  .xmark-circle {
      stroke-dasharray: 166;
      stroke-dashoffset: 166;
      animation: stroke 0.6s ease forwards;
  }
  .xmark-line {
      stroke-dasharray: 48;
      stroke-dashoffset: 48;
      animation: stroke 0.4s 0.6s ease forwards;
  }
  @keyframes stroke {
      to { stroke-dashoffset: 0; }
  }
</style>

<div class="flex flex-col gap-4 p-4 md:p-8">
  <div class="block w-full py-20 bg-white rounded-lg shadow-sm">
    <div class="flex flex-col justify-center items-center w-auto h-full">
      <svg class="w-24 h-24 text-red-600 mb-6" viewBox="0 0 52 52" aria-hidden="true">
        <circle class="xmark-circle" cx="26" cy="26" r="25" fill="none" stroke="currentColor" stroke-width="2"/>
        <path class="xmark-line" fill="none" stroke="currentColor" stroke-width="5" d="M18 18 L34 34"/>
        <path class="xmark-line" fill="none" stroke="currentColor" stroke-width="5" d="M34 18 L18 34"/>
      </svg>

      <span class="text-center text-xl font-semibold">
        Pembayaran Gagal Diproses
      </span>

      <span class="text-center text-sm text-gray-500 mt-1">
        @if($reasonLabel)
          {{ $reasonLabel }}
        @else
          Maaf, transaksi Anda tidak dapat diproses. Silakan coba lagi atau gunakan metode pembayaran lain.
        @endif
      </span>

      <div class="flex flex-wrap items-center gap-3 mt-10">
        @if($canRetry)
          <button wire:click="retryPayment"
                  type="button"
                  class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
            Coba Bayar Lagi
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
          </button>
        @endif

        <button wire:click="redirectToDashboardUser"
                type="button"
                class="text-gray-700 bg-gray-200 hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
          Kembali Ke Utama
          <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>
        </button>
      </div>

      @if($supportMsg)
        <p class="text-xs text-gray-400 mt-4">{{ $supportMsg }}</p>
      @endif
    </div>
  </div>
</div>
