<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $petugasRole = Role::firstOrCreate(['name' => 'petugas']);
        $peminjamRole = Role::firstOrCreate(['name' => 'peminjam']);

        // Create Admin
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'role_id' => $adminRole->id,
                'name' => 'Administrator',
                'email' => 'rasyadrasyad111@gmail.com',
                'nomor_telepon' => '081234567890',
                'password' => Hash::make('adminadmin'),
                'two_fa_enabled' => true,
            ]
        );

        // Create Petugas
        User::firstOrCreate(
            ['username' => 'petugas'],
            [
                'role_id' => $petugasRole->id,
                'name' => 'Petugas Inventaris',
                'email' => 'petugas@sijamat.local',
                'nomor_telepon' => '081234567891',
                'password' => Hash::make('adminadmin'),
                'two_fa_enabled' => true,
            ]
        );

        // Create Peminjam
        User::firstOrCreate(
            ['username' => 'peminjam'],
            [
                'role_id' => $peminjamRole->id,
                'name' => 'Peminjam',
                'email' => 'peminjam@sijamat.local',
                'nomor_telepon' => '081234567892',
                'password' => Hash::make('adminadmin'),
                'two_fa_enabled' => false,
            ]
        );
    }
}
