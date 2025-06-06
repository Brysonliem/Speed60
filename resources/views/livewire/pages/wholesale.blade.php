<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold mb-4 text-gray-800">WHOLESALE</h1>
    <p class="text-lg text-gray-700 leading-relaxed mb-10">
        Interested in becoming our reseller / wholesaler? Send us your info below.
    </p>

    {{-- Card --}}
    <div class="border border-gray-300 rounded-lg overflow-hidden flex flex-col md:flex-row">
        {{-- Kiri: Teks --}}
        <div class="w-full md:w-1/2 p-6 flex items-center justify-center">
            <p class="text-gray-700 text-base md:text-lg text-center">
                Share information about your brand with your customers. Describe a product, make announcements, or welcome customers to your store.
            </p>
        </div>

        {{-- Kanan: Form --}}
        <div class="w-full md:w-1/2 p-6">
            <form wire:submit.prevent="submit" class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" id="name" wire:model.defer="name"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" wire:model.defer="email"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" id="phone" wire:model.defer="phone"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Comment</label>
                    <textarea id="comment" wire:model.defer="comment" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Write your message here..."></textarea>
                    @error('comment') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <div>
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                        SEND
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
