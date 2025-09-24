<div x-show="activeTab === 'my-account'" class="p-4 rounded-lg bg-gray-50 shadow-md" id="my-account" role="tabpanel" aria-labelledby="my-account-tab">
  <div class="flex flex-col md:flex-row gap-5">
    {{-- FORM PROFILE --}}
    <form wire:submit.prevent="saveProfile" class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
      <div>
        <label for="display-name" class="block mb-1 text-sm font-medium text-gray-900">Display Name</label>
        <input wire:model.defer="user.name" type="text" id="display-name" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
        @error('user.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label for="username" class="block mb-1 text-sm font-medium text-gray-900">Username</label>
        <input wire:model.defer="user.username" type="text" id="username" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
        @error('user.username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
        <input wire:model.defer="user.email" type="email" id="email" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
        @error('user.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div>
        <label for="phone" class="block mb-1 text-sm font-medium text-gray-900">Phone</label>
        <input wire:model.defer="user.phone_number" type="tel" id="phone" class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" />
        @error('user.phone_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
      </div>

      <div class="md:col-span-2 mt-3">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
          Save Changes
        </button>
      </div>
    </form>
  </div>

  {{-- FLASH --}}
  @if (session()->has('success'))
    <div class="mt-4 p-2 bg-green-100 text-green-700 rounded text-sm">
      {{ session('success') }}
    </div>
  @endif

  {{-- DESTINATION ADDRESS (Address Book) --}}
  <div class="border-t border-gray-300/50 my-6"></div>
  <h2 class="text-lg font-semibold mb-2">Destination Address</h2>

  {{-- Grid alamat tersimpan (single-select) --}}
  <div x-data="{ selectedId: @entangle('selected_address_id') }" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" role="radiogroup" aria-label="Pilihan Alamat">
      @forelse ($addresses as $addr)
        <label
          class="group relative block h-full cursor-pointer rounded-lg border p-4 shadow-sm transition hover:shadow-md {{ ($selected_address_id == $addr['id']) ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-200' }}"
          role="radio"
          :aria-checked="(selectedId == {{ $addr['id'] }}).toString()"
          tabindex="0"
          @click="$wire.selectAddress({{ $addr['id'] }}); selectedId = {{ $addr['id'] }}"
          @keydown.enter.prevent="$wire.selectAddress({{ $addr['id'] }}); selectedId = {{ $addr['id'] }}"
          @keydown.space.prevent="$wire.selectAddress({{ $addr['id'] }}); selectedId = {{ $addr['id'] }}"
        >
          {{-- Radio visual --}}
          <div class="absolute top-3 right-3">
            <div class="h-5 w-5 rounded-full border flex items-center justify-center {{ ($selected_address_id == $addr['id']) ? 'bg-blue-600 border-blue-600' : 'bg-white border-gray-300' }}">
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
            @if(!empty($addr['additional_address']))
              <div class="text-gray-600">{{ $addr['additional_address'] }}</div>
            @endif
            <div class="text-gray-600">{{ $addr['city'] }}, {{ $addr['province'] }} {{ $addr['postal_code'] }}</div>
          </div>

          {{-- Aksi --}}
          <div class="mt-3 flex items-center gap-3 text-xs text-blue-600 opacity-0 group-hover:opacity-100 transition">
            <button type="button" wire:click="editAddress({{ $addr['id'] }})" class="hover:underline">Ubah</button>
            <span class="text-gray-300">•</span>
            <button type="button" wire:click="deleteAddress({{ $addr['id'] }})" class="hover:underline">Hapus</button>
            <span class="text-gray-300">•</span>
            @if (!$addr['is_main'])
              <button type="button" wire:click="setMain({{ $addr['id'] }})" class="hover:underline">Jadikan Utama</button>
            @endif
          </div>
        </label>
      @empty
        <div class="col-span-full text-sm text-gray-600">
          Belum ada alamat. Tambahkan alamat baru di bawah.
        </div>
      @endforelse
    </div>

    {{-- Toggle form tambah/edit alamat --}}
    <div class="flex items-center justify-between">
      <button type="button" wire:click="showCreateAddress" class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-4 py-2 text-sm hover:bg-gray-50">
        + Tambah alamat baru
      </button>
      @if($selected_address_id)
        <span class="text-xs text-gray-500">Alamat terpilih ID: {{ $selected_address_id }}</span>
      @endif
    </div>

    {{-- FORM alamat baru / edit --}}
    @if ($show_address_form)
    <div class="block w-full p-6 bg-white border border-dashed border-gray-300 rounded-lg shadow-sm">
      <div class="flex items-center justify-between mb-4">
        <span class="text-lg font-medium">{{ $is_editing_address ? 'Ubah Alamat' : 'Tambah Alamat Baru' }}</span>
        <button type="button" wire:click="cancelAddressForm" class="text-sm text-gray-500 hover:underline">Tutup</button>
      </div>

      <form wire:submit.prevent="saveAddress" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <div class="sm:col-span-2">
          <label class="block mb-2 text-sm font-medium text-gray-900">Label (Rumah/Kantor)</label>
          <input wire:model.defer="address_form.title_address" type="text" class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Rumah / Kantor" />
          @error('address_form.title_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="sm:col-span-2">
          <label class="block mb-2 text-sm font-medium text-gray-900">Nama Penerima</label>
          <input wire:model.defer="address_form.recipients_name" type="text" class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
          @error('address_form.recipients_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="sm:col-span-2">
          <label class="block mb-2 text-sm font-medium text-gray-900">Nomor Telepon</label>
          <input wire:model.defer="address_form.recipients_phone" type="tel" class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
          @error('address_form.recipients_phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-full">
          <label class="block mb-2 text-sm font-medium text-gray-900">Alamat Lengkap</label>
          <textarea wire:model.defer="address_form.address" rows="3" class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Nama jalan, nomor, RT/RW, patokan" required></textarea>
          @error('address_form.address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-full">
          <label class="block mb-2 text-sm font-medium text-gray-900">Alamat Tambahan (opsional)</label>
          <input wire:model.defer="address_form.additional_address" type="text" class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" />
          @error('address_form.additional_address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Provinsi --}}
        <div class="sm:col-span-2">
          <label class="block mb-2 text-sm font-medium text-gray-900">Provinsi</label>
          <select
            class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
            wire:change="onProvinceChanged($event.target.value)"
          >
            <option value="">Pilih provinsi...</option>
            @foreach($provinceOptions as $opt)
              <option value="{{ $opt['id'] }}">{{ $opt['name'] }}</option>
            @endforeach
          </select>
          @error('address_form.province') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Kota/Kab --}}
        <div class="sm:col-span-2">
          <label class="block mb-2 text-sm font-medium text-gray-900">Kota / Kabupaten</label>
          <select
            class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
            wire:change="onCityChanged($event.target.value)"
            @disabled(empty($tmpProvinceId))
          >
            <option value="">Pilih kota/kab...</option>
            @foreach($cityOptions as $opt)
              <option value="{{ $opt['id'] }}">{{ $opt['name'] }}</option>
            @endforeach
          </select>
          
          @error('address_form.city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- District/Daerah --}}
        <div class="sm:col-span-2">
          <label class="block mb-2 text-sm font-medium text-gray-900">District / Daerah</label>
          <select
            class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
            wire:change="onDistrictChanged($event.target.value)"
            @disabled(empty($tmpCityId))
          >
            <option value="">Pilih district...</option>
            @foreach($districtOptions as $opt)
              <option value="{{ $opt['id'] }}">{{ $opt['name'] }}</option>
            @endforeach
          </select>
          
          @error('address_form.district') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Subdistrict/Kecamatan --}}
        <div class="sm:col-span-2">
          <label class="block mb-2 text-sm font-medium text-gray-900">Subdistrict / Kecamatan</label>
          <select
            class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500"
            wire:change="onSubdistrictChanged($event.target.value)"
            @disabled(empty($tmpDistrictId))
          >
            <option value="">Pilih subdistrict...</option>
            @foreach($subdistrictOptions as $opt)
              <option value="{{ $opt['id'] }}">{{ $opt['name'] }}</option>
            @endforeach
          </select>
          
          @error('address_form.subdistrict') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
          @error('address_form.postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>


        <div class="sm:col-span-2">
          <label class="block mb-2 text-sm font-medium text-gray-900">Kode Pos</label>
          <input wire:model.defer="address_form.postal_code" type="text" class="w-full p-2.5 text-sm bg-gray-50 border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" required />
          @error('address_form.postal_code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="col-span-full">
          <label class="inline-flex items-center gap-2">
            <input type="checkbox" wire:model.defer="address_form.is_main" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 focus:ring-2">
            <span class="text-sm text-gray-700">Jadikan sebagai alamat utama</span>
          </label>
        </div>

        <div class="col-span-full flex items-center gap-3">
          <button type="submit" class="px-5 py-2.5 text-sm font-medium rounded-lg text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
            Simpan Alamat
          </button>
          <button type="button" wire:click="cancelAddressForm" class="px-5 py-2.5 text-sm font-medium rounded-lg border border-gray-200 hover:bg-gray-50">
            Batal
          </button>
        </div>
      </form>
    </div>
    @endif

    {{-- Ringkasan address terpilih --}}
    <div class="rounded-lg border border-gray-200 p-4">
      <div class="text-sm text-gray-600">
        <span class="font-medium text-gray-900">Ringkasan Alamat Terpilih:</span>
        @php
          $sel = collect($addresses)->firstWhere('id', $selected_address_id);
        @endphp
        @if (!$sel)
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

  {{-- CHANGE PASSWORD --}}
  <div class="border-t border-gray-300/50 my-6"></div>
  <h2 class="text-lg font-semibold mb-2">Change Password</h2>

  <form wire:submit.prevent="changePassword" class="grid grid-cols-1 gap-4">
    @if (session()->has('success'))
      <div class="p-2 bg-green-100 text-green-700 rounded text-sm">
        {{ session('success') }}
      </div>
    @endif

    <div>
      <label for="current-password" class="block mb-1 text-sm font-medium text-gray-900">Current Password</label>
      <input wire:model.defer="current_password" type="password" id="current-password"
             class="bg-white border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5" required />
      @error('current_password') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
    </div>

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
      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
        Save Changes
      </button>
    </div>
  </form>
</div>
