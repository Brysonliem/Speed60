<div class="w-full sm:max-w-sm md:max-w-md lg:max-w-lg bg-white border border-gray-200 rounded-lg shadow-sm p-6 sm:p-8">
    <form class="space-y-6" wire:submit.prevent="login">
        
        <h5 class="text-xl font-medium text-gray-900">Sign in to our platform</h5>

        <div>
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
            <input wire:model.defer="loginForm.username" type="text" id="username"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   required>
            @error('loginForm.username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input wire:model.defer="loginForm.password" type="password" id="password"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                   required>
            @error('loginForm.password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- <div class="flex justify-between items-center text-sm">
            <a href="#" class="text-blue-700 hover:underline">Forgot Password?</a>
        </div> --}}

        <button
            type="submit"
            wire:loading.attr="disabled"
            wire:target="login"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex justify-center items-center"
        >
            <svg
                wire:loading
                wire:target="login"
                class="inline w-4 h-4 me-3 text-white animate-spin"
                viewBox="0 0 100 101"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path d="M100 50.59C100 78.2051 77.6142 100.591..." fill="#E5E7EB"/>
                <path d="M93.9676 39.0409C96.393 38.4038 ..." fill="currentColor"/>
            </svg>
            <span wire:loading.remove wire:target="login">Login</span>
            <span wire:loading wire:target="login">Loading...</span>
        </button>

        <div class="text-sm font-medium text-gray-500 text-center">
            Not registered? <a href="{{ route('register') }}" class="text-blue-700 hover:underline">Create account</a>
        </div>

        {{-- Gambar di bawah card --}}
        <div class="flex justify-center">
            <img src="/images/speed60.png" alt="Logo" class="w-20 h-20">
        </div>
    </form>
</div>
