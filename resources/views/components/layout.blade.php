<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="vendors/sweetalert2/dist/sweetalert2.min.js"></script><!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <header>
        {{-- Hanya tampilkan navbar jika bukan halaman login --}}
        @if (!Route::is('login'))
        @include('components.navbar')
        @endif
    </header>

    <main class="container mx-auto py-4">
        {{-- Struktur layout halaman biasa tetap --}}
        <div class="@if (!Route::is('login')) p-4 sm:ml-64 @endif">
            {{-- Tempatkan div ini hanya untuk halaman login --}}
            @if (Route::is('login'))
            {{-- Flexbox hanya diterapkan ke div luar, tidak pada box login --}}
            <div class="flex items-center justify-center h-screen">
                @yield('content')
            </div>
            @else
            <div class="p-4 mt-4">
                @yield('content')
            </div>
            @endif
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>