<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin Sekolah',
            'email' => 'arnolnaral@gmail.com',
            'password' => 'password', // otomatis ter-hash oleh cast 'hashed' di model User
            'role' => 'admin',
        ]);

        // Pengaturan website
        $this->call(SiteSettingSeeder::class);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Login: arnolnaral@gmail.com / password');
    }
}
