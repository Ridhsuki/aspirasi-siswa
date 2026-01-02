<x-app-layout>
    @section('title', 'Edit Siswa')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $user->name)" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="nisn" :value="__('NISN')" />
                        <x-text-input id="nisn" class="block mt-1 w-full" type="text" name="nisn"
                            :value="old('nisn', $user->nisn)" required />
                        <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="kelas" :value="__('Kelas')" />
                        <x-text-input id="kelas" class="block mt-1 w-full" type="text" name="kelas"
                            :value="old('kelas', $user->kelas)" required />
                        <x-input-error :messages="$errors->get('kelas')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="walikelas" :value="__('Wali Kelas')" />
                        <x-text-input id="walikelas" class="block mt-1 w-full" type="text" name="walikelas"
                            :value="old('walikelas', $user->walikelas)" />
                        <x-input-error :messages="$errors->get('walikelas')" class="mt-2" />
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 border rounded-md">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Ubah Password (Kosongkan jika tidak ingin
                            mengubah)</h3>

                        <div>
                            <x-input-label for="password" :value="__('Password Baru')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-secondary-button type="button" onclick="window.history.back()" class="mr-2">
                            Batal
                        </x-secondary-button>
                        <x-primary-button>
                            {{ __('Update Siswa') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
