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


@if (!Auth::check())
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