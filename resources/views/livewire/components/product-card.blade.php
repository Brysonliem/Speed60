<div style="display:contents;">
    <div class="h-full duration-100 ease-sharp-motion-curve hover:shadow-hover active:shadow-active 
        hover:-translate-y-[1px] active:translate-y-0 relative hover:z-[1] box-content group border border-solid 
        hover:border-shopee-primary border-shopee-black9">
        <a href="{{ !empty($product['id']) ? route('products.detail', ['product' => $product['id']]) : '#' }}"
            class="contents" style="display: contents;">

            {{-- canvas --}}
            <div class="flex flex-col bg-white cursor-pointer h-full">

                {{-- image --}}
                <div class="relative z-0 w-full pt-full">
                    @if (!empty($image))
                        <img src="{{ $image }}" alt="{{ $title }}"
                            class="inset-y-0 w-full h-full pointer-events-none object-contain absolute" />
                    @else
                        <span class="text-gray-400">No image</span>
                    @endif
                </div>

                {{-- title, price, rating --}}
                <div class="flex-1 flex flex-col justify-between">
                    <div class="flex-1 flex flex-col justify-between min-h-[4rem]">
                        <div class="line-clamp-2 break-words min-w-0 min-h-[2.5rem] text-md p-2">
                            {{ $title }}
                        </div>
                        <div class="flex-1 flex flex-col justify-between px-2">
                            <div class="mb-2 flex items-center space-x-1">
                                <svg class="w-4 h-4 text-yellow-400 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                </svg>
                                <p class="ms-2 text-sm font-medium text-gray-900">{{ $rating }}</p>
                                <span class="w-1 h-1 mx-1.5 bg-gray-500 rounded-full"></span>
                                <a href="#" class="text-sm font-medium text-gray-900 underline hover:no-underline">{{ $reviews }} reviews</a>
                            </div>

                            {{-- <div class="mb-2 flex items-center space-x-1">
                                <div class="flex-none flex items-center space-x-0.5 h-sp14">
                                    <img src="https://deo.shopeemobile.com/shopee/modules-federation/live/0/shopee__item-card-standard-v2/0.1.53/pc/d7099d3fd1dfdaf705ab.svg"
                                        alt="rating-star-full" style="height: 0.625rem; width: 0.625rem;" />
                                    <div class="text-shopee-black87 text-xs/sp14 flex-none">{{ $rating }}</div>
                                </div>
                                <div class="ml-1 h-sp10 scale-x-50 border-l border-shopee-black9"></div>
                                <div class="truncate text-shopee-black87 text-xs min-h-4">
                                    {{ $reviews }} reviews
                                </div>
                            </div> --}}
                        </div>
                        <div class="flex items-center" >
                            <!-- Bagian harga -->
                            <div class="flex-shrink min-w-0 mr-1 truncate text-shopee-primary flex items-center font-medium px-2">
                                <div class="truncate flex items-baseline">
                                    <span class="text-lg/sp14 font-medium mr-px">Rp. </span>
                                    <span class="font-medium text-base/5 truncate">{{ $price }}</span>
                                </div>
                            </div>

                            <!-- Tombol ADD TO CART -->
                            <button 
                                x-on:click="$dispatch('open-modal', {
                                    title: @js($title),
                                    price: @js($price),
                                    image: @js($image),
                                    variants: @js($variants),
                                    productId: @js($product['id']),
                                    productDescription: @js($product['description'])
                                })" 
                                class="bg-red-500 text-white text-xs p-2 font-semibold rounded-none hover:bg-red-400 ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>