<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard - Management Aspirasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Bagian 1: Management Aspirasi --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Aspirasi Siswa</h3>

                @if (session('success'))
                    <div class="mb-4 text-green-600 bg-green-100 p-2 rounded">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Siswa</th>
                                <th class="px-6 py-3">Isi Aspirasi</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($aspirations as $aspirasi)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ $aspirasi->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        {{ $aspirasi->user->name }}
                                        @if ($aspirasi->is_anonymous)
                                            <span class="text-xs text-red-500">(Anonim)</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 max-w-xs truncate">{{ $aspirasi->content }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 rounded text-white
                                        {{ $aspirasi->status == 'approved'
                                            ? 'bg-green-500'
                                            : ($aspirasi->status == 'rejected'
                                                ? 'bg-red-500'
                                                : 'bg-yellow-500') }}">
                                            {{ ucfirst($aspirasi->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.aspirasi.status', $aspirasi->id) }}"
                                            method="POST" class="flex gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <button name="status" value="approved"
                                                class="text-green-600 hover:text-green-900">Approve</button>
                                            <button name="status" value="rejected"
                                                class="text-red-600 hover:text-red-900">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Bagian 2: Management User --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Daftar Siswa Terdaftar</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">NISN</th>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Kelas</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4">{{ $student->nisn }}</td>
                                    <td class="px-6 py-4">{{ $student->name }}</td>
                                    <td class="px-6 py-4">{{ $student->kelas }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.users.destroy', $student->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus siswa ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
