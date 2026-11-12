<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (Setting::query()->exists()) {
            $this->command->info('Pengaturan website sudah ada, dilewati.');
            return;
        }

        // Default = data yang tampil saat ini di landing page
        Setting::create([
            'nama_sekolah' => 'SMAN 17 Maluku Tengah',
            'nama_singkat' => 'SMAN 17',
            'motto' => 'MALUKU TENGAH',
            'logo' => 'photos/logosma.png',
            'alamat' => 'Jln. Haji Adam Malik - Waipia, Kec. Teo Nila Serua, Maluku Tengah. 97558',
            'telepon' => '+62 821-2079-3392 (operator)',
            'email' => 'sman17malteng@gmail.com',
            'instagram' => 'osiss_sman17',
        ]);

        $this->command->info('Pengaturan website default dibuat.');
    }
}
