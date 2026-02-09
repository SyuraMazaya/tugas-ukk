<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $elektronik = Kategori::where('nama_kategori', 'Elektronik')->first();
        $mekanik = Kategori::where('nama_kategori', 'Mekanik')->first();
        $komputer = Kategori::where('nama_kategori', 'Komputer')->first();
        $multimedia = Kategori::where('nama_kategori', 'Multimedia')->first();
        $lab = Kategori::where('nama_kategori', 'Laboratorium')->first();

        $alatList = [
            // Elektronik
            [
                'kategori_id' => $elektronik->id_kategori,
                'nama_alat' => 'Multimeter Digital',
                'kode_alat' => 'ELK-001',
                'stok' => 10,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $elektronik->id_kategori,
                'nama_alat' => 'Solder Station',
                'kode_alat' => 'ELK-002',
                'stok' => 8,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $elektronik->id_kategori,
                'nama_alat' => 'Osiloskop',
                'kode_alat' => 'ELK-003',
                'stok' => 5,
                'kondisi' => 'baik',
            ],
            // Mekanik
            [
                'kategori_id' => $mekanik->id_kategori,
                'nama_alat' => 'Kunci Ring Pas Set',
                'kode_alat' => 'MKN-001',
                'stok' => 15,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $mekanik->id_kategori,
                'nama_alat' => 'Mesin Bor Tangan',
                'kode_alat' => 'MKN-002',
                'stok' => 6,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $mekanik->id_kategori,
                'nama_alat' => 'Obeng Set',
                'kode_alat' => 'MKN-003',
                'stok' => 20,
                'kondisi' => 'baik',
            ],
            // Komputer
            [
                'kategori_id' => $komputer->id_kategori,
                'nama_alat' => 'Laptop Asus',
                'kode_alat' => 'KMP-001',
                'stok' => 10,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $komputer->id_kategori,
                'nama_alat' => 'Mouse Wireless',
                'kode_alat' => 'KMP-002',
                'stok' => 25,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $komputer->id_kategori,
                'nama_alat' => 'Keyboard External',
                'kode_alat' => 'KMP-003',
                'stok' => 15,
                'kondisi' => 'rusak_ringan',
            ],
            // Multimedia
            [
                'kategori_id' => $multimedia->id_kategori,
                'nama_alat' => 'Kamera DSLR Canon',
                'kode_alat' => 'MED-001',
                'stok' => 5,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $multimedia->id_kategori,
                'nama_alat' => 'Tripod Kamera',
                'kode_alat' => 'MED-002',
                'stok' => 8,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $multimedia->id_kategori,
                'nama_alat' => 'Microphone Wireless',
                'kode_alat' => 'MED-003',
                'stok' => 10,
                'kondisi' => 'baik',
            ],
            // Laboratorium
            [
                'kategori_id' => $lab->id_kategori,
                'nama_alat' => 'Mikroskop',
                'kode_alat' => 'LAB-001',
                'stok' => 12,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $lab->id_kategori,
                'nama_alat' => 'Beaker Set',
                'kode_alat' => 'LAB-002',
                'stok' => 30,
                'kondisi' => 'baik',
            ],
        ];

        foreach ($alatList as $alat) {
            Alat::firstOrCreate(
                ['kode_alat' => $alat['kode_alat']],
                $alat
            );
        }
    }
}
