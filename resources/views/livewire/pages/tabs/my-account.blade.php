<div x-show="activeTab === 'my-account'" class="p-4 rounded-lg bg-gray-50 shadow-md" id="my-account" role="tabpanel" aria-labelledby="my-account-tab">
    <div class="flex flex-col md:flex-row gap-5">
        {{-- AVATAR --}}
        {{-- <div class="flex justify-center md:justify-start">
            <img class="rounded-full w-40 h-4w-40 md:w-52 md:h-52 object-cover" src="{{ asset('images/avatar.jpg') }}" alt="image description">
        </div> --}}

        {{-- FORM PROFILE --}}
        <form class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
            <div>
                <label for="display-name" class="block mb-1 text-sm font-medium text-gray-900">Display Name</label>
                <input wire:model.defer="user.name" type="text" id="display-name" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div>
                <label for="username" class="block mb-1 text-sm font-medium text-gray-900">Username</label>
                <input wire:model.defer="user.username" type="text" id="username" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                <input wire:model.defer="user.email" type="email" id="email" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div>
                <label for="phone" class="block mb-1 text-sm font-medium text-gray-900">Phone</label>
                <input wire:model.defer="user.phone_number" type="tel" id="phone" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div class="md:col-span-2 mt-3 flex flex-wrap gap-2">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- DESTINATION ADDRESS --}}
    <div class="border-t border-gray-300/50 my-6"></div>
    <h2 class="text-lg font-semibold mb-2">Destination Address</h2>
    <form class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="address" class="block mb-1 text-sm font-medium text-gray-900">Alamat Lengkap</label>
            <input wire:model.defer="user.address" id="address" type="text"
                class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                required />
        </div>

        <div>
            <label for="province" class="block mb-1 text-sm font-medium text-gray-900">Provinsi</label>
            <input wire:model.defer="user.province" id="province" type="text"
                class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                required />
        </div>

        <div>
            <label for="city" class="block mb-1 text-sm font-medium text-gray-900">Kota/Kabupaten</label>
            <input wire:model.defer="user.city" id="city" type="text"
                class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                required />
        </div>

        <div>
            <label for="district" class="block mb-1 text-sm font-medium text-gray-900">Kecamatan</label>
            <input wire:model.defer="user.district" id="district" type="text"
                class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5"
                required />
        </div>

        <!-- Grid untuk Blok, RT, dan RW -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div>
                <label for="block" class="block mb-1 text-sm font-medium text-gray-900">Blok</label>
                <input wire:model.defer="user.block" id="block" type="text"
                    class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" />
            </div>

            <div>
                <label for="rt" class="block mb-1 text-sm font-medium text-gray-900">RT</label>
                <input wire:model.defer="user.rt" id="rt" type="text"
                    class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" />
            </div>

            <div>
                <label for="rw" class="block mb-1 text-sm font-medium text-gray-900">RW</label>
                <input wire:model.defer="user.rw" id="rw" type="text"
                    class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" />
            </div>
        </div>


        <div class="md:col-span-2 mt-3">
            <button type="button" wire:click="update"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Save Changes
            </button>
        </div>
    </form>


    {{-- CHANGE PASSWORD --}}
    <div class="border-t border-gray-300/50 my-6"></div>
    <h2 class="text-lg font-semibold mb-2">Change Password</h2>

    <form wire:submit.prevent="changePassword" class="grid grid-cols-1 gap-4">
        {{-- Flash Message --}}
        @if (session()->has('success'))
            <div class="p-2 bg-green-100 text-green-700 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div>
            <label for="new-password" class="block mb-1 text-sm font-medium text-gray-900">New Password</label>
            <input wire:model.defer="new_password" type="password" id="new-password"
                class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            @error('new_password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="confirm-password" class="block mb-1 text-sm font-medium text-gray-900">Confirm Password</label>
            <input wire:model.defer="new_password_confirmation" type="password" id="confirm-password"
                class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
        </div>

        <div class="mt-3">
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Save Changes
            </button>
        </div>
    </form>

</div>
