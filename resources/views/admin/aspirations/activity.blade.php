<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktivitas Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2">📂 Riwayat Aspirasi Anda</h3>

                    @if ($aspirations->isEmpty())
                        <p class="text-gray-500 italic">Anda belum pernah mengirimkan aspirasi.</p>
                        <a href="{{ route('aspirations.index') }}"
                            class="text-blue-600 hover:underline mt-2 inline-block">Mulai buat aspirasi &rarr;</a>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">
                                            Tanggal</th>
                                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">
                                            Isi</th>
                                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($aspirations as $aspiration)
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-3 px-4 border-b text-sm text-gray-700">
                                                {{ $aspiration->created_at->format('d M Y, H:i') }}
                                            </td>
                                            <td class="py-3 px-4 border-b text-sm text-gray-700">
                                                <span
                                                    class="font-semibold block truncate w-64">{{ $aspiration->content ?? '-' }}</span>
                                            </td>
                                            <td class="py-3 px-4 border-b text-sm text-gray-700">
                                                #
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2">💬 Riwayat Komentar Anda</h3>

                    @if ($replies->isEmpty())
                        <p class="text-gray-500 italic">Anda belum pernah membalas aspirasi apapun.</p>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach ($replies as $reply)
                                <li class="py-4">
                                    <div class="flex space-x-3">
                                        <div class="flex-1 space-y-1">
                                            <div class="flex items-center justify-between">
                                                <h3 class="text-sm font-medium">
                                                    Mengomentari:
                                                    <a href="#" style="">
                                                        <span class="text-blue-600">
                                                            {{ $reply->aspiration->title ?? 'Aspirasi #' . $reply->aspiration_id }}
                                                        </span>
                                                    </a>
                                                </h3>
                                                <p class="text-sm text-gray-500">
                                                    {{ $reply->created_at->diffForHumans() }}</p>
                                            </div>
                                            <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-md">
                                                "{{ $reply->content }}"
                                            </p>

                                            <div class="mt-2 text-right">
                                                <form action="{{ route('replies.destroy', $reply->id) }}" method="POST"
                                                    class="inline" onsubmit="return confirm('Hapus komentar ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-xs text-red-500 hover:text-red-700">Hapus
                                                        Komentar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
