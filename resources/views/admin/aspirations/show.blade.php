<x-app-layout>
    @section('title', 'Detail Aspirasi')
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                {{ __('Detail Aspirasi') }}
            </h2>
            <div class="flex flex-wrap gap-2 w-full sm:w-auto">
                <a href="{{ route('aspirations.show', $aspiration->id) }}" target="_blank"
                    class="flex-1 sm:flex-none justify-center px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2 shadow-sm">
                    <span>Lihat di Web</span>
                    <i class="fa-solid fa-up-right-from-square"></i>
                </a>

                <a href="{{ route('admin.aspirations.index') }}"
                    class="flex-1 sm:flex-none justify-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div
                    class="p-6 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-start gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-sm ring-2 ring-white"
                            style="background: {{ $aspiration->is_anonymous ? '#9ca3af' : 'linear-gradient(135deg, #334EAC, #F7CE3E)' }}">
                            @if ($aspiration->is_anonymous)
                                <i class="fa-solid fa-user-secret"></i>
                            @else
                                {{ substr($aspiration->user->name, 0, 1) }}
                            @endif
                        </div>

                        <div>
                            <h3 class="font-bold text-lg text-gray-900 flex items-center gap-2">
                                {{ $aspiration->user->name }}
                                @if ($aspiration->is_anonymous)
                                    <span
                                        class="px-2 py-0.5 rounded text-xs font-normal bg-gray-200 text-gray-600 flex items-center gap-1">
                                        <i class="fa-solid fa-mask"></i> Anonim
                                    </span>
                                @endif
                            </h3>
                            <div class="text-sm text-gray-500 flex flex-wrap gap-2 items-center mt-1">
                                <span class="flex items-center gap-1">
                                    <i class="fa-regular fa-calendar"></i>
                                    {{ $aspiration->created_at->isoFormat('D MMMM Y, HH:mm') }}
                                </span>
                                <span class="hidden sm:inline">&bull;</span>
                                <span
                                    class="flex items-center gap-1 text-blue-600 bg-blue-50 px-2 py-0.5 rounded text-xs font-medium">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    {{ $aspiration->user->kelas ?? 'Siswa' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
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
                    </div>
                </div>

                <div class="p-6">
                    <div class="prose max-w-none text-gray-800 whitespace-pre-line text-base leading-relaxed">
                        {{ $aspiration->content }}
                    </div>
                </div>

                <div
                    class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">

                    <form action="{{ route('admin.aspirations.update-status', $aspiration->id) }}" method="POST"
                        class="flex items-center gap-3 w-full sm:w-auto p-1 bg-white border border-gray-300 rounded-lg shadow-sm">
                        @csrf
                        @method('PATCH')
                        <div class="pl-3 text-gray-500">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </div>
                        <select name="status" onchange="this.form.submit()"
                            class="appearance-none border border-gray-300 rounded-lg px-4 py-2 bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full sm:w-40 cursor-pointer shadow-sm transition-all hover:bg-gray-50">
                            <option value="pending" {{ $aspiration->status == 'pending' ? 'selected' : '' }}>Set:
                                Pending</option>
                            <option value="resolved" {{ $aspiration->status == 'resolved' ? 'selected' : '' }}>Set:
                                Resolved</option>
                            <option value="closed" {{ $aspiration->status == 'closed' ? 'selected' : '' }}>Set: Closed
                            </option>
                        </select>
                    </form>

                    <form action="{{ route('admin.aspirations.destroy', $aspiration->id) }}" method="POST"
                        class="w-full sm:w-auto delete-confirm"
                        data-confirm-text="Aspirasi ini beserta seluruh balasannya akan dihapus permanen!">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-red-200 text-red-600 rounded-lg text-sm font-medium hover:bg-red-50 hover:border-red-300 transition shadow-sm">
                            <i class="fa-solid fa-trash-can"></i>
                            Hapus Aspirasi
                        </button>
                    </form>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2 ml-1">
                    <i class="fa-regular fa-comments text-blue-600"></i>
                    Balasan
                    <span
                        class="bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded-full">{{ $aspiration->replies->count() }}</span>
                </h3>

                <div class="space-y-4">
                    @forelse ($aspiration->replies as $reply)
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-5 border border-gray-100 relative group">
                            <div
                                class="absolute left-0 top-0 bottom-0 w-1 {{ $reply->user->role === 'admin' ? 'bg-blue-600' : 'bg-gray-300' }}">
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-sm"
                                        style="background: {{ $reply->is_anonymous ? '#9ca3af' : ($reply->user->role === 'admin' ? '#334EAC' : '#7096D1') }}">
                                        @if ($reply->is_anonymous)
                                            <i class="fa-solid fa-user-secret"></i>
                                        @else
                                            {{ substr($reply->user->name, 0, 1) }}
                                        @endif
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <div class="flex flex-wrap justify-between items-start mb-2">
                                        <div class="flex flex-col">
                                            <h4 class="font-bold text-sm text-gray-900 flex items-center gap-2">
                                                {{ $reply->user->name }}
                                                @if ($reply->user->role === 'admin')
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full font-bold flex items-center gap-1">
                                                        <i class="fa-solid fa-shield-halved"></i> Admin
                                                    </span>
                                                @elseif($reply->is_anonymous)
                                                    <span class="text-gray-400 text-xs font-normal"><i
                                                            class="fa-solid fa-mask"></i> Anonim</span>
                                                @endif
                                            </h4>
                                            <span class="text-xs text-gray-400 mt-0.5">
                                                <i class="fa-regular fa-clock mr-1"></i>
                                                {{ $reply->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>

                                    <div
                                        class="text-gray-700 text-sm leading-relaxed bg-gray-50 p-3 rounded-lg border border-gray-100">
                                        {{ $reply->content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 bg-white rounded-xl border border-dashed border-gray-300">
                            <div
                                class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-300">
                                <i class="fa-regular fa-comment-dots text-3xl"></i>
                            </div>
                            <p class="text-gray-500 font-medium">Belum ada balasan.</p>
                            <p class="text-sm text-gray-400">Jadilah yang pertama menanggapi aspirasi ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
