<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Siswa') }}
            </h2>
            <a href="{{ route('admin.users.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md text-sm hover:bg-gray-300 transition">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center relative">
                        <div
                            class="mx-auto h-20 w-20 bg-blue-100 rounded-full flex items-center justify-center text-2xl font-bold text-blue-600 mb-4">
                            {{ substr($user->name, 0, 1) }}
                        </div>

                        <h3 class="text-lg font-bold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500 mb-4">{{ $user->email }}</p>

                        <div class="text-left border-t pt-4 space-y-2 text-sm text-gray-700">
                            <div class="flex justify-between">
                                <span class="text-gray-500">NISN:</span> <span>{{ $user->nisn }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Kelas:</span> <span>{{ $user->kelas }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Wali Kelas:</span>
                                <span>{{ $user->walikelas ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="mt-6 flex gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-white py-2 rounded text-sm font-bold">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('Hapus siswa ini?');">
                                @csrf @method('DELETE')
                                <button
                                    class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded text-sm font-bold">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-6">

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">📢 Riwayat Aspirasi</h3>
                        @if ($user->aspirations->isEmpty())
                            <p class="text-gray-400 text-center text-sm">Belum ada aspirasi.</p>
                        @else
                            <div class="space-y-3">
                                @foreach ($user->aspirations as $aspiration)
                                    <div class="p-3 border rounded hover:bg-gray-50 flex justify-between items-start">
                                        <div>
                                            <span
                                                class="text-xs text-gray-500">{{ $aspiration->created_at->format('d M Y') }}</span>
                                            <p class="text-sm text-gray-800 mt-1 line-clamp-2">
                                                {{ $aspiration->content }}</p>
                                        </div>
                                        <a href="{{ route('admin.aspirations.show', $aspiration->id) }}"
                                            class="text-blue-600 text-xs hover:underline ml-2 whitespace-nowrap">Lihat</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">💬 Riwayat Komentar</h3>
                        @if ($user->replies->isEmpty())
                            <p class="text-gray-400 text-center text-sm">Belum ada komentar.</p>
                        @else
                            <ul class="space-y-3">
                                @foreach ($user->replies as $reply)
                                    <li class="text-sm">
                                        <span class="text-gray-500 text-xs">Pada: <a
                                                href="{{ route('admin.aspirations.show', $reply->aspiration_id) }}"
                                                class="text-blue-600 hover:underline">Aspirasi
                                                #{{ $reply->aspiration_id }}</a></span>
                                        <div class="bg-gray-50 p-2 rounded mt-1 italic text-gray-700">
                                            "{{ $reply->content }}"</div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
