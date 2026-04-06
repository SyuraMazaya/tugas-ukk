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
        $laptop = Kategori::where('nama_kategori', 'Laptop & Komputer')->first();
        $jaringan = Kategori::where('nama_kategori', 'Perangkat Jaringan')->first();
        $kabel = Kategori::where('nama_kategori', 'Kabel & Konektor')->first();
        $server = Kategori::where('nama_kategori', 'Server & Storage')->first();
        $buku = Kategori::where('nama_kategori', 'Buku & Referensi')->first();
        $peripheral = Kategori::where('nama_kategori', 'Peripheral & Aksesoris')->first();

        $alatList = [
            // Laptop & Komputer
            [
                'kategori_id' => $laptop->id_kategori,
                'nama_alat' => 'Laptop ASUS ROG Gaming',
                'kode_alat' => 'LPT-001',
                'stok' => 8,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $laptop->id_kategori,
                'nama_alat' => 'Laptop Lenovo ThinkPad',
                'kode_alat' => 'LPT-002',
                'stok' => 10,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $laptop->id_kategori,
                'nama_alat' => 'Laptop Dell Inspiron',
                'kode_alat' => 'LPT-003',
                'stok' => 12,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $laptop->id_kategori,
                'nama_alat' => 'PC Desktop Gaming',
                'kode_alat' => 'DES-001',
                'stok' => 5,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $laptop->id_kategori,
                'nama_alat' => 'PC Server Workstation',
                'kode_alat' => 'DES-002',
                'stok' => 3,
                'kondisi' => 'baik',
            ],
            // Perangkat Jaringan
            [
                'kategori_id' => $jaringan->id_kategori,
                'nama_alat' => 'Router Cisco 2900XL',
                'kode_alat' => 'RTR-001',
                'stok' => 4,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $jaringan->id_kategori,
                'nama_alat' => 'Network Switch 24 Port',
                'kode_alat' => 'SWH-001',
                'stok' => 6,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $jaringan->id_kategori,
                'nama_alat' => 'Access Point TP-Link',
                'kode_alat' => 'ACP-001',
                'stok' => 8,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $jaringan->id_kategori,
                'nama_alat' => 'Modem VDSL Huawei',
                'kode_alat' => 'MDM-001',
                'stok' => 3,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $jaringan->id_kategori,
                'nama_alat' => 'Firewall Mikrotik',
                'kode_alat' => 'FWL-001',
                'stok' => 2,
                'kondisi' => 'baik',
            ],
            // Kabel & Konektor
            [
                'kategori_id' => $kabel->id_kategori,
                'nama_alat' => 'Kabel Ethernet Cat6 (30m)',
                'kode_alat' => 'KBL-001',
                'stok' => 50,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $kabel->id_kategori,
                'nama_alat' => 'Kabel Ethernet Cat5e (50m)',
                'kode_alat' => 'KBL-002',
                'stok' => 40,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $kabel->id_kategori,
                'nama_alat' => 'RJ45 Connector',
                'kode_alat' => 'KNK-001',
                'stok' => 200,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $kabel->id_kategori,
                'nama_alat' => 'Kabel Power Supply PSU',
                'kode_alat' => 'KBL-003',
                'stok' => 25,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $kabel->id_kategori,
                'nama_alat' => 'Fiber Optic Cable (100m)',
                'kode_alat' => 'FBR-001',
                'stok' => 10,
                'kondisi' => 'baik',
            ],
            // Server & Storage
            [
                'kategori_id' => $server->id_kategori,
                'nama_alat' => 'NAS Synology 4 Bay',
                'kode_alat' => 'NAS-001',
                'stok' => 2,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $server->id_kategori,
                'nama_alat' => 'Hard Drive External 2TB',
                'kode_alat' => 'HDD-001',
                'stok' => 15,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $server->id_kategori,
                'nama_alat' => 'Server Tower IBM Power',
                'kode_alat' => 'SRV-001',
                'stok' => 1,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $server->id_kategori,
                'nama_alat' => 'SSD Samsung 1TB',
                'kode_alat' => 'SSD-001',
                'stok' => 20,
                'kondisi' => 'baik',
            ],
            // Buku & Referensi
            [
                'kategori_id' => $buku->id_kategori,
                'nama_alat' => 'Buku Cisco CCNA Routing & Switching',
                'kode_alat' => 'BKU-001',
                'stok' => 5,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $buku->id_kategori,
                'nama_alat' => 'Buku CompTIA Network+',
                'kode_alat' => 'BKU-002',
                'stok' => 5,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $buku->id_kategori,
                'nama_alat' => 'Buku Linux Administration Handbook',
                'kode_alat' => 'BKU-003',
                'stok' => 4,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $buku->id_kategori,
                'nama_alat' => 'Modul Jaringan Komputer PPLG',
                'kode_alat' => 'BKU-004',
                'stok' => 20,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $buku->id_kategori,
                'nama_alat' => 'Buku Pemrograman Java Enterprise',
                'kode_alat' => 'BKU-005',
                'stok' => 6,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $buku->id_kategori,
                'nama_alat' => 'Buku Database Management System',
                'kode_alat' => 'BKU-006',
                'stok' => 5,
                'kondisi' => 'baik',
            ],
            // Peripheral & Aksesoris
            [
                'kategori_id' => $peripheral->id_kategori,
                'nama_alat' => 'Monitor LED 24 inch',
                'kode_alat' => 'MNT-001',
                'stok' => 15,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $peripheral->id_kategori,
                'nama_alat' => 'Keyboard Mekanik RGB',
                'kode_alat' => 'KBD-001',
                'stok' => 12,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $peripheral->id_kategori,
                'nama_alat' => 'Mouse Gaming Wireless',
                'kode_alat' => 'MUS-001',
                'stok' => 20,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $peripheral->id_kategori,
                'nama_alat' => 'Printer HP LaserJet',
                'kode_alat' => 'PRT-001',
                'stok' => 3,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $peripheral->id_kategori,
                'nama_alat' => 'Scanner Canon flatbed',
                'kode_alat' => 'SCN-001',
                'stok' => 2,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $peripheral->id_kategori,
                'nama_alat' => 'Webkamera Logitech HD',
                'kode_alat' => 'WBC-001',
                'stok' => 8,
                'kondisi' => 'baik',
            ],
            [
                'kategori_id' => $peripheral->id_kategori,
                'nama_alat' => 'Headset Gaming Wireless',
                'kode_alat' => 'HDS-001',
                'stok' => 10,
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
