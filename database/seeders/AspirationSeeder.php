<?php

namespace Database\Seeders;

use App\Models\Aspiration;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class AspirationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'user')->get();

        $admins = User::where('role', 'admin')
            ->where('email', '!=', 'dev@ridhsuki.my.id')
            ->get();

        if ($students->count() == 0) {
            $this->command->info('Harap jalankan DatabaseSeeder (User data) terlebih dahulu.');
            return;
        }

        $aspirasiContents = [
            "AC di kelas XII IPA 2 mati total, panas banget pak kalau siang. Tolong segera diperbaiki.",
            "Wifi di perpustakaan sering putus nyambung, susah buat kami cari referensi belajar.",
            "Mohon untuk kantin diperluas area duduknya, sering nggak kebagian tempat pas istirahat.",
            "Toilet cowok di lantai 2 kran airnya patah, jadi air ngalir terus terbuang.",
            "Adain turnamen E-Sport (Mobile Legends/PUBG) dong pas classmeeting nanti!",
            "Harga gorengan di kantin kok naik terus ya? Uang jajan jadi cepet habis.",
            "Lapangan basket licin banget kalau habis hujan, bahaya buat yang ekskul sore.",
            "Musholla mukenanya tolong dicuci rutin seminggu sekali, baunya agak apek.",
            "Parkiran motor siswa makin sempit karena banyak motor yang parkir sembarangan. Mohon ditertibkan.",
            "Ekskul Fotografi kapan dibuka pendaftarannya? Banyak yang minat nih.",
            "Pak Satpam gerbang depan galak banget kalau telat baru 1 menit, tolong lebih humanis.",
            "Usul dong, adain event jejepangan atau cosplay pas ulang tahun sekolah.",
            "Sampah di belakang sekolah numpuk dan belum diangkut, baunya sampai ke kelas X-3.",
            "Sound system pas upacara sering kresek-kresek, suara pembina upacara jadi gak jelas.",
            "Koleksi novel di perpustakaan tolong ditambah yang update dong, jangan buku lama terus.",
            "Lampu di lorong menuju lab komputer sering kedap-kedip horor.",
            "Jam istirahat tolong ditambah 10 menit, antre di kantin aja udah makan waktu 15 menit."
        ];

        $studentReplies = [
            "Setuju banget! Valid no debat.",
            "Iya nih, bener banget, ngerasain juga.",
            "Up up up! Semoga didengar OSIS.",
            "Wkwkwk kirain cuma gue doang yang ngerasa.",
            "Gas lah, dukung 100%!",
            "Wah parah sih kalau ini belum dibenerin.",
            "Bantu up gan.",
            "Kemarin udah lapor pak Sarpras katanya mau dicek."
        ];

        $adminReplies = [
            "Terima kasih atas masukannya, akan segera kami sampaikan ke Wakasek Sarpras.",
            "Halo, aspirasi kamu sudah kami tampung dan akan dibahas di rapat OSIS.",
            "Terima kasih laporannya. Tim teknisi akan mengecek lokasi besok pagi.",
            "Mohon bersabar ya, sedang dalam proses pengajuan anggaran.",
            "Terima kasih aspirasinya. Jangan lupa jaga kebersihan fasilitas bersama ya."
        ];

        foreach ($aspirasiContents as $content) {

            $user = $students->random();
            $isAnonymous = rand(0, 1) == 1;

            $aspiration = Aspiration::create([
                'user_id' => $user->id,
                'content' => $content,
                'status' => Arr::random(['pending', 'pending', 'closed', 'resolved']),
                'is_anonymous' => $isAnonymous,
                'created_at' => now()->subDays(rand(0, 7))->subHours(rand(1, 24)),
            ]);

            $replyCount = rand(0, 5);

            for ($i = 0; $i < $replyCount; $i++) {

                $hasAdmin = $admins->count() > 0;
                $isReplyByAdmin = ($hasAdmin && rand(1, 10) > 8);

                if ($isReplyByAdmin) {
                    $replier = $admins->random();
                    $replyContent = Arr::random($adminReplies);
                    $replyAnonymous = false;
                } else {
                    $replier = $students->random();
                    $replyContent = Arr::random($studentReplies);
                    $replyAnonymous = rand(0, 1) == 1;
                }

                Reply::create([
                    'user_id' => $replier->id,
                    'aspiration_id' => $aspiration->id,
                    'content' => $replyContent,
                    'is_anonymous' => $replyAnonymous,
                    'created_at' => $aspiration->created_at->addMinutes(rand(10, 300)),
                ]);
            }
        }
    }
}
