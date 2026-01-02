<x-app-layout>
    @section('title', 'Tentang Aplikasi')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tentang Aplikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- SECTION 1: HERO & INTRO --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 md:p-12">
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-8">
                        <div class="space-y-4 flex-1">
                            <div
                                class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-bold uppercase tracking-wide mb-2">
                                Platform Demokrasi Sekolah
                            </div>
                            <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                                Aspirasi Siswa
                            </h3>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                Sebuah inisiatif digital untuk menciptakan lingkungan sekolah yang lebih terbuka,
                                demokratis, dan progresif. Kami percaya bahwa perubahan besar dimulai dari
                                keberanian untuk bersuara.
                            </p>
                        </div>
                        <div
                            class="hidden md:flex bg-indigo-600 p-6 rounded-2xl shadow-lg transform rotate-3 hover:rotate-0 transition duration-300">
                            <i class="fa-solid fa-bullhorn text-5xl text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: NILAI UTAMA (STATIC CONTENT) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-indigo-500 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-indigo-50 rounded-lg flex items-center justify-center mb-4">
                        <i class="fa-solid fa-lightbulb text-indigo-600 text-xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Transparansi Publik</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Membangun kepercayaan antara siswa dan sekolah melalui keterbukaan informasi.
                        Setiap aspirasi yang layak akan dikelola secara profesional untuk kemajuan bersama.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-pink-500 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-pink-50 rounded-lg flex items-center justify-center mb-4">
                        <i class="fa-solid fa-umbrella text-pink-600 text-xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Ruang Aman</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Kami menjamin privasi dan keamanan data pelapor. Siswa dapat menyampaikan
                        kritik dan saran tanpa rasa takut, menciptakan dialog yang sehat dan konstruktif.
                    </p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border-t-4 border-emerald-500 hover:shadow-md transition">
                    <div class="h-12 w-12 bg-emerald-50 rounded-lg flex items-center justify-center mb-4">
                        <i class="fa-solid fa-hand-holding-heart text-emerald-600 text-xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-2">Solusi Nyata</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Bukan sekadar kotak saran. Platform ini dirancang untuk memastikan setiap
                        masukan didengar, dianalisis, dan ditindaklanjuti oleh pihak yang berwenang.
                    </p>
                </div>
            </div>

            {{-- SECTION 3: DETAILED INFO (FAQ STYLE) --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h4 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <i class="fa-regular fa-circle-question mr-2 text-indigo-500"></i> Informasi Umum
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Apa itu Aspirasi Siswa?</h5>
                            <p class="text-sm text-gray-600 text-justify">
                                Aspirasi Siswa adalah jembatan komunikasi digital yang menghubungkan siswa dengan
                                pengurus OSIS dan pihak sekolah.
                                Aplikasi ini menggantikan metode kotak saran konvensional menjadi sistem yang lebih
                                modern, cepat, dan terukur.
                            </p>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Siapa yang mengelola aplikasi ini?</h5>
                            <p class="text-sm text-gray-600 text-justify">
                                Aplikasi ini dikelola oleh tim Administrator internal (OSIS/Sekolah) yang bertugas
                                memverifikasi, meninjau,
                                dan menjawab setiap aspirasi yang masuk sesuai dengan prosedur yang berlaku.
                            </p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Bagaimana alurnya?</h5>
                            <p class="text-sm text-gray-600 text-justify">
                                Siswa mengirim aspirasi &rarr; Admin melakukan verifikasi &rarr; Aspirasi
                                ditinjau/dibalas &rarr; Selesai.
                                Pengguna dapat memantau perkembangan aspirasi mereka secara langsung melalui dashboard.
                            </p>
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 mb-1">Komitmen Pengembang</h5>
                            <p class="text-sm text-gray-600 text-justify">
                                Aplikasi ini dikembangkan dengan semangat <em>Open Source</em> dan kerelawanan untuk
                                mendukung digitalisasi sekolah
                                tanpa biaya lisensi komersial, demi kemajuan pendidikan Indonesia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 4: FOOTER CREDITS (FIXED) --}}
            <div
                class="bg-gray-50 border border-gray-200 rounded-xl p-6 flex flex-col md:flex-row justify-between items-center gap-4">

                {{-- Developer Identity --}}
                <div class="flex items-center space-x-4">
                    <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase font-semibold tracking-wider">Developed by</p>
                        <a href="https://ridhsuki.my.id" target="_blank"
                            class="text-lg font-bold text-gray-800 hover:text-indigo-600 transition">
                            ridhsuki.my.id <i
                                class="fa-solid fa-arrow-up-right-from-square text-xs ml-1 text-gray-400"></i>
                        </a>
                    </div>
                </div>

                {{-- Divider for mobile --}}
                <div class="w-full h-px bg-gray-200 md:hidden"></div>

                {{-- Links & Service --}}
                <div class="flex flex-col md:flex-row items-center gap-4 md:gap-8">
                    <a href="https://github.com/ridhsuki/aspirasi-siswa" target="_blank"
                        class="text-sm text-gray-500 hover:text-gray-900 flex items-center transition">
                        <i class="fa-brands fa-github text-lg mr-2"></i> Source Code
                    </a>

                    <div class="flex items-center bg-white px-4 py-2 rounded-lg border border-gray-200 shadow-sm">
                        <span class="text-xs text-gray-400 mr-2">Service by</span>
                        <a href="https://onlinekan.netlify.app/" target="_blank"
                            class="font-bold text-gray-700 hover:text-indigo-600 flex items-center transition">
                            Onlinekan <i class="fa-solid fa-bolt text-yellow-500 ml-1.5"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
