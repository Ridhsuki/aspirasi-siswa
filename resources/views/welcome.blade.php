<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.seo')
    <title>{{ config('app.name', 'Aspirasi Siswa') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        ::selection {
            background-color: #a4c0ea;
            color: #fff
        }
    </style>
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50 min-h-screen flex flex-col relative overflow-x-hidden">

    <div class="absolute inset-0 overflow-hidden -z-10 pointer-events-none">
        <div
            class="absolute -top-[10%] -left-[10%] w-[50%] h-[50%] rounded-full bg-blue-400/20 blur-[100px] animate-pulse">
        </div>
        <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-indigo-400/20 blur-[100px] animate-pulse"
            style="animation-duration: 4s;"></div>
        <div class="absolute -bottom-[10%] left-[20%] w-[30%] h-[30%] rounded-full bg-purple-400/20 blur-[100px] animate-pulse"
            style="animation-duration: 6s;"></div>
    </div>

    <nav class="w-full px-6 py-6 flex justify-between items-center z-50 absolute top-0 left-0">
        <a href="{{ url('/') }}" class="flex items-center gap-3 group">
            <img src="{{ asset('assets/img/logo.webp') }}"
                class="h-10 w-auto transition-transform duration-300 group-hover:scale-110" alt="Logo">
            <span class="font-bold text-gray-800 tracking-tight text-lg hidden sm:block">Aspirasi Siswa</span>
        </a>

        <div class="flex gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2.5 text-sm font-semibold text-indigo-700 bg-white border border-indigo-100 rounded-full hover:bg-indigo-50 shadow-sm transition-all">
                        Masuk
                    </a>
                @endauth
            @endif
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center px-4 text-center z-10 relative mt-10 sm:mt-0">

        <div class="mb-8 relative group">
            <div
                class="absolute inset-0 bg-indigo-500 rounded-full blur-2xl opacity-20 group-hover:opacity-30 transition-opacity duration-500">
            </div>
            <img src="{{ asset('assets/img/logo.webp') }}"
                class="relative h-32 md:h-44 w-auto drop-shadow-2xl transform transition-transform duration-500 hover:scale-105 hover:rotate-3"
                alt="Logo OSIS">
        </div>

        <div
            class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-600 text-xs font-bold uppercase tracking-widest mb-6">
            <span class="w-2 h-2 rounded-full bg-indigo-600 mr-2 animate-pulse"></span>
            Aspirasi Siswa
        </div>

        <h1 class="text-4xl md:text-6xl font-black tracking-tight text-gray-900 mb-2 leading-tight">
            OSIS <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">SMA NEGERI
                3</span>
        </h1>
        <h2 class="text-xl md:text-3xl font-bold text-gray-500 mb-8 tracking-wide">
            KEPULAUAN ARU
        </h2>

        <p class="max-w-2xl text-base md:text-lg text-gray-600 mb-10 leading-relaxed px-4">
            "Ayo! Berbagi Kritik, Saran, dan Masukan demi Kemajuan bersama dengan
            <span class="font-semibold text-gray-800">OSIS SMA Negeri 3 Kepulauan Aru</span>."
        </p>

        {{-- CTA Buttons --}}
        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto px-4">
            @auth
                <a href="{{ route('aspirations.index') }}"
                    class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-indigo-600 to-blue-600 rounded-xl hover:to-indigo-700 shadow-xl shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
                    <i class="fa-solid fa-pen-to-square mr-2"></i>
                    Buat Laporan Sekarang
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-white bg-gradient-to-r from-indigo-600 to-blue-600 rounded-xl hover:to-indigo-700 shadow-xl shadow-indigo-500/30 transition-all transform hover:-translate-y-1">
                    <i class="fa-solid fa-bullhorn mr-2"></i>
                    Sampaikan Aspirasi
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-flex justify-center items-center px-8 py-4 text-base font-bold text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:text-indigo-600 shadow-sm transition-all transform hover:-translate-y-1">
                        Daftar Akun
                    </a>
                @endif
            @endauth
        </div>

    </main>

    <footer class="w-full py-6 px-4 bg-white/60 backdrop-blur-md border-t border-gray-200/50">
        <div
            class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">

            <div class="text-center md:text-left font-medium">
                &copy; {{ date('Y') }} SMA Negeri 3 Kepulauan Aru
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-6">
                <a href="https://onlinekan.netlify.app/" target="_blank"
                    class="flex items-center gap-1.5 hover:text-indigo-600 transition-colors group">
                    <span
                        class="text-xs font-semibold uppercase tracking-wider text-gray-400 group-hover:text-indigo-400">Powered
                        by</span>
                    <span class="font-bold text-gray-700 group-hover:text-indigo-700">Onlinekan</span>
                    <i class="fa-solid fa-bolt text-yellow-500 text-xs"></i>
                </a>

                <span class="hidden sm:block text-gray-300">|</span>

                <a href="https://ridhsuki.my.id" target="_blank"
                    class="flex items-center gap-1.5 hover:text-indigo-600 transition-colors group">
                    <span
                        class="text-xs font-semibold uppercase tracking-wider text-gray-400 group-hover:text-indigo-400">Dev
                        by</span>
                    <span class="font-bold text-gray-700 group-hover:text-indigo-700">ridhsuki.my.id</span>
                    <i class="fa-solid fa-code text-indigo-400 text-xs group-hover:rotate-12 transition-transform"></i>
                </a>
            </div>

        </div>
    </footer>

</body>

</html>
