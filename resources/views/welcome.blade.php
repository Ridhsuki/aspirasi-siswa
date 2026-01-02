<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.seo')
    <title>{{ config('app.name', 'Aspirasi Siswa') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        ::selection {
            background-color: #a4c0ea;
            color: #fff
        }
    </style>
</head>

<body
    class="font-sans antialiased text-gray-900 bg-gradient-to-b from-blue-50 to-white min-h-screen flex flex-col relative overflow-hidden">

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-blue-200/20 blur-3xl"></div>
        <div class="absolute top-[20%] -right-[10%] w-[30%] h-[30%] rounded-full bg-indigo-200/20 blur-3xl"></div>
    </div>

    <nav class="w-full px-6 py-6 flex justify-between items-center z-10">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img src="{{ asset('assets/img/logo.webp') }}" class="h-8 w-auto" alt="Logo">
            <span class="font-bold text-gray-700 tracking-tight">Aspirasi Siswa</span>
        </a>

        <div class="flex gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-semibold text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200 transition">Masuk</a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center px-4 text-center z-10 -mt-10">

        <div class="mb-8 transform hover:scale-105 transition duration-500">
            <img src="{{ asset('assets/img/logo.webp') }}" class="h-32 md:h-40 w-auto drop-shadow-xl" alt="Logo OSIS">
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-gray-900 mb-2">
            OSIS <span class="text-blue-700">SMA NEGERI 3</span>
        </h1>
        <h2 class="text-2xl md:text-3xl font-bold text-gray-700 mb-6">
            KEPULAUAN ARU
        </h2>

        <p class="max-w-2xl text-lg md:text-xl text-gray-600 mb-10 leading-relaxed">
            "Ayo! Berbagi Kritik, Saran, dan Masukan demi Kemajuan bersama dengan <br class="hidden md:block">
            <span class="font-semibold text-blue-600">OSIS SMA NEGERI 3 KEPULAUAN ARU</span>"
        </p>

        <div class="flex flex-col sm:flex-row gap-4 w-full justify-center">
            @auth
                <a href="{{ route('aspirations.index') }}"
                    class="inline-flex justify-center items-center px-8 py-3.5 text-base font-bold text-white bg-blue-700 rounded-full hover:bg-blue-800 shadow-lg hover:shadow-blue-500/30 transition-all transform hover:-translate-y-1">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Buat Laporan Sekarang
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex justify-center items-center px-8 py-3.5 text-base font-bold text-white bg-blue-700 rounded-full hover:bg-blue-800 shadow-lg hover:shadow-blue-500/30 transition-all transform hover:-translate-y-1">
                    Sampaikan Aspirasi
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-flex justify-center items-center px-8 py-3.5 text-base font-bold text-gray-700 bg-white border border-gray-200 rounded-full hover:bg-gray-50 hover:text-blue-700 shadow-sm transition-all">
                        Daftar Akun
                    </a>
                @endif
            @endauth
        </div>

    </main>

    <footer class="w-full py-6 text-center text-sm text-gray-400">
        &copy; {{ date('Y') }} Aspirasi Siswa - OSIS SMA Negeri 3 Kepulauan Aru
    </footer>

</body>

</html>
