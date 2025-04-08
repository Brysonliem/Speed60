<div class="w-full max-w-md p-6 bg-white border border-gray-200 rounded-lg shadow-sm my-5">
    <form class="space-y-6" wire:submit.prevent="register">
        <h5 class="text-xl font-medium text-gray-900">Create your account</h5>
        
        {{-- <div>
            <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
            <select wire:model="role_level" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @foreach ($roles as $role)
                    <option value="{{ $role->level }}">{{ strtoupper($role->name) }}</option>
                @endforeach
            </select>
            @error('role_level') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div> --}}
        
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
            <input wire:model="name" id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
            <input wire:model="email" id="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Birth Date --}}
        
        <div class="relative max-w-sm">
            <label for="birth date" class="block mb-2 text-sm font-medium text-gray-900">Birth Date</label>
            {{-- <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div> --}}
            <input datepicker wire:model="birth_date" id="birth_date" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="">
            @error('birth_date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- RT, RW, Block --}}
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="RT" class="block mb-2 text-sm font-medium text-gray-900">RT</label>
                <input wire:model="rt" id="rt" type="rt" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                @error('rt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="RW" class="block mb-2 text-sm font-medium text-gray-900">RW</label>
                <input wire:model="rw" id="rw" type="rw" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                @error('rw') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="Block" class="block mb-2 text-sm font-medium text-gray-900">Block</label>
                <input wire:model="block" id="block" type="block" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                @error('block') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Province --}}
        <div>
            <x-input-label for="province" value="Province" />
            <input wire:model="province" id="province" type="province" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('province') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- District --}}
        <div>
            <x-input-label for="district" value="District" />
            <input wire:model="district" id="district" type="district" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('district') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        {{-- City --}}
        <div>
            <x-input-label for="city" value="City" />
            <input wire:model="city" id="city" type="city" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input wire:model="password" id="password" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
            <input wire:model="password_confirmation" id="password_confirmation" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Register</button>
        
        <div class="text-sm font-medium text-gray-500">
            Already have an account? <a href="{{ route('login') }}" class="text-blue-700 hover:underline">Login</a>
        </div>
    </form>
</div>
