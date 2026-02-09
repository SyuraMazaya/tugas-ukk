<?php

namespace Database\Seeders;

use App\Models\Denda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Denda::firstOrCreate(
            ['nama_denda' => 'Denda Keterlambatan Pengembalian'],
            [
                'deskripsi' => 'Denda yang dikenakan untuk setiap hari keterlambatan pengembalian barang peminjaman',
                'jumlah_denda' => 1000,
                'is_active' => true,
            ]
        );
    }
}
