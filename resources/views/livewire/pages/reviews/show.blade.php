<div class="space-y-6 mt-20">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-xl font-semibold text-gray-900">Detail Review</h1>
            <p class="text-sm text-gray-500">
                ID: {{ $review->id }} • Dibuat: {{ optional($review->created_at)->format('d-m-Y H:i') }}
            </p>
        </div>
        <a href="{{ route('reviews.index') }}"
           class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border hover:bg-gray-50 text-gray-700">
            {{-- heroicon: arrow-left --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
            </svg>
            <span>Kembali</span>
        </a>
    </div>


    {{-- Ringkasan (match style card sebelumnya) --}}
    <div class="bg-white rounded-xl shadow border">
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Konten Review --}}
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    {{-- heroicon: chat-bubble-left-right --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path d="M1.5 6.75A3.75 3.75 0 0 1 5.25 3h13.5A3.75 3.75 0 0 1 22.5 6.75v6A3.75 3.75 0 0 1 18.75 16.5H9.31l-3.7 2.775A.75.75 0 0 1 4.5 18.75V16.5H5.25A3.75 3.75 0 0 1 1.5 12.75v-6Z"/>
                    </svg>
                    <span>Konten Review</span>
                </div>
                <div class="text-gray-800 leading-relaxed whitespace-pre-line">
                    {{ $review->content ?: '-' }}
                </div>
            </div>

            {{-- Rating --}}
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    {{-- heroicon: star --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 .75l3.06 6.2 6.84.996-4.95 4.83 1.17 6.82L12 16.98l-6.12 3.616 1.17-6.82L2.1 7.946l6.84-.996L12 .75z"/>
                    </svg>
                    <span>Rating</span>
                </div>
                <div class="flex items-center gap-2">
                    @php $rp = (int) ($review->rating_point ?? 0); @endphp
                    <div class="flex">
                        @for($i=1; $i<=5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 {{ $i <= $rp ? 'text-yellow-400' : 'text-gray-300' }}"
                                 viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 .75l3.06 6.2 6.84.996-4.95 4.83 1.17 6.82L12 16.98l-6.12 3.616 1.17-6.82L2.1 7.946l6.84-.996L12 .75z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">({{ $rp }}/5)</span>
                </div>
            </div>

            {{-- Produk --}}
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    {{-- heroicon: cube --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11.7 1.802a.75.75 0 0 1 .6 0l8.25 3.75a.75.75 0 0 1 0 1.372l-8.25 3.75a.75.75 0 0 1-.6 0L3.45 6.924a.75.75 0 0 1 0-1.372l8.25-3.75Z"/>
                        <path d="M2.25 9.2a.75.75 0 0 1 1.05-.69l8.4 3.818a.75.75 0 0 0 .6 0l8.4-3.819a.75.75 0 0 1 1.05.691v7.548a.75.75 0 0 1-.45.687l-8.25 3.75a.75.75 0 0 1-.6 0l-8.25-3.75a.75.75 0 0 1-.45-.687V9.2Z"/>
                    </svg>
                    <span>Produk</span>
                </div>
                <div class="text-gray-800">
                    @if($review->product)
                        <div class="font-medium">{{ $review->product->name ?? ('#'.$review->product->id) }}</div>
                        @if(!empty($review->product->sku))
                            <div class="text-sm text-gray-500">SKU: {{ $review->product->sku }}</div>
                        @endif
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>
            </div>

            {{-- Pengulas --}}
            <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    {{-- heroicon: user --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Zm-9 9a9 9 0 1 1 18 0H3Z"/>
                    </svg>
                    <span>Pengulas</span>
                </div>
                <div class="text-gray-800">
                    @if($review->user)
                        <div class="font-medium">{{ $review->user->name ?? ('#'.$review->user->id) }}</div>
                        @if(!empty($review->user->email))
                            <div class="text-sm text-gray-500">{{ $review->user->email }}</div>
                        @endif
                    @else
                        <span class="text-gray-500">-</span>
                    @endif
                </div>
            </div>

            {{-- Detail Transaksi (tampilan konsisten card/grid seperti sebelumnya) --}}
            <div class="space-y-2 md:col-span-2">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    {{-- heroicon: receipt-percent --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                         viewBox="0 0 24 24" fill="currentColor">
                        <path d="M6 2.25A2.25 2.25 0 0 0 3.75 4.5v15a.75.75 0 0 0 1.2.6l1.8-1.35 1.8 1.35a.75.75 0 0 0 .9 0l1.8-1.35 1.8 1.35a.75.75 0 0 0 .9 0l1.8-1.35 1.8 1.35a.75.75 0 0 0 1.2-.6v-15A2.25 2.25 0 0 0 18 2.25H6Z"/>
                        <path d="M8.25 7.5h7.5v1.5h-7.5V7.5Zm0 3h7.5V12h-7.5v-1.5Z"/>
                    </svg>
                    <span>Detail Transaksi</span>
                </div>

                @if($product_details)
                    @foreach($product_details as $pd)
                        <div class="bg-gray-50 rounded-lg p-4 text-sm text-gray-700 grid grid-cols-1 sm:grid-cols-4 gap-3 mb-3">
                            <div>
                                <div class="text-gray-500">VARIANT</div>
                                <div class="font-medium">{{ $pd->color }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500">HARGA SATUAN</div>
                                <div class="font-medium">
                                    @php $price = (int)($pd->price ?? 0); @endphp
                                    @if(function_exists('idr')) @idr($price)
                                    @else Rp {{ number_format($price,0,',','.') }} @endif
                                </div>
                            </div>
                            <div>
                                <div class="text-gray-500">QUANTITY</div>
                                <div class="font-medium">{{ $pd->detail_qty }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500">SUB TOTAL</div>
                                <div class="font-medium">
                                    @php $price = (int)($pd->detail_subtotal ?? 0); @endphp
                                    @if(function_exists('idr')) @idr($price)
                                    @else Rp {{ number_format($price,0,',','.') }} @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-gray-500">-</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Galeri gambar (match grid/hover style sebelumnya) --}}
    <div class="bg-white rounded-xl shadow border">
        <div class="p-6">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                {{-- heroicon: photo --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                     viewBox="0 0 24 24" fill="currentColor">
                    <path d="M2.25 6.75A2.25 2.25 0 0 1 4.5 4.5h15a2.25 2.25 0 0 1 2.25 2.25v10.5A2.25 2.25 0 0 1 19.5 19.5h-15A2.25 2.25 0 0 1 2.25 17.25V6.75Zm3 1.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"/>
                    <path d="M21 15.75l-5.25-7.5-4.5 6L9 12l-6 8.25h18Z"/>
                </svg>
                <span>Foto dari Pembeli</span>
            </div>

            @php
                $images = $review->reviewImages ?? collect();
                $photoUrls = $images->map(fn($img) => \Illuminate\Support\Facades\Storage::url(ltrim($img->image_path,'/')))->values();
            @endphp

            @if($images->count())
            <div id="review-gallery"
                data-photos='@json($photoUrls)'
                class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">

                @foreach($images as $img)
                    @php $url = \Illuminate\Support\Facades\Storage::url(ltrim($img->image_path,'/')); @endphp

                    <button type="button"
                            class="relative group overflow-hidden rounded-lg border bg-gray-50 focus:outline-none"
                            data-modal-target="image-preview-modal"
                            data-modal-toggle="image-preview-modal"
                            data-index="{{ $loop->index }}">
                        <img
                            src="{{ $url }}"
                            alt="review image"
                            class="w-full h-40 object-cover group-hover:scale-105 transition-transform"
                            onerror="this.onerror=null;this.src='https://via.placeholder.com/800x600?text=Image';"
                        >
                        <div class="absolute inset-0 pointer-events-none ring-0 group-hover:ring-2 group-hover:ring-yellow-400 rounded-lg transition"></div>

                        {{-- heroicon: magnifying-glass-plus --}}
                        <div class="absolute top-2 right-2 bg-white/80 backdrop-blur rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-4.35-4.35M16.65 16.65A7.5 7.5 0 1116.65 2.1a7.5 7.5 0 010 14.55zM12 7.5v9m4.5-4.5h-9"/>
                            </svg>
                        </div>
                    </button>
                @endforeach
            </div>
            @else
            <div class="text-gray-500 text-sm">Tidak ada gambar.</div>
            @endif
        </div>

        <!-- Image Preview Modal (Flowbite) -->
        <div id="image-preview-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-6xl max-h-full">
                <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t">
                    <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                    {{-- heroicon: photo --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M2.25 6.75A2.25 2.25 0 0 1 4.5 4.5h15a2.25 2.25 0 0 1 2.25 2.25v10.5A2.25 2.25 0 0 1 19.5 19.5h-15A2.25 2.25 0 0 1 2.25 17.25V6.75Zm3 1.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z"/>
                        <path d="M21 15.75l-5.25-7.5-4.5 6L9 12l-6 8.25h18Z"/>
                    </svg>
                    Preview Gambar
                    </h3>
                    <button type="button" data-modal-hide="image-preview-modal"
                            class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                    {{-- heroicon: x-mark --}}
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                    <span class="sr-only">Tutup</span>
                    </button>
                </div>

                <!-- Body -->
                <div class="p-4 md:p-5">
                    <div class="relative bg-black/5 rounded-md flex items-center justify-center">
                    <img id="preview-img" src="" alt="preview"
                        class="max-h-[75vh] w-auto object-contain select-none"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/1200x800?text=Image';">

                    <!-- Prev -->
                    <button type="button" id="btn-prev"
                            class="hidden md:flex absolute left-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-2 shadow">
                        {{-- heroicon: chevron-left --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                    </button>

                    <!-- Next -->
                    <button type="button" id="btn-next"
                            class="hidden md:flex absolute right-2 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-2 shadow">
                        {{-- heroicon: chevron-right --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-700" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                        </svg>
                    </button>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between gap-3 p-4 md:p-5 border-t border-gray-200 rounded-b">
                    <div class="text-sm text-gray-600">
                        <span id="counter">0 / 0</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a id="btn-download" href="#" download
                            class="inline-flex items-center gap-2 text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg px-3 py-2">
                            {{-- heroicon: arrow-down-tray --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M7.5 10.5 12 15m0 0 4.5-4.5M12 15V3"/>
                            </svg>
                            Download
                        </a>
                        <button data-modal-hide="image-preview-modal" type="button"
                                class="text-gray-700 bg-white border border-gray-200 hover:bg-gray-100 rounded-lg px-3 py-2">
                            Tutup
                        </button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            (function() {
            function initPreview() {
                const gallery = document.getElementById('review-gallery');
                if (!gallery) return;

                const photos = JSON.parse(gallery.dataset.photos || '[]');
                const img    = document.getElementById('preview-img');
                const prev   = document.getElementById('btn-prev');
                const next   = document.getElementById('btn-next');
                const ctr    = document.getElementById('counter');
                const dl     = document.getElementById('btn-download');
                const modal  = document.getElementById('image-preview-modal');

                let idx = 0;

                function render() {
                if (!photos.length) return;
                img.src = photos[idx];
                ctr.textContent = (idx + 1) + ' / ' + photos.length;
                dl.href = photos[idx];
                // enable/disable nav
                prev.classList.toggle('opacity-50', idx === 0);
                prev.classList.toggle('cursor-not-allowed', idx === 0);
                next.classList.toggle('opacity-50', idx === photos.length - 1);
                next.classList.toggle('cursor-not-allowed', idx === photos.length - 1);
                }

                // click thumbnail: Flowbite akan toggle modal via data-attr; kita set index & render
                gallery.querySelectorAll('[data-index]').forEach(btn => {
                btn.addEventListener('click', () => {
                    idx = parseInt(btn.getAttribute('data-index')) || 0;
                    render();
                });
                });

                prev.addEventListener('click', (e) => {
                e.stopPropagation();
                if (idx > 0) { idx--; render(); }
                });
                next.addEventListener('click', (e) => {
                e.stopPropagation();
                if (idx < photos.length - 1) { idx++; render(); }
                });

                // keyboard nav saat modal terbuka
                document.addEventListener('keydown', (e) => {
                const visible = !modal.classList.contains('hidden');
                if (!visible) return;
                if (e.key === 'ArrowLeft') { if (idx > 0) { idx--; render(); } }
                if (e.key === 'ArrowRight') { if (idx < photos.length - 1) { idx++; render(); } }
                });
            }

            // init on DOM load & after Livewire re-render (jaga-jaga)
            document.addEventListener('DOMContentLoaded', initPreview);
            document.addEventListener('livewire:load', () => {
                if (window.Livewire) {
                window.Livewire.hook('message.processed', initPreview);
                }
            });
            })();
            </script>

        </div>

    </div>
</div>
