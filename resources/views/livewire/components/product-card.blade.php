<div style="display:contents;">
    <div
        class="h-full duration-100 ease-sharp-motion-curve hover:shadow-hover active:shadow-active hover:-translate-y-[1px] active:translate-y-0 relative hover:z-[1] box-content group border border-solid hover:border-shopee-primary border border-solid border-shopee-black9">
        <a href="{{ !empty($product['id']) ? route('products.detail', ['product' => $product['id']]) : '#' }}"
            class="contents" style="display: contents;">
            <div class="flex flex-col bg-white cursor-pointer h-full">
                <div class="relative z-0 w-full pt-full">
                    @if (!empty($image))
                        {{-- <img src="{{ asset('storage/' . $image) }}" alt="Product Image" class="pl-2 rounded-t-lg" />
                        --}}
                        <img src="{{ $image }}" alt="{{ $title }}"
                            class="inset-y-0 w-full h-full pointer-events-none object-contain absolute" />
                    @else
                        <span class="text-gray-400">No image</span>
                    @endif

                    @if(!empty($discount_percentage))
                        <div
                            class="text-red-500 font-medium bg-red-100 py-0.5 px-1 text-xs/sp14 absolute top-0 right-0 z-30">
                            {{ $discount_percentage }}%
                        </div>
                    @endif
                </div>
                <div class="p-2 flex-1 flex flex-col justify-between">
                    <div class="space-y-1 mb-1 flex-1 flex flex-col justify-between min-h-[4rem]">
                        <div class="line-clamp-2 break-words min-w-0 min-h-[2.5rem] text-md">
                            {{ $title }}
                        </div>
                        <div class="flex items-center">
                            <div
                                class="flex-shrink min-w-0 mr-1 truncate text-shopee-primary flex items-center font-medium">
                                <div class="truncate flex items-baseline">
                                    <span class="text-xs/sp14 font-medium mr-px">Rp</span>
                                    <span class="font-medium text-base/5 truncate">{{ $price }}</span>
                                    <span class="text-xs/sp14 font-medium mr-px"></span>
                                </div>
                            </div>
                            <div
                                class="text-red-500 font-medium bg-red-100 py-0.5 px-1 text-sp10/3 h-4 rounded-[2px] shrink-0 mr-1">
                                -41%
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col justify-between">
                        <div></div>
                        <div class="mb-2 flex items-center space-x-1">
                            <div class="flex-none flex items-center space-x-0.5 h-sp14">
                                <img src="https://deo.shopeemobile.com/shopee/modules-federation/live/0/shopee__item-card-standard-v2/0.1.53/pc/d7099d3fd1dfdaf705ab.svg"
                                    alt="rating-star-full" style="height: 0.625rem; width: 0.625rem;" />
                                <div class="text-shopee-black87 text-xs/sp14 flex-none">{{ $rating }}</div>
                            </div>
                            <div class="ml-1 h-sp10 scale-x-50 border-l border-shopee-black9"></div>
                            <div class="truncate text-shopee-black87 text-xs min-h-4">
                                {{ $reviews }} reviews
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>