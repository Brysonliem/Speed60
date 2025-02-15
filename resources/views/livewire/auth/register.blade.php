<div class="w-full">
    {{-- input form --}}
    <form wire:submit.prevent="register">
        <div class="flex flex-col gap-2 mt-3">
            <div>
                <x-input-label for="role" value="Role" />
                <x-select wire:model="role_level" id="role" class="w-full" placeholder="">
                    <option value="">Pilih Role</option>
                    <option value="1">SUPERADMIN</option>
                    <option value="2">ADMIN</option>
                </x-select>
                @error('role_level') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="name" value="Fullname" />
                <x-input wire:model="name" id="fullname" class="block mt-1 w-full" type="text" required autofocus autocomplete="fullname" />
                @error('fullname') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="username" value="Username" />
                <x-input wire:model="username" id="username" class="block mt-1 w-full" type="text" required autofocus autocomplete="username" />
                @error('username') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="email" value="Email" />
                <x-input wire:model="email" id="email" class="block mt-1 w-full" type="text" required autofocus autocomplete="email" />
                @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="birth_date" value="Birth Date" />
                <x-date-input wire:model="birth_date" id="birth_date" class="block mt-1 w-full" type="date" required autocomplete="current-password" />
                @error('birth_date') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <x-input-label for="rt" value="RT" />
                    <x-input wire:model="rt" id="rt" class="block mt-1 w-full" type="text" required />
                    @error('rt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            
                <div>
                    <x-input-label for="rw" value="RW" />
                    <x-input wire:model="rw" id="rw" class="block mt-1 w-full" type="text" required />
                    @error('rw') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            
                <div>
                    <x-input-label for="blok" value="Block" />
                    <x-input wire:model="block" id="blok" class="block mt-1 w-full" type="text" required />
                    @error('blok') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>            
            
            <div>
                <x-input-label for="province" value="Province" />
                <x-input wire:model="province" id="province" class="block mt-1 w-full" type="text" required autocomplete="province" />
                @error('province') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="district" value="District" />
                <x-input wire:model="district" id="district" class="block mt-1 w-full" type="text" required autocomplete="district" />
                @error('district') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="city" value="City" />
                <x-input wire:model="city" id="city" class="block mt-1 w-full" type="text" required autocomplete="city" />
                @error('city') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="password" value="Password" />
                <x-input wire:model="password" id="password" class="block mt-1 w-full" type="password" required autocomplete="current-password" />
                @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div >
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
    
                <x-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                @error('password_confirmation') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="flex gap-2">
                <x-button type="submit">
                    Submit
                </x-button>
                <x-button-secondary type="button" wire:click="login">
                    Login
                </x-button-secondary>
            </div>
        </div>
    </form>

    {{-- Pesan Sukses --}}
    @if (session()->has('message'))
        <div class="mt-3 text-green-500">
            {{ session('message') }}
        </div>
    @endif
</div>
