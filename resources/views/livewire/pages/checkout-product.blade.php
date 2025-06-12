<div class="flex flex-col gap-4 p-4 md:p-8">
    <!-- Breadcrumb -->
    {{-- @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Produk', 'url' => route('products.index')],
        ['name' => 'Checkout', 'url' => route('products.checkout')]
    ]]) --}}

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="md:col-span-2">
            <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                <span class="text-lg font-medium mb-5">Informasi Pembayaran</span>
                {{-- forms --}}
                <form wire:submit.prevent="" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-5">
                    <!-- Nama Depan -->
                    <div class="sm:col-span-2">
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900">Nama Depan</label>
                        <input wire:model="address_form.first_name" type="text" id="firstname" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>

                    <!-- Nama Belakang -->
                    <div class="sm:col-span-2">
                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900">Nama Belakang</label>
                        <input wire:model="address_form.last_name" type="text" id="lastname" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>

                    <!-- Nama Perusahaan -->
                    {{-- <div class="sm:col-span-2 md:col-span-2">
                        <label for="company" class="block mb-2 text-sm font-medium text-gray-900">Company Name</label>
                        <input wire:model="address_form.company_name" type="text" id="company" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div> --}}

                    <!-- Alamat -->
                    <div class="col-span-full">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
                        <textarea wire:model="address_form.address" id="message" rows="4" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <!-- Provinsi -->
                    <div class="sm:col-span-1">
                        <label for="province" class="block mb-2 text-sm font-medium text-gray-900">Provinsi</label>
                        <input wire:model="address_form.province" type="text" id="zipcode" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>

                    <!-- Kota -->
                    <div class="sm:col-span-1">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Kota</label>
                        <input wire:model="address_form.city" type="text" id="zipcode" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>

                    <!-- Kode Pos -->
                    <div class="sm:col-span-2">
                        <label for="zipcode" class="block mb-2 text-sm font-medium text-gray-900">Kode Pos</label>
                        <input wire:model="address_form.postal_code" type="text" id="zipcode" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>

                    <!-- Email -->
                    <div class="sm:col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input wire:model="address_form.email" type="email" id="email" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="sm:col-span-2">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                        <input wire:model="address_form.phone" type="tel" id="phone" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="col-span-full">
                        <span class="block mt-6 mb-2 font-medium text-lg text-gray-900">Informasi Tambahan</span>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Catatan Pemesanan (opsional)</label>
                        <textarea wire:model="address_form.description" id="message" rows="4" class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                </form>

            </div>
        </div>
        <div class="md:col-span-1">
            <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="flex flex-col gap-3">
                    <span class="text-lg font-medium">Detail Pesanan</span>
                    @foreach ($products as $product)
                        <div class="flex gap-3 items-center">
                            <img class="h-auto w-16" src="{{ asset('storage/' . $product->image_path) }}" alt="image description">
                            <div class="flex flex-col gap-2">
                                <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;">{{ $product->name }}</span>
                                <span>{{ $product->quantity }} x <span class="text-blue-500 font-medium">@idr($product->price)</span></span>
                            </div>
                        </div>
                    @endforeach
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-400">Sub-Total</span>
                        <span class="text-sm font-medium">@idr($sub_total)</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-400">Shipping</span>
                        <span class="text-sm font-medium">FREE</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-400">Tax</span>
                        <span class="text-sm font-medium">@idr($tax)</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm font-medium text-gray-400">Discount</span>
                        <span class="text-sm font-medium">@idr($discount ?? 0)</span>
                    </div>
                    <div class="flex justify-between">
                        <select wire:model.live="selectedVoucher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="" selected>Pilih Voucher</option>
                            @foreach ($vouchers as $voucher)
                                <option value="{{ $voucher['id'] }}">{{ $voucher['voucher_name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full border-t border-gray-300 my-4"></div>
                    
                    <div class="flex justify-between">
                        <span class="text-lg font-medium text-gray-400">TOTAL</span>
                        <span class="text-lg font-medium">@idr($grand_total)</span>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6" x-data="{ open: false }">
                        <button
                            type="button"
                            @click="open = true"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center"
                        >
                            BATALKAN PESANAN
                            <svg class="w-4 h-4 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2 2l10 10M2 12L12 2" />
                            </svg>
                        </button>

                        <button
                            type="button"
                            wire:click="redirectWhenSuccessCheckout"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center"
                        >
                            BUAT PESANAN
                            <svg class="rtl:rotate-180 w-4 h-4 ms-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>

                        <!-- Komponen Modal -->
                        <x-modal>
                            <x-slot:slot>
                                <h1>Batalkan transaksi ini?</h1>

                            </x-slot:slot>

                            <x-slot:footer>
                                <div class="ms-auto">

                                    <div class="flex gap-2">
                                        <button @click="open = false" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-3 rounded">
                                            Lanjutkan
                                        </button>
                                    
                                        <button @click="open = false" wire:click="cancelTransaction" class="bg-red-500 hover:bg-red-700 text-white px-4 py-3 rounded">
                                            Batalkan
                                        </button>
                                        
                                    </div>

                                </div>
                            </x-slot:footer>
                        </x-modal>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
        <div x-data="{show: true}" x-show="show" id="toast-success" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm " role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg ">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ Session::get('success') }}</div>
            <button x-on:click="show = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
</div>
