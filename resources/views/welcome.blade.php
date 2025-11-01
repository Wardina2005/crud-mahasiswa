<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    {{-- Ganti ke font standar/default jika Instrument Sans tidak tersedia di sistem Anda --}}
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> 

    {{-- Ini akan memuat resources/css/app.css dan resources/js/app.js --}}
    {{-- Pastikan Anda sudah menjalankan 'npm run dev' di terminal --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-100 dark:bg-gray-900">
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        
        {{-- Bagian Navigasi (Login/Register) di pojok kanan atas --}}
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        {{-- KONTEN UTAMA YANG SUDAH KOSONG (Siap Diisi) --}}
        <div class="text-center p-6">
            <h1 class="text-3xl font-bold text-gray-700 dark:text-gray-300">
                ✅ Halaman Bersih, Siap Koding
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2">
                Konten bawaan Laravel sudah dihapus.
            </p>
            <p class="text-gray-500 dark:text-gray-400">
                Silakan isi halaman ini atau cek rute Anda.
            </p>
        </div>
        
    </div>
</body>
</html>