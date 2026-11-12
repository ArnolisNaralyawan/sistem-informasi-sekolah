<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => $this->faker->randomElement(['admin', 'guru', 'siswa']),
            'phone' => $this->faker->phoneNumber(),
            'photo' => null,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function admin()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.test',
        ]);
    }

    public function guru()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'guru',
        ]);
    }

    public function siswa()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'siswa',
        ]);
    }
}