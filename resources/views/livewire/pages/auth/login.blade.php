<div 
    x-data="{ active: @entangle('active') }"
    class="w-full max-w-5xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm p-4 sm:p-6"
>
    <!-- Header + Switch -->
    <div class="flex items-center justify-between gap-2">
        <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Masuk / Daftar</h3>
        <div class="inline-flex rounded-lg border border-gray-200 overflow-hidden">
            <button
                type="button"
                @click="active = 'login'"
                :class="active === 'login' ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                class="px-4 py-2 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-red-200"
                :aria-pressed="(active === 'login').toString()"
            >
                Login
            </button>
            <button
                type="button"
                @click="active = 'register'"
                :class="active === 'register' ? 'bg-red-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50'"
                class="px-4 py-2 text-sm font-medium border-l border-gray-200 focus:outline-none focus:ring-2 focus:ring-red-200"
                :aria-pressed="(active === 'register').toString()"
            >
                Register
            </button>
        </div>
    </div>

    <!-- Grid dua kolom -->
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6" x-cloak>

        <!-- KOLOM KIRI -->
        <div class="rounded-xl border border-gray-200 p-4 sm:p-6 transition-all duration-200">

            <!-- Jika LOGIN aktif: tampilkan FORM LOGIN di kiri -->
            <template x-if="active === 'login'">
            <div
                class="transition-all duration-200"
                class="opacity-50 shadow-inner pointer-events-none select-none"
                :aria-hidden="(active !== 'login').toString()"
            >
                <h4 class="text-base font-medium text-gray-900 mb-4">Login</h4>

                @if ($errors->any())
                    <div class="my-1 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form class="space-y-4" wire:submit.prevent="login">
                    <div>
                        <label for="login-username" class="block mb-1 text-sm font-medium text-gray-900">Username</label>
                        <input
                        id="login-username"
                        type="text"
                        wire:model.defer="loginForm.username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                        required
                        >
                        

                    </div>

                    <div>
                        <label for="login-password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                        <input
                        id="login-password"
                        type="password"
                        wire:model.defer="loginForm.password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                        required
                        >
                        @error('loginForm.password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>


                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="login"
                        class="w-full text-white bg-red-700 hover:bg-red-800 disabled:hover:bg-red-700/80 disabled:opacity-80 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center items-center"
                    >
                        <svg wire:loading wire:target="login" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.59C100 78.2051 77.6142 100.591..." fill="#E5E7EB"/><path d="M93.9676 39.0409C96.393 38.4038 ..." fill="currentColor"/></svg>
                        <span wire:loading.remove wire:target="login">Login</span>
                        <span wire:loading wire:target="login">Loading...</span>
                    </button>

                    <!-- Teks di bawah tombol -->
                    <p class="mt-3 text-center text-sm text-gray-600">
                    Lupa password?
                        <a href="{{ route('password.request') }}" class="text-red-700 font-medium hover:underline">
                            Reset di sini
                        </a>
                    </p>
                </form>
            </div>
            </template>

            <!-- Jika LOGIN tidak aktif: tampilkan ORNAMEN/TEKS di kiri -->
            <template x-if="active !== 'login'">
            <div class="h-full flex flex-col items-center justify-center gap-3 p-2">
                <img src="/images/register_ornamen.png" alt="Daftar Lebih Mudah" class="w-40 sm:w-56 opacity-90">
                <h5 class="text-lg font-semibold text-gray-900">Buat akun baru</h5>
                <p class="text-sm text-gray-600">Satu akun untuk kelola pencarian & penawaranmu. Cepat, aman, gratis.</p>
            </div>
            </template>
        </div>

        <!-- KOLOM KANAN -->
        <div class="rounded-xl border border-gray-200 p-4 sm:p-6 transition-all duration-200">

            <!-- Jika REGISTER aktif: tampilkan FORM REGISTER di kanan -->
            <template x-if="active === 'register'">
            <div
                class="transition-all duration-200"
                \class="opacity-50 shadow-inner pointer-events-none select-none"
                :aria-hidden="(active !== 'register').toString()"
            >
                <h4 class="text-base font-medium text-gray-900 mb-4">Register</h4>

                <form class="space-y-4" wire:submit.prevent="register">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                    <label for="reg-username" class="block mb-1 text-sm font-medium text-gray-900">Username</label>
                    <input id="reg-username" type="text" wire:model.defer="reg_username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                    @error('reg_username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                    <label for="reg-name" class="block mb-1 text-sm font-medium text-gray-900">Fullname</label>
                    <input id="reg-name" type="text" wire:model.defer="reg_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                    @error('reg_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="reg-email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                    <input id="reg-email" type="email" wire:model.defer="reg_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                    @error('reg_email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                    <label for="reg-password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
                    <input id="reg-password" type="password" wire:model.defer="reg_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                    @error('reg_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                    <label for="reg-password-confirm" class="block mb-1 text-sm font-medium text-gray-900">Confirm Password</label>
                    <input id="reg-password-confirm" type="password" wire:model.defer="reg_password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" required>
                    @error('reg_password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:target="register"
                    class="w-full text-white bg-red-700 hover:bg-red-800 disabled:hover:bg-red-700/80 disabled:opacity-80 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center items-center"
                >
                    <svg wire:loading wire:target="register" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.59C100 78.2051 77.6142 100.591..." fill="#E5E7EB"/><path d="M93.9676 39.0409C96.393 38.4038 ..." fill="currentColor"/></svg>
                    <span wire:loading.remove wire:target="register">Create Account</span>
                    <span wire:loading wire:target="register">Processing...</span>
                </button>
                </form>
            </div>
            </template>

            <!-- Jika REGISTER tidak aktif: tampilkan ORNAMEN/TEKS di kanan -->
            <template x-if="active !== 'register'">
            <div class="h-full flex flex-col items-center justify-center gap-3 p-2">
                <img src="/images/login_ornamen.png" alt="Masuk Lebih Cepat" class="w-40 sm:w-56 opacity-90">
                <h5 class="text-lg font-semibold text-gray-900">Sudah punya akun?</h5>
                <p class="text-sm text-gray-600">Masuk untuk melanjutkan progres & favoritmu.</p>
            </div>
            </template>
        </div>
    </div>


    <!-- Footer kecil opsional -->
    <div class="mt-6 flex items-center justify-center">
        <img src="/images/speed60.png" alt="Logo" class="w-16 h-16 opacity-80">
        <span class="text-xs font-bold text-gray-400">V1.0.0</span>
    </div>
</div>
