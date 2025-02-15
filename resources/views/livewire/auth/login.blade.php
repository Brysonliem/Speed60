<div class="w-full">
    {{-- input form --}}
    <form wire:submit.prevent="login">
        <div class="flex flex-col gap-2 mt-3">
            <div>
                <x-input-label for="username" value="Username" />
                <x-input wire:model.defer="loginForm.username" id="username" class="block mt-1 w-full" type="text" required autofocus autocomplete="username" />
                @error('loginForm.username') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="password" value="Password" />
                <x-input wire:model.defer="loginForm.password" id="password" class="block mt-1 w-full" type="password" required autocomplete="current-password" />
                @error('loginForm.password') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="flex gap-2">
                <x-button type="submit">
                    Log In
                </x-button>
                <x-button-secondary type="button" wire:click="register">
                    Register Page
                </x-button-secondary>
            </div>
        </div>
    </form>
</div>
