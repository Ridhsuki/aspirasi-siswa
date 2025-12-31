<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat datang! Silakan gunakan menu Aspirasi untuk menyampaikan pendapat, atau cek 'Aktivitas Saya' di menu profil untuk melihat riwayat Anda.") }}
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <x-primary-button class="mt-4" onclick="window.location='{{ route('aspirations.index') }}'">
                {{ __('Buat Aspirasi Baru') }}
            </x-primary-button>
        </div>
    </div>
</x-app-layout>
