<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin OSIS',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'nisn' => '081248465639',
            'kelas' => 'admin',
            'walikelas' => null,
        ]);

        User::create([
            'name' => 'Ridhsuki Dev',
            'email' => 'dev@ridhsuki.my.id',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'nisn' => null,
            'kelas' => 'admin',
            'walikelas' => null,
        ]);

        $dataSiswa = [
            '0051234567' => [
                'nama' => 'Willz',
                'kelas' => 'XI',
                'walikelas' => 'bu agus kenyang bu, S.Pd'
            ],
            '0051234568' => [
                'nama' => 'Siti Aisyah Ramadhani',
                'kelas' => 'XI IPS 2',
                'walikelas' => 'Bapak Joko Widodo, S.Pd'
            ],
            '0051234569' => [
                'nama' => 'Budi Santoso',
                'kelas' => 'X MIPA 3',
                'walikelas' => 'Ibu Mega Kusuma, S.Pd'
            ],
            '0051234570' => [
                'nama' => 'Dewi Lestari',
                'kelas' => 'XII IPS 1',
                'walikelas' => 'Bapak Ahmad Yani, S.Pd'
            ],
            '0051234571' => [
                'nama' => 'Fajar Ramadhan',
                'kelas' => 'XI IPA 2',
                'walikelas' => 'Ibu Rina Kartika, S.Pd'
            ]
        ];

        foreach ($dataSiswa as $nisn => $data) {
            User::create([
                'name' => $data['nama'],
                'email' => null,
                'role' => 'user',
                'password' => Hash::make('password'),
                'nisn' => $nisn,
                'kelas' => $data['kelas'],
                'walikelas' => $data['walikelas'],
            ]);
        }

        $this->call([
            AspirationSeeder::class,
        ]);
    }
}
