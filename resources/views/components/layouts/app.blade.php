<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speed60</title>
    @vite('resources/css/app.css')
    @livewireStyles
    @include('components.layouts.navbar') <!-- Memanggil navbar -->
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-6">
        {{ $slot }} <!-- Bagian ini akan diisi oleh Livewire Component -->
    </div>
    @livewireScripts
</body>

<footer>
@include('components.layouts.footer')
</footer>

</html>
