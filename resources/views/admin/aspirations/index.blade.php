<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Aspirasi Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
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
                                    Tanggal
                                </th>
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                    Siswa
                                </th>
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell w-1/2">
                                    Isi Aspirasi
                                </th>
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                    Status (Internal)
                                </th>
                                <th
                                    class="bg-gray-100 p-2 text-gray-600 font-bold md:border md:border-grey-500 text-left block md:table-cell">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @forelse ($aspirations as $aspiration)
                                <tr
                                    class="bg-white border border-grey-500 md:border-none block md:table-row hover:bg-gray-50">
                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <span
                                            class="text-sm text-gray-500">{{ $aspiration->created_at->format('d M Y H:i') }}</span>
                                    </td>

                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <div class="font-bold">{{ $aspiration->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $aspiration->user->kelas ?? '-' }}</div>
                                        @if ($aspiration->is_anonymous)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-red-700">
                                                (Postingan Anonim)
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <p class="text-gray-700 whitespace-pre-line">
                                            {{ Str::limit($aspiration->content, 150) }}
                                        </p>
                                        @if (strlen($aspiration->content) > 150)
                                            <a href="{{ route('admin.aspirations.show', $aspiration->id) }}"
                                                class="text-blue-500 text-xs hover:underline mt-1">Lihat Selengkapnya
                                            </a>
                                        @endif
                                    </td>

                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        @if ($aspiration->status === 'pending')
                                            <span
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-yellow-700 bg-yellow-100 rounded-full">
                                                Pending
                                            </span>
                                        @elseif ($aspiration->status === 'processed')
                                            <span
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-full">
                                                Processed
                                            </span>
                                        @elseif ($aspiration->status === 'closed')
                                            <span
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full">
                                                Closed
                                            </span>
                                        @elseif ($aspiration->status === 'resolved')
                                            <span
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                                Resolved
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.aspirations.show', $aspiration->id) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm"
                                                title="Lihat Detail & Balasan">
                                                Lihat
                                            </a>

                                            <form action="{{ route('admin.aspirations.destroy', $aspiration->id) }}"
                                                method="POST" onsubmit="return confirm('Hapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm"
                                                    title="Hapus">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data aspirasi
                                        masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $aspirations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
