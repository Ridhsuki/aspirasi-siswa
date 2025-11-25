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
            'nisn' => null,
            'kelas' => null,
            'walikelas' => null,
        ]);

        User::create([
            'name' => 'Student A',
            'email' => null,
            'nisn' => '0051234567',
            'role' => 'user',
            'kelas' => 'XII IPA 1',
            'walikelas' => 'Bapak Joko Widodo, S.Pd',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Student B',
            'email' => 'siti@gmail.com',
            'nisn' => '0051234568',
            'role' => 'user',
            'kelas' => 'XI IPS 2',
            'walikelas' => 'Ibu Mega Kusuma, S.Pd',
            'password' => Hash::make('password'),
        ]);
    }
}
