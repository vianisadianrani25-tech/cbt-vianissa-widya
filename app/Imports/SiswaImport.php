<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name'              => $row['nama'], // Header di excel harus bernama "nama"
            'email'             => $row['email'], // Header di excel harus "email"
            'nis'               => $row['nis'] ?? null, // Header "nis"
            'password'          => Hash::make('password123'), // Password default
            'role'              => 'siswa',
            'email_verified_at' => now(),
        ]);
    }
}