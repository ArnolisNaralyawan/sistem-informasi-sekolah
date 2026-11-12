<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class KontenBerandaSeeder extends Seeder
{
    public function run(): void
    {
        $setting = Setting::get();
        $data = [
            'kepsek_nama' => $setting->kepsek_nama ?: null, // null = placeholder ikon di landing
            'visi' => $setting->visi ?: '"MENJADI SEKOLAH UNGGUL DAN BERDAYA SAING MELALUI PEMBELAJARAN MENDALAM"',
            'misi' => $setting->misi ?: implode("\n", [
                'Menginternalisasi nilai-nilai pancasila yang beriman, bertaqwa dan berakhlak mulia',
                'Menerapkan ketrampilan berpikir kritis, kreatif, dan kolaboratif melalui pembelajaran berbasis proyek dan pengalaman nyata',
                'Mengembangkan potensi peserta didik secara optimal melalui pembelajaran yang berpusat pada peserta didik',
                'Mendorong inovasi dan kreativitas peserta didik dalam menyelesaikan masalah nyata dan kontribusi terhadap lingkungan sekitar',
                'Mewujudkan lingkungan belajar yang inklusif, aman, dan menyenangkan',
                'Membangun kemitraan yang sinergis antara sekolah, keluarga, dan masyarakat',
            ]),
            'stats' => $setting->stats ?: [
                'siswa' => ['nilai' => '550', 'suffix' => '+', 'label' => 'Siswa Aktif', 'ikon' => 'users'],
                'guru' => ['nilai' => '45', 'suffix' => '+', 'label' => 'Guru Berkualifikasi', 'ikon' => 'chalkboard-user'],
                'rombel' => ['nilai' => '18', 'suffix' => '', 'label' => 'Rombongan Belajar', 'ikon' => 'book-open'],
                'kelulusan' => ['nilai' => '98', 'suffix' => '%', 'label' => 'Tingkat Kelulusan', 'ikon' => 'graduation-cap'],
            ],
        ];
        $setting->update($data);

        if (Fasilitas::query()->exists()) {
            $this->command->info('Fasilitas sudah ada, dilewati.');
        } else {
            $items = [
                ['nama' => 'Lab Sains', 'deskripsi' => 'Laboratorium lengkap untuk eksperimen sains yang mendalam.', 'poin' => "Laboratorium Fisika\nLaboratorium Kimia\nLaboratorium Biologi", 'ikon' => 'fa-microscope', 'urutan' => 1],
                ['nama' => 'Lab Komputer', 'deskripsi' => 'Teknologi terkini untuk pembelajaran digital yang menempel.', 'poin' => "15 Unit Komputer\nInternet High-Speed\nSoftware Pendidikan", 'ikon' => 'fa-laptop-code', 'urutan' => 2],
                ['nama' => 'Perpustakaan', 'deskripsi' => 'Koleksi buku lengkap dan ruang baca yang nyaman.', 'poin' => "10.000+ Koleksi Buku\nRuang Baca Nyaman\nSistem Digital", 'ikon' => 'fa-book-open', 'urutan' => 3],
                ['nama' => 'Lapangan Olahraga', 'deskripsi' => null, 'poin' => null, 'ikon' => 'fa-basketball-ball', 'urutan' => 1],
                ['nama' => 'Kantin Sehat', 'deskripsi' => null, 'poin' => null, 'ikon' => 'fa-utensils', 'urutan' => 2],
                ['nama' => 'WiFi Area', 'deskripsi' => null, 'poin' => null, 'ikon' => 'fa-wifi', 'urutan' => 3],
                ['nama' => 'Keamanan 24/7', 'deskripsi' => null, 'poin' => null, 'ikon' => 'fa-shield-halved', 'urutan' => 4],
            ];
            foreach ($items as $item) {
                Fasilitas::create($item);
            }
            $this->command->info('7 fasilitas default dibuat.');
        }
    }
}
