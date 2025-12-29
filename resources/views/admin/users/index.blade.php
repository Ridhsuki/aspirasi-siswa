<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold">Daftar Siswa</h3>
                    <a href="{{ route('admin.users.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out flex items-center gap-2">
                        <i class="fas fa-plus-square"></i> Tambah Siswa
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 font-semibold text-left">
                                <th class="px-4 py-2 text-sm sm:text-base">Nama</th>
                                <th class="px-4 py-2 text-sm sm:text-base">NISN</th>
                                <th class="px-4 py-2 text-sm sm:text-base">Kelas</th>
                                <th class="px-4 py-2 text-sm sm:text-base">Email</th>
                                <th class="px-4 py-2 text-sm sm:text-base">Role</th>
                                <th class="px-4 py-2 text-sm sm:text-base">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-200">
                                    <td class="px-4 py-3 text-gray-800">{{ $user->name ?? '-'}}</td>
                                    <td class="px-4 py-3 text-gray-800">{{ $user->nisn ?? '-'}}</td>
                                    <td class="px-4 py-3 text-gray-800">{{ $user->kelas ?? '-'}}</td>
                                    <td class="px-4 py-3 text-gray-800">{{ $user->email ?? '-'}}</td>

                                    <td class="px-4 py-3">
                                        @if ($user->role === 'admin')
                                            <span
                                                class="inline-flex items-center px-3 py-1 text-xs sm:text-sm font-medium text-blue-700 bg-blue-100 rounded-full">
                                                Admin
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 text-xs sm:text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                                Siswa
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="text-blue-600 hover:text-blue-800 font-medium text-xs sm:text-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-medium text-xs sm:text-sm">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
