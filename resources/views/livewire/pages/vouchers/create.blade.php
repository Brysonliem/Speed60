@php
    use Carbon\Carbon;
@endphp

<div class="flex flex-col gap-3 h-screen p-4 md:p-8">
    <!-- Breadcrumb -->
    {{-- @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Voucher', 'url' => route('vouchers.index')],
        ['name' => 'Create Voucher', 'url' => route('vouchers.create')],
    ]]) --}}

    <div class="bg-white w-full p-4 border rounded-lg my-4 hover:shadow-lg transition-shadow duration-300">
        <h2 class="text-xl font-semibold text-gray-800">Create Voucher</h2>
        <p class="text-sm text-gray-500 mt-1">Fill the forms below.</p>

        <form wire:submit.prevent="store" class="mt-4">
            @csrf
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label for="code" class="block mb-2 text-sm font-medium text-gray-900">Voucher Code</label>
                    <input wire:model="form.code" id="code" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    @error('form.code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Voucher Name</label>
                    <input wire:model="form.name" id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    @error('form.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>       

                <div>
                    <label for="minimum_transaction" class="block mb-2 text-sm font-medium text-gray-900">Minimum Transaction</label>
                    <input wire:model="form.minimum_transaction" id="minimum_transaction" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    @error('form.minimum_transaction') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="discount_percentage" class="block mb-2 text-sm font-medium text-gray-900">Discount Percentage</label>
                    <input wire:model="form.discount_percentage" id="discount_percentage" step="0.1" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    @error('form.discount_percentage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Start Date</label>
                    <input wire:model="form.start_date" id="start_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    @error('form.start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">End Date</label>
                    <input wire:model="form.end_date" id="end_date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    @error('form.end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="disable" class="block mb-2 text-sm font-medium text-gray-900">Disable</label>
                    <input wire:model="form.is_disabled" id="disable" type="checkbox" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" />
                    @error('form.is_disabled') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Voucher Description</label>
                    <textarea id="description" rows="4" wire:model="form.description" class="
                        block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 
                        focus:ring-blue-500 focus:border-blue-500 " placeholder=""></textarea>
                    @error('form.description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="col-span-4 flex">
                    <div class="ms-auto">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="store"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center"
                        >
                            <svg
                                wire:loading
                                wire:target="store"
                                aria-hidden="true"
                                role="status"
                                class="inline w-4 h-4 me-3 text-white animate-spin"
                                viewBox="0 0 100 101"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="#E5E7EB"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentColor"
                                />
                            </svg>
                            <span wire:loading.remove wire:target="store">Simpan</span>
                            <span wire:loading wire:target="store">Menyimpan...</span>
                        </button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>