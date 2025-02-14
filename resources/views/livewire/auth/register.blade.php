<form wire:submit="register" class="mt-8 space-y-6">
   <div>
       <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
       <input wire:model="name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
       @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
   </div>

   <div>
       <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
       <input wire:model="username" type="text" id="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
       @error('username') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
   </div>

   <div>
       <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
       <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
       @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
   </div>

   <div>
       <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
       <input wire:model="password" type="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
       @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
   </div>

   <div>
       <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
       <input wire:model="password_confirmation" type="password" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
       @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
   </div>

   <div>
       <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
       <input wire:model="phone" type="text" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
       @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
   </div>

   <div>
       <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
       <textarea wire:model="address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
       @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
   </div>

   <div class="grid grid-cols-2 gap-4">
       <div>
           <label for="province" class="block text-sm font-medium text-gray-700">Provinsi</label>
           <input wire:model="province" type="text" id="province" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
           @error('province') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
       </div>

       <div>
           <label for="city" class="block text-sm font-medium text-gray-700">Kota/Kabupaten</label>
           <input wire:model="city" type="text" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
           @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
       </div>
   </div>

   <div class="grid grid-cols-2 gap-4">
       <div>
           <label for="district" class="block text-sm font-medium text-gray-700">Kecamatan</label>
           <input wire:model="district" type="text" id="district" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
           @error('district') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
       </div>

       <div>
           <label for="block" class="block text-sm font-medium text-gray-700">Blok (Opsional)</label>
           <input wire:model="block" type="text" id="block" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
       </div>
   </div>

   <div class="grid grid-cols-2 gap-4">
       <div>
           <label for="rt" class="block text-sm font-medium text-gray-700">RT</label>
           <input wire:model="rt" type="text" id="rt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
           @error('rt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
       </div>

       <div>
           <label for="rw" class="block text-sm font-medium text-gray-700">RW</label>
           <input wire:model="rw" type="text" id="rw" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
           @error('rw') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
       </div>
   </div>

   <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
       Daftar
   </button>
</form>