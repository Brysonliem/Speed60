{{-- input form --}}
<div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-6 md:p-8">
    <form class="space-y-6" wire:submit.prevent="login">
        <h5 class="text-xl font-medium text-gray-900 ">Sign in to our platform</h5>
        <div>
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 ">Username</label>
            <input wire:model.defer="loginForm.username" type="username" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
            @error('loginForm.username') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 ">Password</label>
            <input wire:model.defer="loginForm.password" type="password" name="password" id="password"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
            @error('loginForm.password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="flex items-start">
            <a href="#" class="ms-auto text-sm text-blue-700 hover:underline ">Lost Password?</a>
        </div>
        <button wire:click="login" type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Login</button>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
            Not registered? <a href="{{ route('register') }}" class="text-blue-700 hover:underline ">Create account</a>
        </div>
    </form>
</div>