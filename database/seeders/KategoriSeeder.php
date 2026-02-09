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
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Alat-alat elektronik seperti multimeter, solder, osiloskop, dll.',
            ],
            [
                'nama_kategori' => 'Mekanik',
                'deskripsi' => 'Alat-alat mekanik seperti kunci pas, obeng set, tang, mesin bor, dll.',
            ],
            [
                'nama_kategori' => 'Komputer',
                'deskripsi' => 'Perangkat komputer seperti laptop, keyboard, monitor, dll.',
            ],
            [
                'nama_kategori' => 'Multimedia',
                'deskripsi' => 'Peralatan multimedia seperti kamera, tripod, lighting, microphone, dll.',
            ],
            [
                'nama_kategori' => 'Laboratorium',
                'deskripsi' => 'Peralatan laboratorium seperti mikroskop, beaker, tabung reaksi, dll.',
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
