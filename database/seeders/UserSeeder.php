<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@cbt.test'],
            ['name' => 'Administrator', 'password' => Hash::make('password'), 'role' => 'admin', 'email_verified_at' => now()]
        );

        User::updateOrCreate(
            ['email' => 'guru@cbt.test'],
            ['name' => 'Budi Guru', 'password' => Hash::make('password'), 'role' => 'guru', 'email_verified_at' => now()]
        );

        User::updateOrCreate(
            ['email' => 'siswa@cbt.test'],
            ['name' => 'Siti Siswa', 'password' => Hash::make('password'), 'role' => 'siswa', 'nis' => '2024001', 'email_verified_at' => now()]
        );
    }
}