<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold text-blue-600">Selamat Datang, Admin!</h3>
                    <p>Ini adalah halaman khusus Admin untuk mengelola aspirasi.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
