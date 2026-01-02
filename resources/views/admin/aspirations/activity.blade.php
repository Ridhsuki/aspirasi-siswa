<x-app-layout>
    @section('title', 'Aktivitas Saya')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aktivitas Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-folder-open text-blue-600"></i> Riwayat Aspirasi Anda
                    </h3>

                    @if ($aspirations->isEmpty())
                        <div class="text-center py-6">
                            <p class="text-gray-500 italic mb-2">Anda belum pernah mengirimkan aspirasi.</p>
                            <a href="{{ route('aspirations.index') }}"
                                class="inline-flex items-center gap-1 text-blue-600 hover:underline font-medium">
                                <i class="fa-solid fa-pen-nib"></i> Mulai buat aspirasi
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">
                                            Tanggal
                                        </th>
                                        <th class="py-2 px-4 border-b text-left text-sm font-semibold text-gray-600">
                                            Isi Aspirasi
                                        </th>
                                        <th class="py-2 px-4 border-b text-center text-sm font-semibold text-gray-600">
                                            Balasan
                                        </th>
                                        <th class="py-2 px-4 border-b text-center text-sm font-semibold text-gray-600">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="aspContainer">
                                    @include('admin.aspirations.partials.activity_aspirations')
                                </tbody>
                            </table>
                        </div>

                        @if ($aspirations->hasMorePages())
                            <div class="mt-4 text-center">
                                <button id="loadMoreAsp"
                                    class="text-blue-600 hover:underline text-sm flex items-center justify-center gap-1 mx-auto">
                                    Muat lebih banyak aspirasi <i class="fa-solid fa-chevron-down"></i>
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4 border-b pb-2 flex items-center gap-2">
                        <i class="fa-solid fa-comments text-blue-600"></i> Riwayat Komentar Anda
                    </h3>

                    @if ($replies->isEmpty())
                        <p class="text-gray-500 italic">Anda belum pernah membalas aspirasi apapun.</p>
                    @else
                        <ul class="divide-y divide-gray-200" id="replyContainer">
                            @include('admin.aspirations.partials.activity_replies')
                        </ul>

                        @if ($replies->hasMorePages())
                            <div class="mt-4 text-center">
                                <button id="loadMoreReply" class="text-blue-600 hover:underline text-sm">
                                    Muat lebih banyak komentar &darr;
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            let aspPage = 1;
            const btnAsp = document.getElementById('loadMoreAsp');
            if (btnAsp) {
                btnAsp.addEventListener('click', function() {
                    aspPage++;
                    fetch(`?asp_page=${aspPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            if (!html.trim()) {
                                btnAsp.style.display = 'none';
                                return;
                            }
                            document.getElementById('aspContainer').insertAdjacentHTML('beforeend', html);
                        });
                });
            }

            let replyPage = 1;
            const btnReply = document.getElementById('loadMoreReply');
            if (btnReply) {
                btnReply.addEventListener('click', function() {
                    replyPage++;
                    fetch(`?reply_page=${replyPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            if (!html.trim()) {
                                btnReply.style.display = 'none';
                                return;
                            }
                            document.getElementById('replyContainer').insertAdjacentHTML('beforeend', html);
                        });
                });
            }
        </script>
    @endpush
</x-app-layout>
