<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="p-8 text-white relative">
                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold mb-2 inline-flex items-center">
                            Halo, {{ Auth::user()->name }}!
                            <img src="https://raw.githubusercontent.com/Ridhsuki/Ridhsuki/refs/heads/main/img/Hi.gif"
                                alt="hi" class="ml-2 w-8 h-8">
                        </h3>
                        <p class="text-blue-100 max-w-2xl text-lg">
                            Selamat datang di ruang aspirasi. Suaramu adalah langkah awal untuk perubahan sekolah yang
                            lebih baik.
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('aspirations.index') }}"
                                class="inline-flex items-center bg-white text-blue-600 font-bold py-2.5 px-6 rounded-lg shadow hover:bg-gray-50 transition transform hover:-translate-y-0.5">
                                <i class="fa-solid fa-pen-nib mr-2"></i> Tulis Aspirasi Baru
                            </a>
                        </div>
                    </div>
                    <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-4 translate-y-4">
                        <i class="fa-solid fa-comments text-9xl"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-1 space-y-4">
                    <div
                        class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Aspirasi Saya</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $myStats['total'] }}</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-full text-blue-600">
                            <i class="fa-solid fa-paper-plane text-xl"></i>
                        </div>
                    </div>

                    <div
                        class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm font-medium">Total Tanggapan Masuk</p>
                            <p class="text-3xl font-bold text-gray-800">{{ $myStats['replies'] }}</p>
                        </div>
                        <div class="p-3 bg-purple-50 rounded-full text-purple-600">
                            <i class="fa-solid fa-reply-all text-xl"></i>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-5 rounded-xl border border-blue-100">
                        <h4 class="font-bold text-blue-800 mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-circle-info"></i> Info
                        </h4>
                        <p class="text-sm text-blue-700 leading-relaxed">
                            Aspirasi yang kamu kirim akan dibaca dan ditindaklanjuti oleh pengurus OSIS. Cek <a
                                href="{{ route('aspirations.activity') }}">aktivitas Saya</a> secara berkala untuk
                            melihat tanggapan.
                        </p>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-gray-400"></i> Riwayat Terakhir
                        </h3>
                        <a href="{{ route('aspirations.activity') }}"
                            class="text-blue-600 text-sm font-medium hover:underline flex items-center gap-1">
                            Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>

                    @if ($recentAspirations->isEmpty())
                        <div class="text-center py-12">
                            <div
                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-300">
                                <i class="fa-solid fa-inbox text-2xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada riwayat aspirasi.</p>
                            <p class="text-gray-400 text-sm mt-1">Aspirasi yang kamu tulis akan muncul di sini.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach ($recentAspirations as $asp)
                                <div
                                    class="group border border-gray-100 rounded-xl p-4 hover:bg-gray-50 hover:border-gray-200 transition relative">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex items-center gap-2 text-xs text-gray-500">
                                            <span class="flex items-center gap-1 bg-gray-100 px-2 py-1 rounded">
                                                <i class="fa-regular fa-calendar"></i>
                                                {{ $asp->created_at->format('d M Y') }}
                                            </span>
                                            <span class="text-gray-300">|</span>
                                            <span>{{ $asp->created_at->format('H:i') }} WIB</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('aspirations.show', $asp->id) }}" class="block">
                                        <p
                                            class="text-gray-800 font-medium text-sm line-clamp-2 mb-3 group-hover:text-blue-600 transition">
                                            {{ $asp->content }}
                                        </p>
                                    </a>

                                    <div
                                        class="flex items-center justify-between mt-2 pt-2 border-t border-gray-100 text-xs">
                                        <span
                                            class="flex items-center gap-1.5 {{ $asp->replies->count() > 0 ? 'text-blue-600 font-medium' : 'text-gray-400' }}">
                                            <i class="fa-regular fa-comments"></i>
                                            {{ $asp->replies->count() }} Tanggapan
                                        </span>

                                        <a href="{{ route('aspirations.show', $asp->id) }}"
                                            class="text-gray-400 hover:text-blue-600 flex items-center gap-1 transition">
                                            Detail <i class="fa-solid fa-chevron-right text-[10px]"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
