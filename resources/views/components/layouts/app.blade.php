<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speed60</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Josefin Sans', sans-serif;
        }

        footer {
            font-family: 'Josefin Sans', sans-serif;
            font-weight: 700; /* untuk Futura Bold */
        }

        .tiktok-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .tiktok-embed {
            width: 100% !important;
            max-width: 360px;
        }
    </style>

    @vite('resources/css/app.css')
    @livewireStyles
</head>

{{-- mainlayout untuk alpine global --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('modal', {
            open: false,
            product: null,
            quantity: 1,
            show(product) {
                this.product = product
                this.quantity = 1
                this.open = true
            },
            hide() {
                this.open = false
                this.product = null
            }
        });
    });
</script>


@if (Auth::check())
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const drawerId = 'drawer-top-example';

            // Cek apakah sudah pernah ditampilkan di sessionStorage
            if (!sessionStorage.getItem('drawerShown')) {
                const drawerElement = document.getElementById(drawerId);

                if (drawerElement) {
                    const drawer = new Drawer(drawerElement, {
                        placement: 'top',
                        backdrop: false
                    });

                    drawer.show();

                    // Tandai sudah ditampilkan
                    sessionStorage.setItem('drawerShown', 'true');
                }
            }
        });
    </script>
@endif


<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Header / Navbar -->
    <div class="z-1">
        @include('components.navbar')
    </div>

    <!-- Main Content (flex-1 untuk mendorong footer ke bawah) -->
    <main class="flex-1 z-0">
        <div 
            x-data="{ show: false, message: '' }"
            x-show="show"
            x-transition
            x-init="
                window.addEventListener('cart:added', e => {
                    message = e.detail.message;
                    show = true;
                    setTimeout(() => show = false, 3000);
                });
            "
            class="fixed flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow-sm top-5 right-5"
            role="alert"
            style="display: none;"
        >
            <div class="inline-flex items-center justify-center w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
            </div>
            <div class="ml-3 text-sm font-medium" >Berhasil ditambahkan</div>
            <button @click="show = false" class="ms-auto text-gray-400 hover:text-gray-900">
                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>

        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow z-10">
        @include('components.footer')
    </footer>
    {{-- @if (!Auth::check() || (Auth::check() && Auth::user()->role->level == 3))
    @endif --}}


    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script type="importmap">
        {
            "imports": {
                "https://esm.sh/v135/prosemirror-model@1.22.3/es2022/prosemirror-model.mjs": "https://esm.sh/v135/prosemirror-model@1.19.3/es2022/prosemirror-model.mjs", 
                "https://esm.sh/v135/prosemirror-model@1.22.1/es2022/prosemirror-model.mjs": "https://esm.sh/v135/prosemirror-model@1.19.3/es2022/prosemirror-model.mjs"
            }
        }
    </script>
    
</body>

</html>