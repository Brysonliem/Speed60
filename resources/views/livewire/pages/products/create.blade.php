<div class="flex flex-col gap-3 h-screen p-4 md:p-8 overflow-auto">
    <!-- Breadcrumb (omitted) -->

    <div class="bg-white w-full p-4 border rounded-lg my-4 hover:shadow-lg transition-shadow duration-300">
        <h2 class="text-xl font-semibold text-gray-800">Create Product</h2>
        <p class="text-sm text-gray-500 mt-1">Fill the forms below.</p>

        <form wire:submit.prevent="store" class="mt-4">
            @csrf

            <div class="grid grid-cols-4 gap-4">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Product Name</label>
                    <input
                        wire:model="form.name"
                        id="name"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required
                    />
                    @error('form.name') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-2">
                    <label for="product_type_id" class="block mb-2 text-sm font-medium text-gray-900">Pilih Tipe Produk</label>
                    <select
                        wire:model="form.product_type_id"
                        id="product_type_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    >
                        <option value="" disabled selected>-- Pilih Tipe Produk --</option>
                        @foreach ($product_types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('form.product_type_id') 
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-4">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Product Description</label>
                    <textarea
                        id="description"
                        rows="4"
                        wire:model="form.description"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg
                               border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter product description…"
                    ></textarea>
                    @error('form.description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-4 mt-4">
                    <h3 class="text-lg font-medium text-gray-700">Variants</h3>
                    <p class="text-sm text-gray-500 mb-2">Add one or more variants below.</p>
                </div>

                @foreach ($variantForms as $i => $variant)
                    <div class="col-span-4 border border-gray-200 rounded-lg p-4 mb-4 bg-gray-50">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-semibold text-gray-800">Variant #{{ $i + 1 }}</h4>
                            <button
                                type="button"
                                wire:click.prevent="removeVariant({{ $i }})"
                                class="text-red-600 hover:underline text-sm"
                            >
                                Remove
                            </button>
                        </div>

                        <div class="grid grid-cols-6 gap-4">
                            <!-- Color -->
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Color</label>
                                <input
                                    wire:model="variantForms.{{ $i }}.color"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="E.g. Red"
                                    required
                                />
                                @error("variantForms.$i.color")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Color Code -->
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Color Code</label>
                                <input
                                    wire:model="variantForms.{{ $i }}.color_code"
                                     type="color"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="#FF0000"
                                    required
                                />
                                @error("variantForms.$i.color_code")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Current Stock for Variant -->
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                                <input
                                    wire:model="variantForms.{{ $i }}.current_stock"
                                    type="number"
                                    min="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required
                                />
                                @error("variantForms.$i.current_stock")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Price for Variant -->
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Price</label>
                                <input
                                    wire:model="variantForms.{{ $i }}.price"
                                    type="number"
                                    step="0.01"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required
                                />
                                @error("variantForms.$i.price")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Purchase Unit -->
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Purchase Unit</label>
                                <select
                                    wire:model="variantForms.{{ $i }}.purchase_unit"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required
                                >
                                    <option value="" disabled selected>-- Select Unit --</option>
                                    <option value="set">set</option>
                                    <option value="pcs">pcs</option>
                                </select>
                                @error("variantForms.$i.purchase_unit")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Units Per Set (optional) -->
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Unit Per Set (if any)</label>
                                <input
                                    wire:model="variantForms.{{ $i }}.unit_per_set"
                                    type="number"
                                    step="0.01"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                           focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="e.g. 10"
                                />
                                @error("variantForms.$i.unit_per_set")
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- “Add Variant” button spans all columns -->
                <div class="col-span-4">
                    <button
                        type="button"
                        wire:click.prevent="addVariant"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                    >
                        + Add Another Variant
                    </button>
                </div>

                <div class="col-span-2">
                    <label for="multiple_files" class="block mb-2 text-sm font-medium text-gray-900">Upload Picture Product</label>
                    <input
                        wire:model="images"
                        id="multiple_files"
                        type="file"
                        multiple
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg
                               cursor-pointer bg-gray-50 focus:outline-none"
                    >
                    @error('images.*')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-span-2">
                    {{-- You could also move “description” here if you prefer --}}
                </div>

                <div class="col-span-4 flex flex-wrap mt-2">
                    @if (!empty($imagePreviews))
                        @foreach ($imagePreviews as $image)
                            <img
                                src="{{ $image }}"
                                alt="Preview"
                                class="w-24 h-24 object-cover rounded-lg me-2 mb-2"
                            />
                        @endforeach
                    @endif
                </div>

                <div class="col-span-4 flex">
                    <div class="ms-auto">
                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="store"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                                   focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600
                                   dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center"
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
                                    d="M100 50.5908C100 78.2051 77.6142 100.591
                                       C50 100.591C22.3858 100.591 0 78.2051 0 50.5908
                                       C0 22.9766 22.3858 0.59082 50 0.59082
                                       C77.6142 0.59082 100 22.9766 100 50.5908
                                       Z"
                                    fill="#E5E7EB"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624
                                       35.9116 97.0079 33.5539C95.2932 28.8227
                                       92.871 24.3692 89.8167 20.348C85.8452
                                       15.1192 80.8826 10.7238 75.2124 7.41289
                                       C69.5422 4.10194 63.2754 1.94025 56.7698
                                       1.05124C51.7666 0.367541 46.6976 0.446843
                                       41.7345 1.27873C39.2613 1.69328 37.813
                                       4.19778 38.4501 6.62326C39.0873 9.04874
                                       41.5694 10.4717 44.0505 10.1071C47.8511
                                       9.54855 51.7191 9.52689 55.5402 10.0491
                                       C60.8642 10.7766 65.9928 12.5457 70.6331
                                       15.2552C75.2735 17.9648 79.3347 21.5619
                                       82.5849 25.841C84.9175 28.9121 86.7997
                                       32.2913 88.1811 35.8758C89.083 38.2158
                                       91.5421 39.6781 93.9676 39.0409Z"
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

    @if (Session::has('error'))
        <div x-data="{show: true}" x-show="show" id="toast-error" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm " role="alert">
            <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg ">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ms-3 text-sm font-normal">{{ Session::get('error') }}</div>
            <button x-on:click="show = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-error" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    @endif
</div>
