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

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr
                                class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto md:relative">
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                    Nama</th>
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                    NISN</th>
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                    Kelas</th>
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                    Email</th>
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @foreach ($users as $user)
                                <tr
                                    class="bg-white border border-grey-500 md:border-none block md:table-row hover:bg-gray-50">
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        {{ $user->name ?? '-' }}
                                        @if ($user->role === 'admin')
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium text-blue-700 bg-blue-100 rounded-full">
                                                Admin
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                                Siswa
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        {{ $user->nisn ?? '-' }}</td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        {{ $user->kelas ?? '-' }}</td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        {{ $user->email ?? '-' }}</td>
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <a href="{{ route('admin.users.show', $user->id) }}"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            Lihat
                                        </a>
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
