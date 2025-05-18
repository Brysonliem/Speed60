<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speed60</title>

    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <div class="z-1">
        @include('components.navbar') <!-- Memanggil navbar -->
    </div>
    <div class="flex-1 z-0 p-4 md:p-8">
        {{ $slot }} <!-- Bagian ini akan diisi oleh Livewire Component -->
    </div>

    @include('components.footer')

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>