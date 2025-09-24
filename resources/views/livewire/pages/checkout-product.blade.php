<div class="flex flex-col gap-4 p-4 md:p-8">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="md:col-span-2">
            <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                <div
                x-data="{
                    selectedId: @entangle('selected_address_id'),
                    showNewForm: @entangle('show_book_form'),
                }"
                class="w-full max-w-5xl mx-auto space-y-6"
                >
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Alamat Pengiriman</h3>
                    <span class="text-sm text-gray-500">Pilih satu alamat</span>
                </div>

                <!-- Grid Alamat (single-select, dari Livewire) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" role="radiogroup" aria-label="Pilihan Alamat">
                    @forelse ($addresses as $addr)
                    <label
                        class="group relative block h-full cursor-pointer rounded-lg border p-4 shadow-sm transition hover:shadow-md
                            {{ ($selected_address_id == $addr['id']) ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-200' }}"
                        role="radio"
                        tabindex="0"
                        @click="$wire.selectAddress({{ $addr['id'] }}); selectedId = {{ $addr['id'] }}"
                        @keydown.enter.prevent="$wire.selectAddress({{ $addr['id'] }}); selectedId = {{ $addr['id'] }}"
                        @keydown.space.prevent="$wire.selectAddress({{ $addr['id'] }}); selectedId = {{ $addr['id'] }}"
                    >
                        <!-- Radio visual -->
                        <div class="absolute top-3 right-3">
                        <div class="h-5 w-5 rounded-full border flex items-center justify-center
                                    {{ ($selected_address_id == $addr['id']) ? 'bg-blue-600 border-blue-600' : 'bg-white border-gray-300' }}">
                            @if ($selected_address_id == $addr['id'])
                            <div class="h-2.5 w-2.5 rounded-full bg-white"></div>
                            @endif
                        </div>
                        </div>

                        <div class="flex items-center gap-2 mb-2">
                        <span class="text-sm font-medium text-gray-900">{{ $addr['title_address'] ?: 'Alamat' }}</span>
                        @if ($addr['is_main'])
                            <span class="text-[11px] px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">Utama</span>
                        @endif
                        </div>

                        <div class="space-y-1 text-sm">
                        <div class="font-medium text-gray-900">{{ $addr['recipients_name'] }}</div>
                        <div class="text-gray-700">{{ $addr['recipients_phone'] }}</div>
                        <div class="text-gray-600">{{ $addr['address'] }}</div>
                        @if (!empty($addr['additional_address']))
                            <div class="text-gray-600">{{ $addr['additional_address'] }}</div>
                        @endif
                        <div class="text-gray-600">{{ $addr['city'] }}, {{ $addr['province'] }} {{ $addr['postal_code'] }}</div>
                        </div>

                        <!-- Aksi kecil -->
                        <div class="mt-3 flex items-center gap-3 text-xs text-blue-600 opacity-0 group-hover:opacity-100 transition">
                        <button type="button" class="hover:underline" wire:click.stop="editBookAddress({{ $addr['id'] }})">Ubah</button>
                        <span class="text-gray-300">•</span>
                        <button type="button" class="hover:underline" wire:click.stop="deleteBookAddress({{ $addr['id'] }})">Hapus</button>
                        @if (! $addr['is_main'])
                            <span class="text-gray-300">•</span>
                            <button type="button" class="hover:underline" wire:click.stop="setMainBookAddress({{ $addr['id'] }})">Jadikan Utama</button>
                        @endif
                        </div>
                    </label>
                    @empty
                    <div class="col-span-full text-sm text-gray-600">Belum ada alamat. Tambahkan alamat baru di bawah.</div>
                    @endforelse
                </div>

                <!-- CTA bawah grid -->
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <button type="button"
                            @click="$wire.showCreateAddress(); showNewForm = true"
                            class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-4 py-2 text-sm hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/></svg>
                    Tambah alamat baru
                    </button>

                    <div class="text-sm text-gray-500" x-show="selectedId">
                    Terpilih: <strong>#<span x-text="selectedId"></span></strong>
                    </div>
                </div>

                <!-- FORM Alamat Buku (Livewire) -->
                @if ($show_book_form)
                    <div class="block w-full p-6 bg-white border border-dashed border-gray-300 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-medium">{{ $is_editing_book ? 'Ubah Alamat' : 'Tambah Alamat Baru' }}</span>
                        <button type="button" wire:click="cancelBookForm" class="text-sm text-gray-500 hover:underline">Tutup</button>
                    </div>

                    <form wire:submit.prevent="saveBookAddress" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Label (Rumah/Kantor)</label>
                            <input wire:model.defer="book_form.title_address" type="text"
                                class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Rumah / Kantor" />
                            @error('book_form.title_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Nama Penerima</label>
                            <input wire:model.defer="book_form.recipients_name" type="text"
                                class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                            @error('book_form.recipients_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
                            <input wire:model.defer="book_form.recipients_phone" type="tel"
                                class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
                            @error('book_form.recipients_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
                            <textarea wire:model.defer="book_form.address" rows="3"
                                    class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Nama jalan, nomor, RT/RW, patokan" required></textarea>
                            @error('book_form.address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Alamat Tambahan (opsional)</label>
                            <input wire:model.defer="book_form.additional_address" type="text"
                                class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" />
                            @error('book_form.additional_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- PROVINSI --}}
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Provinsi</label>
                            <select class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
                                    wire:change="onBookProvinceChanged($event.target.value)">
                            <option value="">Pilih provinsi...</option>
                            @foreach($provinceOptions as $opt)
                                <option value="{{ $opt['id'] }}">{{ $opt['name'] }}</option>
                            @endforeach
                            </select>
                            <input class="mt-2 w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm"
                                wire:model.defer="book_form.province" placeholder="Provinsi terpilih" readonly required>
                            @error('book_form.province') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- KOTA/KABUPATEN --}}
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Kota/Kabupaten</label>
                            <select class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
                                    wire:change="onBookCityChanged($event.target.value)"
                                    @disabled(empty($tmpProvinceId))>
                            <option value="">Pilih kota/kab...</option>
                            @foreach($cityOptions as $opt)
                                <option value="{{ $opt['id'] }}">{{ $opt['name'] }}</option>
                            @endforeach
                            </select>
                            <input class="mt-2 w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm"
                                wire:model.defer="book_form.city" placeholder="Kota/Kab terpilih" readonly required>
                            @error('book_form.city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- DISTRICT / DAERAH --}}
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">District / Daerah</label>
                            <select class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
                        wire:change="onBookDistrictChanged($event.target.value)"
                        @disabled(empty($tmpCityId))>
                            <option value="">Pilih district...</option>
                            @foreach($districtOptions as $opt)
                                <option value="{{ $opt['id'] }}">{{ $opt['name'] }}</option>
                            @endforeach
                            </select>
                            <input class="mt-2 w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm"
                                wire:model.defer="book_form.district" placeholder="District terpilih" readonly required>
                            @error('book_form.district') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- SUBDISTRICT / KECAMATAN + KODE POS --}}
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-900">Subdistrict / Kecamatan</label>
                            <select class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
                                    wire:change="onBookSubdistrictChanged($event.target.value)"
                                    @disabled(empty($tmpDistrictId))>
                            <option value="">Pilih subdistrict...</option>
                            @foreach($subdistrictOptions as $opt)
                                <option value="{{ $opt['id'] }}">{{ $opt['name'] }}</option>
                            @endforeach
                            </select>
                            <div class="mt-2 grid grid-cols-2 gap-2">
                            <input class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm"
                                    wire:model.defer="book_form.subdistrict" placeholder="Subdistrict terpilih" readonly required>
                            <input class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm"
                                    wire:model.defer="book_form.postal_code" placeholder="Kode pos (auto)" readonly required>
                            </div>
                            @error('book_form.subdistrict') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            @error('book_form.postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-span-full">
                            <label class="inline-flex items-center gap-2">
                            <input type="checkbox" wire:model.defer="book_form.is_main"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
                            <span class="text-sm text-gray-700">Jadikan sebagai alamat utama</span>
                            </label>
                        </div>

                        <div class="col-span-full flex items-center gap-3">
                            <button type="submit" class="px-5 py-2.5 text-sm font-medium rounded-lg text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Simpan Alamat
                            </button>
                            <button type="button" wire:click="cancelBookForm" class="px-5 py-2.5 text-sm font-medium rounded-lg border border-gray-200 hover:bg-gray-50">
                            Batal
                            </button>
                        </div>
                    </form>

                    </div>
                @endif

                <!-- Ringkasan alamat terpilih -->
                <div class="rounded-lg border border-gray-200 p-4">
                    <div class="text-sm text-gray-600">
                    <span class="font-medium text-gray-900">Ringkasan Alamat Terpilih:</span>
                    @php $sel = collect($addresses)->firstWhere('id', $selected_address_id); @endphp
                    @if (! $sel)
                        <div class="mt-1 text-gray-500">Belum ada alamat dipilih.</div>
                    @else
                        <div class="mt-2 space-y-0.5">
                        <div class="font-medium text-gray-900">{{ $sel['recipients_name'] }}</div>
                        <div class="text-gray-700">{{ $sel['recipients_phone'] }}</div>
                        <div class="text-gray-700">{{ $sel['address'] }}</div>
                        @if(!empty($sel['additional_address']))
                            <div class="text-gray-700">{{ $sel['additional_address'] }}</div>
                        @endif
                        <div class="text-gray-700">{{ $sel['city'] }}, {{ $sel['province'] }} {{ $sel['postal_code'] }}</div>
                        <div class="text-xs text-gray-500">
                            <span class="uppercase tracking-wide">{{ $sel['title_address'] }}</span>
                            @if ($sel['is_main'])
                            <span class="ml-1 px-1.5 py-0.5 rounded bg-amber-100 text-amber-800">Utama</span>
                            @endif
                        </div>
                        </div>
                    @endif
                    </div>
                </div>
                </div>



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
                        <span class="text-sm font-medium">@idr($shipping_price)</span>
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
