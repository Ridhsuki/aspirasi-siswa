<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Aspirasi') }}
            </h2>
            <a href="{{ route('admin.aspirations.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md text-sm hover:bg-gray-300">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4"
                            style="background: {{ $aspiration->is_anonymous ? '#9ca3af' : 'linear-gradient(45deg, #334EAC, #F7CE3E)' }}">
                            {{ substr($aspiration->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-lg text-gray-800">
                                {{ $aspiration->user->name }}
                                @if ($aspiration->is_anonymous)
                                    <span class="text-xs font-normal text-gray-500 ml-1">(Anonim di Publik)</span>
                                @endif
                            </h3>
                            <div class="text-sm text-gray-500">
                                {{ $aspiration->created_at->isoFormat('D MMMM Y, HH:mm') }} &bull;
                                {{ $aspiration->user->kelas ?? 'Siswa' }}
                            </div>
                        </div>
                    </div>

                    <div>
                        @if ($aspiration->status == 'pending')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">⏳
                                Pending</span>
                        @elseif($aspiration->status == 'resolved')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">✅
                                Resolved</span>
                        @elseif($aspiration->status == 'closed')
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">🔒
                                Closed</span>
                        @endif
                    </div>
                </div>

                <div class="prose max-w-none text-gray-800 mb-6 whitespace-pre-line border-b pb-6">
                    {{ $aspiration->content }}
                </div>

                <div class="flex justify-end gap-3">
                    <form action="{{ route('admin.aspirations.update-status', $aspiration->id) }}" method="POST"
                        class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <label class="text-sm text-gray-600">Ubah Status:</label>
                        <select name="status" onchange="this.form.submit()"
                            class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="pending" {{ $aspiration->status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="resolved" {{ $aspiration->status == 'resolved' ? 'selected' : '' }}>Resolved
                            </option>
                            <option value="closed" {{ $aspiration->status == 'closed' ? 'selected' : '' }}>Closed
                            </option>
                        </select>
                    </form>

                    <form action="{{ route('admin.aspirations.destroy', $aspiration->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus seluruh aspirasi ini beserta balasannya?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700 transition">
                            Hapus Aspirasi
                        </button>
                    </form>
                </div>
            </div>

            <h3 class="text-lg font-bold text-gray-700 mb-4 ml-2">Balasan ({{ $aspiration->replies->count() }})</h3>

            <div class="space-y-4">
                @forelse ($aspiration->replies as $reply)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 border-l-4 border-blue-500">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center mb-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3"
                                    style="background: {{ $reply->is_anonymous ? '#9ca3af' : '#7096D1' }}">
                                    {{ substr($reply->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm text-gray-800">
                                        {{ $reply->user->name }}
                                        @if ($reply->is_anonymous)
                                            <span class="text-xs font-normal text-gray-500">(Anonim)</span>
                                        @endif
                                        @if ($reply->user->role === 'admin')
                                            <span
                                                class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full ml-1">Admin</span>
                                        @endif
                                    </h4>
                                    <div class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-700 text-sm pl-11">
                            {{ $reply->content }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500 bg-white rounded-lg shadow-sm">
                        Belum ada balasan pada aspirasi ini.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
