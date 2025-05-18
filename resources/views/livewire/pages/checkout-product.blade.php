<div class="flex flex-col gap-4">
    <!-- Breadcrumb -->
    @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Produk', 'url' => route('products.index')],
        ['name' => 'Checkout', 'url' => route('products.checkout')]
    ]])

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="md:col-span-2">
            <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                <span class="text-lg font-medium mb-5">Informasi Pembayaran</span>
                {{-- forms --}}
                <form wire:submit.prevent="" class="grid grid-cols-4 gap-4 mt-5">
                    <div class="col-span-1">
                        <label for="firstname" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Depan</label>
                        <input type="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div class="col-span-1">
                        <label for="lastname" class="block mb-2 text-sm font-medium text-gray-900 ">Nama Belakang</label>
                        <input type="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div class="col-span-2">
                        <label for="company" class="block mb-2 text-sm font-medium text-gray-900 ">Company Name</label>
                        <input type="company" id="company" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div class="col-span-4">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Alamat Lengkap (beserta patokan jika perlu)</label>
                        <input type="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div class="col-span-1">
                        <label for="province" class="block mb-2 text-sm font-medium text-gray-900 ">Provinsi</label>
                        <select id="proviences" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="JB">Jawa Barat</option>
                            <option value="JTE">Jawa Tengah</option>
                            <option value="JTM">Jawa Timur</option>
                            <option value="JTU">Jaws Utara</option>
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900 ">Kota</label>
                        <select id="cities" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="BKS">Bekasi</option>
                            <option value="JKT">Jakarta</option>
                            <option value="BGR">Bogor</option>
                            <option value="BDG">Bandung</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="zipcode" class="block mb-2 text-sm font-medium text-gray-900 ">Kode Pos</label>
                        <input type="zipcode" id="zipcode" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div class="col-span-2">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                        <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <div class="col-span-2">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Nomor Telepon</label>
                        <input type="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required />
                    </div>
                    <span class="mt-5 font-medium text-lg">Informasi Tambahan</span>
                    <div class="col-span-4">
                        <label for="additional-information" class="block mb-2 text-sm font-medium text-gray-900 ">Catatan Pemesanan (opsional)</label>
                        <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " ></textarea>                    
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
                    <div class="flex">
                        <button wire:click="redirectWhenSuccessCheckout" type="button" class="ms-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                            BUAT PESANAN
                            <svg class="rtl:rotate-180 w-4 h-full ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </button>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
