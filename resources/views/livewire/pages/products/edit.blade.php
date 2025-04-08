<div class="flex flex-col gap-3 h-screen">
    <!-- Breadcrumb -->
    {{-- @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Product', 'url' => route('products.index.admin')],
        ['name' => 'Update Product', 'url' => route('products.edit', $form->product->id)],
    ]]) --}}

    <div class="bg-white w-full p-4 border rounded-lg my-4 hover:shadow-lg transition-shadow duration-300">
        <h2 class="text-xl font-semibold text-gray-800">Update Product</h2>
        <p class="text-sm text-gray-500 mt-1">Fill the forms below.</p>

        <form wire:submit.prevent="update" class="mt-4">
            <div class="grid grid-cols-4 gap-4">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                    <input wire:model="form.name" id="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    {{-- @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
                </div>

                <div>
                    <label for="product_type_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih Tipe Produk</label>
                    <select wire:model.defer="form.product_type_id" id="product_type_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">-- Pilih Tipe Produk --</option>
                        @foreach ($product_types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    {{-- @error('product_type_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
                </div>                

                <div>
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                    <input wire:model="form.price" id="price" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    {{-- @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
                </div>

                <div>
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                    <input wire:model="form.current_stock" id="stock" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
                    {{-- @error('current_stock') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
                </div>

                <div class="col-span-2">                    
                    <label class="block mb-2 text-sm font-medium text-gray-900 " for="multiple_files">Upload Picture Product</label>
                    <input wire:model="newImages" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 
                    focus:outline-none " id="multiple_files" type="file" multiple>
                    {{-- @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
                </div>
                
                <div class="col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Product Description</label>
                    <textarea id="message" rows="4" wire:model="form.description" class="
                        block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 
                        focus:ring-blue-500 focus:border-blue-500 " placeholder=""></textarea>
                    {{-- @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
                </div>
        
                <!-- Preview gambar lama -->
                <div class="col-span-4 flex gap-3 flex-wrap">
                    @foreach ($form->product->images as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-24 h-24 object-cover rounded-lg">
                            {{-- Tombol hapus (optional) --}}
                            <button wire:click.prevent="deleteImage({{ $image->id }})" class="absolute top-0 right-0 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center">×</button>
                        </div>
                    @endforeach
                </div>
        
                <!-- Preview upload baru -->
                <div class="col-span-4 flex gap-3 flex-wrap">
                    @if (!empty($previewNewImages))
                        @foreach ($previewNewImages as $image)
                            <img src="{{ $image }}" class="w-24 h-24 object-cover rounded-lg">
                        @endforeach
                    @endif
                </div>
        
                <!-- Tombol Submit -->
                <div class="col-span-4 flex">
                    <div class="ms-auto">
                        {{-- <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Submit</button> --}}
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="update"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center"
                        >
                            <svg
                                wire:loading
                                wire:target="update"
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
                            <span wire:loading.remove wire:target="update">Simpan</span>
                            <span wire:loading wire:target="update">Memperbarui...</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>