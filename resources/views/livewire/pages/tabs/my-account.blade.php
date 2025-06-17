<div x-show="activeTab === 'my-account'" class="p-4 rounded-lg bg-gray-50 shadow-md" id="my-account" role="tabpanel" aria-labelledby="my-account-tab">
    <div class="flex flex-col md:flex-row gap-5">
        {{-- AVATAR --}}
        <div class="flex justify-center md:justify-start">
            <img class="rounded-full w-40 h-4w-40 md:w-52 md:h-52 object-cover" src="{{ asset('images/avatar.jpg') }}" alt="image description">
        </div>

        {{-- FORM PROFILE --}}
        <form class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
            <div>
                <label for="display-name" class="block mb-1 text-sm font-medium text-gray-900">Display Name</label>
                <input type="text" id="display-name" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div>
                <label for="username" class="block mb-1 text-sm font-medium text-gray-900">Username</label>
                <input type="text" id="username" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div>
                <label for="fullname" class="block mb-1 text-sm font-medium text-gray-900">Full Name</label>
                <input type="text" id="fullname" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div>
                <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
                <input type="email" id="email" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div>
                <label for="phone" class="block mb-1 text-sm font-medium text-gray-900">Phone</label>
                <input type="tel" id="phone" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>

            <div class="md:col-span-2 mt-3 flex flex-wrap gap-2">
                <input type="file" wire:model="newPhoto" id="photoUpload" class="hidden">
                <button type="button" onclick="document.getElementById('photoUpload').click()" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Change Profile
                </button>
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
        @for($i = 0; $i < 6; $i++)
            <div>
                <label for="input-{{ $i }}" class="block mb-1 text-sm font-medium text-gray-900">Input {{ $i + 1 }}</label>
                <input id="input-{{ $i }}" type="text" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
            </div>
        @endfor
        <div class="md:col-span-2 mt-3">
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Save Changes
            </button>
        </div>
    </form>

    {{-- CHANGE PASSWORD --}}
    <div class="border-t border-gray-300/50 my-6"></div>
    <h2 class="text-lg font-semibold mb-2">Change Password</h2>
    <form class="grid grid-cols-1 gap-4">
        <div>
            <label for="current-password" class="block mb-1 text-sm font-medium text-gray-900">Current Password</label>
            <input type="password" id="current-password" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
        </div>
        <div>
            <label for="new-password" class="block mb-1 text-sm font-medium text-gray-900">New Password</label>
            <input type="password" id="new-password" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
        </div>
        <div>
            <label for="confirm-password" class="block mb-1 text-sm font-medium text-gray-900">Confirm Password</label>
            <input type="password" id="confirm-password" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
        </div>
        <div class="mt-3">
            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Save Changes
            </button>
        </div>
    </form>
</div>
