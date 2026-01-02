<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Admin') }}
            </h2>

            <a href="{{ route('aspirations.index') }}" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm gap-2">
                <span>Lihat Website Aspirasi</span>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <i class="fa-solid fa-users text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Siswa</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalStudents }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                            <i class="fa-solid fa-comments text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Aspirasi</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $totalAspirations }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                            <i class="fa-solid fa-hourglass-half text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Perlu Tindakan</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $pendingCount }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                            <i class="fa-solid fa-check-circle text-2xl"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Masalah Selesai</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $resolvedCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4"><i class="fa-solid fa-chart-line"></i> Statistik
                        Aspirasi Bulanan ({{ date('Y') }})</h3>
                    <div class="relative h-64 w-full">
                        <canvas id="aspirationsChart"></canvas>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Aspirasi Terbaru</h3>
                        <a href="{{ route('admin.aspirations.index') }}"
                            class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                    </div>

                    @if ($latestAspirations->isEmpty())
                        <p class="text-gray-500 text-sm">Belum ada aspirasi masuk.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($latestAspirations as $asp)
                                <li class="border-b pb-3 last:border-0 last:pb-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <span
                                                class="text-xs font-semibold {{ $asp->status == 'pending' ? 'text-yellow-600 bg-yellow-100' : 'text-blue-600 bg-blue-100' }} px-2 py-0.5 rounded">
                                                {{ ucfirst($asp->status) }}
                                            </span>
                                            <span
                                                class="text-xs text-gray-400 ml-2">{{ $asp->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-800 mt-1 line-clamp-2">{{ $asp->content }}</p>
                                    <div class="mt-1 text-xs text-gray-500">
                                        Oleh: {{ $asp->is_anonymous ? 'Anonim' : $asp->user->name }}
                                    </div>
                                    <div class="mt-2 text-right">
                                        <a href="{{ route('admin.aspirations.show', $asp->id) }}"
                                            class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 px-2 py-1 rounded transition">
                                            Tanggapi &rarr;
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <div
                class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg shadow-lg p-6 text-white flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold mb-1">Kelola Sekolah Lebih Efisien</h3>
                    <p class="text-blue-100 text-sm">Akses menu manajemen siswa dan laporan dengan cepat.</p>
                </div>
                <div class="mt-4 md:mt-0 flex gap-3">
                    <a href="{{ route('admin.users.create') }}"
                        class="bg-white text-blue-600 font-bold py-2 px-4 rounded shadow hover:bg-gray-100 transition flex items-center gap-2">
                        <i class="fa-solid fa-user-plus"></i> Tambah Siswa
                    </a>
                    <a href="{{ route('admin.aspirations.index') }}"
                        class="bg-blue-800 text-white font-bold py-2 px-4 rounded shadow hover:bg-blue-900 transition flex items-center gap-2 border border-blue-500">
                        <i class="fa-solid fa-list-check"></i> Kelola Aspirasi
                    </a>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('aspirationsChart');
            const chartData = @json($chartData);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jumlah Aspirasi Masuk',
                        data: chartData,
                        borderWidth: 2,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#3b82f6',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
