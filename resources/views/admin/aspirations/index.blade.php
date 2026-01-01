<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Aspirasi Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-6">
                <form method="GET" action="{{ route('admin.aspirations.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                        <div class="md:col-span-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cari Aspirasi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Cari isi pesan, nama siswa...">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="all">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}><i
                                        class="fa-solid fa-clock"></i> Pending
                                </option>
                                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}><i
                                        class="fa-solid fa-circle-check"></i>
                                    Resolved</option>
                                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}><i
                                        class="fa-solid fa-lock"></i> Closed
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Pengirim</label>
                            <select name="type"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="all">Semua Tipe</option>
                                <option value="public" {{ request('type') == 'public' ? 'selected' : '' }}>Publik
                                </option>
                                <option value="anonymous" {{ request('type') == 'anonymous' ? 'selected' : '' }}> Anonim
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                            <input type="date" name="date_start" value="{{ request('date_start') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                            <input type="date" name="date_end" value="{{ request('date_end') }}"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div class="mt-4 flex flex-col sm:flex-row justify-between items-center gap-4 border-t pt-4">
                        <div class="flex items-center gap-2 w-full sm:w-auto">
                            <label class="text-sm font-medium text-gray-700 whitespace-nowrap">Urutkan:</label>
                            <select name="sort"
                                class="block w-full sm:w-auto rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm py-1">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama
                                </option>
                            </select>
                        </div>

                        <div class="flex gap-2 w-full sm:w-auto">
                            <a href="{{ route('admin.aspirations.index') }}"
                                class="flex-1 sm:flex-none justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition text-sm font-medium flex items-center gap-2">
                                <i class="fa-solid fa-rotate-left"></i> Reset
                            </a>
                            <button type="submit"
                                class="flex-1 sm:flex-none justify-center px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition text-sm font-medium flex items-center gap-2 shadow-sm">
                                <i class="fa-solid fa-filter"></i> Terapkan Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">
                            Daftar Aspirasi
                            <span class="text-sm font-normal text-gray-500">
                                (Total: {{ $aspirations->total() }} data)
                            </span>
                        </h3>
                    </div>

                    @if ($aspirations->isEmpty())
                        <div class="text-center py-12">
                            <div class="mb-3 text-gray-300">
                                <i class="fa-solid fa-magnifying-glass text-4xl"></i>
                            </div>
                            <p class="text-gray-500 text-lg font-medium">Data tidak ditemukan.</p>
                            <p class="text-gray-400 text-sm">Coba sesuaikan filter atau kata kunci pencarian Anda.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Siswa</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Isi Aspirasi</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($aspirations as $aspiration)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $aspiration->created_at->format('d M Y') }}
                                                <div class="text-xs text-gray-400">
                                                    {{ $aspiration->created_at->format('H:i') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $aspiration->is_anonymous ? 'Seseorang (Anonim)' : $aspiration->user->name }}
                                                </div>
                                                <div class="text-xs text-gray-500">
                                                    {{ $aspiration->user->kelas ?? '-' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-sm text-gray-700 line-clamp-2 w-64 md:w-80">
                                                    {{ $aspiration->content }}
                                                </p>
                                                @if ($aspiration->replies_count > 0)
                                                    <span
                                                        class="inline-flex items-center mt-1 px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700">
                                                        <i class="fa-regular fa-comments mr-1"></i>
                                                        {{ $aspiration->replies_count }} balasan
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($aspiration->status == 'pending')
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                        <i class="fa-solid fa-clock"></i> Pending
                                                    </span>
                                                @elseif($aspiration->status == 'resolved')
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-blue-700 bg-blue-100 border border-blue-200">
                                                        <i class="fa-solid fa-circle-check"></i> Resolved
                                                    </span>
                                                @elseif($aspiration->status == 'closed')
                                                    <span
                                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-gray-700 bg-gray-100 border border-gray-200">
                                                        <i class="fa-solid fa-lock"></i> Closed
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <a href="{{ route('admin.aspirations.show', $aspiration->id) }}"
                                                    class="text-blue-600 hover:text-blue-900 px-3 py-1 rounded hover:bg-blue-50 transition">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 px-4 py-3 border-t border-gray-200">
                            {{ $aspirations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
