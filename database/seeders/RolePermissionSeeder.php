<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat daftar permission
        $permissions = [
            'kelola-soal',
            'kelola-ujian',
            'kelola-pengguna',
            'lihat-hasil-ujian',
            'kerjakan-ujian',
            'export-laporan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Buat role dan assign permission-nya
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $guruRole = Role::firstOrCreate(['name' => 'guru']);
        $guruRole->givePermissionTo(['kelola-soal', 'kelola-ujian', 'lihat-hasil-ujian', 'export-laporan']);

        $siswaRole = Role::firstOrCreate(['name' => 'siswa']);
        $siswaRole->givePermissionTo(['kerjakan-ujian']);

        // 3. Assign Role ke User yang sudah ada dari UserSeeder (Pertemuan 2)
        $adminUser = User::where('email', 'admin@cbt.test')->first();
        if ($adminUser) $adminUser->assignRole('admin');

        $guruUser = User::where('email', 'guru@cbt.test')->first();
        if ($guruUser) $guruUser->assignRole('guru');

        $siswaUser = User::where('email', 'siswa@cbt.test')->first();
        if ($siswaUser) $siswaUser->assignRole('siswa');
    }
}
