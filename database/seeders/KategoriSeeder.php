<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Laptop & Komputer',
                'deskripsi' => 'Perangkat komputer portable dan stasioner untuk keperluan praktikum dan pembelajaran.',
            ],
            [
                'nama_kategori' => 'Perangkat Jaringan',
                'deskripsi' => 'Peralatan networking seperti router, switch, access point, modem, dan perangkat jaringan lainnya.',
            ],
            [
                'nama_kategori' => 'Kabel & Konektor',
                'deskripsi' => 'Kabel jaringan, kabel power, connector RJ45, dan perlengkapan kabel lainnya.',
            ],
            [
                'nama_kategori' => 'Server & Storage',
                'deskripsi' => 'Perangkat server, NAS, hard drive eksternal, dan media penyimpanan data.',
            ],
            [
                'nama_kategori' => 'Buku & Referensi',
                'deskripsi' => 'Buku panduan, modul pembelajaran, referensi pemrograman, networking, dan sistem operasi.',
            ],
            [
                'nama_kategori' => 'Peripheral & Aksesoris',
                'deskripsi' => 'Mouse, keyboard, monitor, printer, scanner, dan perangkat peripheral lainnya.',
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $kategori['nama_kategori']],
                $kategori
            );
        }
    }
}
