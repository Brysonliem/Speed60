{{-- detail product checked out --}}
<div class="flex gap-3 items-center">
    <img class="h-auto w-16" src="{{ asset($productImage) }}" alt="image description">
    <div class="flex flex-col gap-2">
        <span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 100%;">{{ $productName }}</span>
        <span>{{ $quantity }} x <span class="text-blue-500 font-medium">Rp {{ $productPrice }}</span></span>
    </div>
</div>