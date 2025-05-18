<div class="flex flex-col gap-4 h-screen">
    <!-- Breadcrumb -->
    @livewire('components.breadcrumb', ['links' => [
        ['name' => 'Cart', 'url' => route('carts.index')]
    ]])

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="md:col-span-2">
            <div class="block w-full  bg-white border border-gray-200 rounded-lg ">

                @if (Session::has('success'))
                    <div x-data="{show: true}" x-show="show" id="toast-success" class="fixed top-5 right-5 flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow-sm " role="alert">
                        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg ">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                            </svg>
                            <span class="sr-only">Check icon</span>
                        </div>
                        <div class="ms-3 text-sm font-normal">Berhasil menambahkan ke cart!</div>
                        <button x-on:click="show = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#toast-success" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif

                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-16 py-3">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Qty
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($products as $index => $product)
                                <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                    <td class="p-4">
                                        <img src="{{ asset('storage/'.$product->image_path) }}" class="w-12 md:w-32 max-w-full max-h-full" alt="images">
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <button class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200" type="button">
                                                <span class="sr-only">Quantity button</span>
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                </svg>
                                            </button>
                                            <div>
                                                <input wire:model="products.{{ $index }}.quantity" type="number" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1" placeholder="1" required />
                                            </div>
                                            <button class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200" type="button">
                                                <span class="sr-only">Quantity button</span>
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">
                                        @idr($product->price)
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="#" wire:click="deleteFromCart({{ $product->id }})" class="font-medium text-red-600 hover:underline">Remove</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
        <div class="md:col-span-1">
            <div class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="flex flex-col gap-3">
                    <span class="text-lg font-medium">Total</span>
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

                    <div class="w-full border-t border-gray-300 my-4"></div>
                    
                    <div class="flex justify-between">
                        <span class="text-lg font-medium text-gray-400">TOTAL</span>
                        <span class="text-lg font-medium">@idr($grand_total)</span>
                    </div>
                    <div class="flex">
                        <button wire:click="redirectToCheckout" @if ($products->count() <= 0) disabled @endif type="button" class="ms-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
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
