<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $petugasRole = Role::where('name', 'petugas')->first();
        $peminjamRole = Role::where('name', 'peminjam')->first();

        // Create Admin
        User::firstOrCreate(
            ['username' => 'admin'],
            [
                'role_id' => $adminRole->id,
                'name' => 'Administrator',
                'password' => Hash::make('adminadmin'),
            ]
        );

        // Create Petugas
        User::firstOrCreate(
            ['username' => 'petugas'],
            [
                'role_id' => $petugasRole->id,
                'name' => 'Petugas Inventaris',
                'password' => Hash::make('adminadmin'),
            ]
        );

        // Create Peminjam
        User::firstOrCreate(
            ['username' => 'peminjam'],
            [
                'role_id' => $peminjamRole->id,
                'name' => 'Peminjam',
                'password' => Hash::make('adminadmin'),
            ]
        );
    }
}
