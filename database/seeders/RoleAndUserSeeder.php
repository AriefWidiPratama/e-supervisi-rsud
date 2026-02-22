<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Nonaktifkan sementara baris ini agar tidak memicu error Spatie pada instalasi awal
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Role menggunakan bahasa Inggris
        $roleNurse = Role::create(['name' => 'Nurse']);
        $roleSupervisor = Role::create(['name' => 'Supervisor']);

        // Buat Akun Dummy Perawat
        $nurse = User::create([
            'name' => 'Ns. Budi',
            'email' => 'perawat@rsud.com',
            'password' => Hash::make('password'), 
        ]);
        $nurse->assignRole($roleNurse);

        // Buat Akun Dummy Supervisor (Ketua Peneliti)
        $supervisor = User::create([
            'name' => 'Ns. Wiwiek Delvira',
            'email' => 'supervisor@rsud.com',
            'password' => Hash::make('password'), 
        ]);
        $supervisor->assignRole($roleSupervisor);
    }
}