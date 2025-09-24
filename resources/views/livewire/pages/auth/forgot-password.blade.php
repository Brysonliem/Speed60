<div 
    class="w-full max-w-5xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm p-4 sm:p-6"
>
    <!-- Header -->
    <div class="flex items-center justify-between gap-2">
        <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Lupa Password</h3>
    </div>

    <!-- Grid dua kolom -->
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- KOLOM KIRI -->
        <div class="rounded-xl border border-gray-200 p-4 sm:p-6 transition-all duration-200">
            <div class="transition-all duration-200">
                <h4 class="text-base font-medium text-gray-900 mb-4">Masukkan email yang tertaut</h4>

                <form class="space-y-4" wire:submit.prevent="sendLink">
                    <div>
                        <label for="forgot-email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                        <input
                            id="forgot-email"
                            type="email"
                            wire:model.defer="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                            placeholder="nama@domain.com"
                            required
                            autocomplete="email"
                        >
                        @error('email') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Info / Error -->
                    @if($status)
                        <div class="text-green-600 text-sm">{{ $status }}</div>
                    @endif
                    @if($errorMsg)
                        <div class="text-red-600 text-sm">{{ $errorMsg }}</div>
                    @endif

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="sendLink"
                        class="w-full text-white bg-red-700 hover:bg-red-800 disabled:hover:bg-red-700/80 disabled:opacity-80 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center items-center"
                    >
                        <svg wire:loading wire:target="sendLink" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.59C100 78.2051 77.6142 100.591..." fill="#E5E7EB"/><path d="M93.9676 39.0409C96.393 38.4038 ..." fill="currentColor"/></svg>
                        <span wire:loading.remove wire:target="sendLink">Kirim Link Reset</span>
                        <span wire:loading wire:target="sendLink">Mengirim...</span>
                    </button>

                    <p class="text-xs text-gray-500 text-center">
                        Link reset password akan dikirim ke email kamu jika terdaftar.
                    </p>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-sm text-red-700 hover:underline">Kembali ke Login</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- KOLOM KANAN -->
        <div class="rounded-xl border border-gray-200 p-4 sm:p-6 transition-all duration-200">
            <div class="h-full flex flex-col items-center justify-center gap-3 p-2 text-center">
                <img src="/images/forgot_password_ornamen.png" alt="Reset Password" class="w-40 sm:w-56 opacity-90">
                <h5 class="text-lg font-semibold text-gray-900">Cek Kotak Masuk</h5>
                <p class="text-sm text-gray-600">
                    Kami akan mengirimkan tautan untuk menyetel ulang password ke email yang kamu masukkan.
                </p>
            </div>
        </div>
    </div>

    <!-- Footer kecil opsional -->
    <div class="mt-6 flex items-center justify-center">
        <img src="/images/speed60.png" alt="Logo" class="w-16 h-16 opacity-80">
        <span class="text-xs font-bold text-gray-400">V1.0.0</span>
    </div>
</div>
