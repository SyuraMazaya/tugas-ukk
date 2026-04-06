# Dokumentasi Test Case Sistem Peminjaman Alat TugasUKK-Naura

## Ringkasan Test Case

**Total Test Case: 54**

| Module | Jumlah Test |
|--------|-------------|
| Autentikasi | 5 |
| Kelola Pengguna | 6 |
| Kelola Kategori | 5 |
| Kelola Alat | 6 |
| Peminjaman | 10 |
| Pengembalian | 5 |
| Denda | 6 |
| Laporan | 5 |
| Log Aktivitas | 2 |
| **TOTAL** | **54** |

---

## Tabel Test Case Lengkap

| No. | ID Tes | Modul | Skenario Pengujian | Langkah-langkah | Data Uji (Jika Perlu) | Hasil yang Diharapkan | Hasil Aktual (Lulus/Gagal) |
|-----|--------|-------|---------------------|-----------------|----------------------|----------------------|--------------------------|
| 1 | AUTH-001 | Autentikasi | Gagal - Akses Halaman Terproteksi | 1. Logout dari sistem. 2. Coba akses URL /admin secara manual. | - | Pengguna dialihkan (redirect) ke halaman /login | |
| 2 | AUTH-002 | Autentikasi | Gagal - Login (Password Salah) | 1. Buka /login 2. Masukkan username yang benar 3. Masukkan password yang salah | Username: admin Password: AdminSalah | Login gagal. Muncul pesan "Login Gagal, User" | |
| 3 | AUTH-003 | Autentikasi | Sukses - Login (Admin) | 1. Buka /login 2. Masukkan Username dan Password admin yang benar. | Username: admin Password: Admin123 | Login berhasil, pengguna dialihkan ke dashboard admin | |
| 4 | AUTH-004 | Autentikasi | Sukses - Login (Petugas) | 1. Buka /login 2. Masukkan Username dan Password petugas yang benar. | Username: petugas Password: Petugas123 | Login berhasil, pengguna dialihkan ke dashboard petugas | |
| 5 | AUTH-005 | Autentikasi | Sukses - Logout | 1. Login dengan kredensial yang valid 2. Navigasi ke halaman manapun di dashboard 3. Klik tombol keluar di Header 4. Modal konfirmasi akan muncul kemudian klik logout | - | Logout berhasil, pengguna dialihkan ke halaman login | |
| 6 | USER-001 | Kelola Pengguna | Sukses - Lihat Daftar Semua Pengguna | 1. Login sebagai admin 2. Buka halaman kelola pengguna /admin/users 3. Tunggu tabel dimuat | Username: admin Password: Admin123 | Daftar lengkap pengguna tampil dengan info: nama, username, role, status | |
| 7 | USER-002 | Kelola Pengguna | Sukses - Tambah Pengguna Baru | 1. Login sebagai admin 2. Buka halaman Kelola Pengguna 3. Klik tombol "Tambah Pengguna" 4. Isi form dan klik simpan | Username: budi_santoso Password: Budi123 Nama: Budi Santoso Role: Peminjam | Pengguna baru berhasil ditambahkan dan muncul di daftar | |
| 8 | USER-003 | Kelola Pengguna | Gagal - Tambah Pengguna dengan Username Duplikat | 1. Login sebagai admin 2. Buka halaman Kelola Pengguna 3. Klik tombol "Tambah Pengguna" 4. Isi form menggunakan username yang sudah ada dan klik simpan | Username: admin | Muncul pesan "Username sudah terdaftar" | |
| 9 | USER-004 | Kelola Pengguna | Sukses - Edit Data Pengguna | 1. Login sebagai admin 2. Buka halaman Kelola Pengguna 3. Pilih pengguna dan klik icon Pensil 4. Ubah nama dan klik simpan | Nama Baru: Budi Santoso Wijaya | Data pengguna berhasil diubah | |
| 10 | USER-005 | Kelola Pengguna | Sukses - Hapus Pengguna | 1. Login sebagai admin 2. Buka halaman Kelola Pengguna 3. Pilih pengguna dan klik tombol "Hapus" 4. Konfirmasi penghapusan | - | Pengguna berhasil dihapus, tidak muncul di daftar | |
| 11 | USER-006 | Kelola Pengguna | Sukses - Ubah Status Pengguna | 1. Login sebagai admin 2. Buka halaman Kelola Pengguna 3. Pilih pengguna dan ubah status 4. Simpan perubahan | Status: Nonaktif | Status pengguna berhasil diubah menjadi nonaktif/aktif | |
| 12 | KAT-001 | Kelola Kategori | Sukses - Lihat Daftar Kategori | 1. Login sebagai admin 2. Buka halaman Kelola Kategori /admin/kategori 3. Tunggu tabel dimuat | Username: admin Password: Admin123 | Daftar kategori tampil dengan kolom: nama kategori, deskripsi, aksi | |
| 13 | KAT-002 | Kelola Kategori | Sukses - Tambah Kategori Baru | 1. Login sebagai admin 2. Buka halaman Kelola Kategori 3. Klik tombol "Tambah Kategori" 4. Isi form dan klik simpan | Nama: Elektronik Deskripsi: Alat-alat elektronik | Kategori baru berhasil ditambahkan dan muncul di daftar | |
| 14 | KAT-003 | Kelola Kategori | Gagal - Tambah Kategori dengan Nama Duplikat | 1. Login sebagai admin 2. Buka halaman Kelola Kategori 3. Klik tombol "Tambah Kategori" 4. Isi form dengan nama kategori yang sudah ada | Nama: Elektronik | Muncul pesan "Kategori sudah ada" | |
| 15 | KAT-004 | Kelola Kategori | Sukses - Edit Kategori | 1. Login sebagai admin 2. Buka halaman Kelola Kategori 3. Pilih kategori dan klik Edit 4. Ubah data dan klik simpan | Nama Baru: Alat Elektronik Baru | Data kategori berhasil diubah | |
| 16 | KAT-005 | Kelola Kategori | Sukses - Hapus Kategori | 1. Login sebagai admin 2. Buka halaman Kelola Kategori 3. Pilih kategori dan klik "Hapus" 4. Konfirmasi penghapusan | - | Kategori berhasil dihapus, tidak muncul di daftar | |
| 17 | ALT-001 | Kelola Alat | Sukses - Lihat Daftar Alat | 1. Login sebagai admin 2. Buka halaman Kelola Alat /admin/alat 3. Daftar Alat berhasil dimuat | Username: admin Password: Admin123 | Daftar alat tampil dengan detail: nama, kode, kategori, stok, kondisi | |
| 18 | ALT-002 | Kelola Alat | Sukses - Tambah Alat Baru | 1. Login sebagai admin 2. Buka halaman Kelola Alat 3. Klik tombol "Tambah Alat" 4. Isi form dan klik simpan | Nama: Laptop Asus VivoBook Kode: LAPTOP-001 Kondisi: Baik Stok: 5 Kategori: Elektronik | Alat baru berhasil ditambahkan dan muncul di daftar | |
| 19 | ALT-003 | Kelola Alat | Gagal - Tambah Alat dengan Kode Duplikat | 1. Login sebagai admin 2. Buka halaman Kelola Alat 3. Klik tombol "Tambah Alat" 4. Isi form menggunakan kode yang sudah ada | Kode: LAPTOP-001 | Muncul pesan "Kode alat sudah terdaftar" | |
| 20 | ALT-004 | Kelola Alat | Sukses - Edit Data Alat | 1. Login sebagai admin 2. Buka halaman Kelola Alat 3. Pilih alat dan klik Edit 4. Ubah data (nama, stok) dan klik simpan | Nama: Laptop Asus VivoBook 15 Stok: 3 | Data alat berhasil diubah | |
| 21 | ALT-005 | Kelola Alat | Sukses - Hapus Alat | 1. Login sebagai admin 2. Buka halaman Kelola Alat 3. Pilih alat dan klik "Hapus" 4. Konfirmasi penghapusan | - | Alat berhasil dihapus, tidak muncul di daftar | |
| 22 | ALT-006 | Kelola Alat | Sukses - Ubah Kondisi Alat | 1. Login sebagai admin 2. Buka halaman Kelola Alat 3. Pilih alat dan ubah kondisi 4. Simpan perubahan | Kondisi: Rusak Ringan | Kondisi alat berhasil diubah dan tersimpan | |
| 23 | PNJM-001 | Peminjaman | Sukses - Ajukan Peminjaman Alat (Peminjam) | 1. Login sebagai peminjam 2. Buka halaman "Ajukan Peminjaman" /peminjam/peminjaman/create 3. Pilih alat yang ingin dipinjam 4. Isi alasan dan klik "Ajukan" | Alat: Laptop Asus VivoBook Alasan: Untuk tugas kelompok | Peminjaman berhasil diajukan dengan status "Menunggu Persetujuan" | |
| 24 | PNJM-002 | Peminjaman | Gagal - Ajukan Peminjaman saat Sudah 2 Peminjaman Aktif | 1. Login sebagai peminjam dengan 2 peminjaman aktif 2. Coba ajukan peminjaman baru 3. Tunggu respons sistem | - | Muncul pesan "Sudah mencapai maksimal peminjaman (2)" | |
| 25 | PNJM-003 | Peminjaman | Gagal - Ajukan Peminjaman saat Ada Peminjaman Terlambat | 1. Login sebagai peminjam dengan peminjaman terlambat 2. Coba ajukan peminjaman baru 3. Tunggu respons sistem | - | Muncul pesan "Ada peminjaman terlambat, silakan kembalikan terlebih dahulu" | |
| 26 | PNJM-004 | Peminjaman | Sukses - Lihat Daftar Peminjaman Saya (Peminjam) | 1. Login sebagai peminjam 2. Buka halaman "Riwayat Peminjaman" /peminjam/peminjaman 3. Tunggu data berhasil dimuat | Username: peminjam Password: Peminjam123 | Daftar peminjaman tampil dengan detail: alat, tanggal, status, periode peminjaman | |
| 27 | PNJM-005 | Peminjaman | Sukses - Batalkan Peminjaman (Status Menunggu) | 1. Login sebagai peminjam 2. Lihat peminjaman dengan status "Menunggu Persetujuan" 3. Klik tombol "Batalkan" 4. Konfirmasi pembatalan | - | Peminjaman berhasil dibatalkan, status berubah ke "Dibatalkan" | |
| 28 | PNJM-006 | Peminjaman | Gagal - Batalkan Peminjaman (Status Sedang Dipinjam) | 1. Login sebagai peminjam 2. Cari peminjaman dengan status "Sedang Dipinjam" 3. Klik tombol "Batalkan" 4. Periksa apa yang terjadi | - | Tidak bisa melakukan pembatalan peminjaman, tombol dinonaktifkan | |
| 29 | PNJM-007 | Peminjaman | Sukses - Petugas Lihat Semua Peminjaman | 1. Login sebagai petugas 2. Buka halaman "Daftar Peminjaman" /petugas/peminjaman 3. Tunggu tabel dimuat | Username: petugas Password: Petugas123 | Daftar lengkap semua peminjaman tampil dengan info: peminjam, alat, tanggal, status | |
| 30 | PNJM-008 | Peminjaman | Sukses - Petugas Setujui Peminjaman | 1. Login sebagai petugas 2. Buka halaman "Daftar Peminjaman" 3. Cari peminjaman "Menunggu Persetujuan" 4. Klik peminjaman dan pilih "Setujui", isi durasi | Durasi: 7 Hari | Peminjaman berhasil disetujui, status berubah menjadi "Sedang Dipinjam", tanggal kembali otomatis dihitung | |
| 31 | PNJM-009 | Peminjaman | Sukses - Petugas Tolak Peminjaman | 1. Login sebagai petugas 2. Buka halaman "Daftar Peminjaman" 3. Cari peminjaman "Menunggu Persetujuan" 4. Klik "Tolak" dan isi alasan penolakan | Alasan: Alat sedang dalam perbaikan | Peminjaman ditolak, status berubah menjadi "Ditolak", alasan tersimpan | |
| 32 | PNJM-010 | Peminjaman | Sukses - Lihat Detail dan Riwayat Peminjaman | 1. Login sebagai petugas 2. Buka halaman "Daftar Peminjaman" 3. Pilih peminjaman dari daftar 4. Klik detail untuk lihat informasi lengkap | - | Detail peminjaman tampil dengan informasi: peminjam, alat, tanggal, durasi, status | |
| 33 | PGLB-001 | Pengembalian | Sukses - Proses Pengembalian (Kondisi Baik) | 1. Login sebagai petugas 2. Buka halaman "Pengembalian" /petugas/pengembalian 3. Pilih peminjaman yang akan dikembalikan 4. Pilih kondisi "Baik" dan klik "Proses Pengembalian" | Kondisi: Baik | Pengembalian berhasil, alat tersedia kembali, status pengembalian mencatat tanggal | |
| 34 | PGLB-002 | Pengembalian | Sukses - Proses Pengembalian (Kondisi Rusak Ringan) | 1. Login sebagai petugas 2. Buka halaman "Pengembalian" 3. Pilih peminjaman untuk dikembalikan 4. Pilih kondisi "Rusak Ringan" dan klik "Proses Pengembalian" | Kondisi: Rusak Ringan | Pengembalian berhasil dengan kondisi Rusak Ringan, denda diinput manual | |
| 35 | PGLB-003 | Pengembalian | Sukses - Proses Pengembalian (Kondisi Rusak Berat) | 1. Login sebagai petugas 2. Buka halaman "Pengembalian" 3. Pilih peminjaman untuk dikembalikan 4. Pilih kondisi "Rusak Berat" dan klik "Proses Pengembalian" | Kondisi: Rusak Berat | Pengembalian berhasil dengan kondisi Rusak Berat, denda diinput manual | |
| 36 | PGLB-004 | Pengembalian | Sukses - Proses Pengembalian (Kondisi Hilang) | 1. Login sebagai petugas 2. Buka halaman "Pengembalian" 3. Pilih peminjaman untuk dikembalikan 4. Pilih kondisi "Hilang" dan klik "Proses Pengembalian" | Kondisi: Hilang | Pengembalian berhasil dengan kondisi Hilang, denda diinput manual | |
| 37 | PGLB-005 | Pengembalian | Sukses - Lihat Daftar Pengembalian | 1. Login sebagai petugas 2. Buka halaman "Pengembalian" 3. Tunggu tabel dimuat | Username: petugas Password: Petugas123 | Daftar pengembalian tampil dengan detail: peminjam, alat, kondisi, tanggal pengembalian | |
| 38 | DNDA-001 | Denda | Sukses - Hitung Denda Keterlambatan Otomatis | 1. Login sebagai petugas 2. Proses pengembalian untuk alat yang terlambat 3 hari 3. Pilih kondisi "Baik" 4. Verifikasi denda keterlambatan tampil | Terlambat: 3 hari | Denda keterlambatan otomatis dihitung dan ditampilkan (Rp 15.000) | |
| 39 | DNDA-002 | Denda | Sukses - Hitung Denda Kerusakan Ringan | 1. Login sebagai petugas 2. Proses pengembalian dengan kondisi "Rusak Ringan" 3. Input nominal denda 4. Periksa nominal denda | Nominal: Rp 50.000 | Denda kerusakan ringan tersimpan dengan nominal yang diinput | |
| 40 | DNDA-003 | Denda | Sukses - Hitung Denda Kerusakan Berat | 1. Login sebagai petugas 2. Proses pengembalian dengan kondisi "Rusak Berat" 3. Input nominal denda 4. Periksa nominal denda | Nominal: Rp 150.000 | Denda kerusakan berat tersimpan dengan nominal yang diinput | |
| 41 | DNDA-004 | Denda | Sukses - Lihat Daftar Denda Saya (Peminjam) | 1. Login sebagai peminjam 2. Navigasi ke halaman "Denda Saya" 3. Tunggu tabel dimuat 4. Periksa riwayat denda Anda | - | Daftar denda tampil dengan detail: alat, jumlah denda, status pembayaran, riwayat pembayaran | |
| 42 | DNDA-005 | Denda | Sukses - Lihat Semua Denda (Admin) | 1. Login sebagai admin 2. Buka halaman "Daftar Denda" /admin/denda 3. Tunggu tabel dimuat 4. Periksa daftar denda dari semua peminjam | Username: admin Password: Admin123 | Daftar denda tampil dengan info: peminjam, nominal, status, tanggal dibuat | |
| 43 | DNDA-006 | Denda | Sukses - Catat Pembayaran Denda | 1. Login sebagai admin/petugas 2. Buka halaman denda "Belum Bayar" 3. Pilih denda dan klik "Bayar" 4. Input tanggal pembayaran dan konfirmasi | Tanggal Bayar: 2026-02-11 | Denda berhasil dicatat sebagai "Lunas", tanggal pembayaran tercatat | |
| 44 | LPRN-001 | Laporan | Sukses - Generate Laporan Peminjaman (Admin) | 1. Login sebagai admin 2. Buka halaman Laporan /admin/laporan 3. Pilih periode: 2026-02-01 hingga 2026-02-28 4. Klik "Lihat" atau "Download" | Tanggal dari: 2026-02-01 Tanggal sampai: 2026-02-28 | Laporan peminjaman berhasil dibuat dengan data lengkap | |
| 45 | LPRN-002 | Laporan | Sukses - Generate Laporan Pengembalian (Admin) | 1. Login sebagai admin 2. Buka halaman Laporan Pengembalian /admin/laporan/pengembalian 3. Pilih periode 4. Klik "Lihat" atau "Download" | Tanggal dari: 2026-02-01 Tanggal sampai: 2026-02-28 | Laporan pengembalian berhasil dibuat dengan data lengkap | |
| 46 | LPRN-003 | Laporan | Sukses - Generate Laporan Peminjaman (Petugas) | 1. Login sebagai petugas 2. Buka halaman Laporan /petugas/laporan 3. Pilih periode 4. Klik "Lihat" atau "Download" | Tanggal dari: 2026-02-01 Tanggal sampai: 2026-02-28 | Laporan peminjaman berhasil dibuat | |
| 47 | LPRN-004 | Laporan | Sukses - Download Laporan PDF | 1. Login sebagai admin 2. Buka halaman Laporan 3. Klik tombol "Download PDF" 4. Tunggu file selesai diunduh | - | File PDF berhasil diunduh dengan nama yang sesuai (laporan_peminjaman_*.pdf) | |
| 48 | LPRN-005 | Laporan | Sukses - Print Laporan | 1. Login sebagai admin 2. Buka halaman Laporan 3. Klik tombol "Print" 4. Jendela print browser terbuka | - | Jendela print terbuka dengan format laporan yang siap cetak | |
| 49 | LAKT-001 | Log Aktivitas | Sukses - Lihat Daftar Log Aktivitas | 1. Login sebagai admin 2. Buka halaman "Log Aktivitas" /admin/log-aktivitas 3. Tunggu tabel dimuat 4. Periksa daftar log | Username: admin Password: Admin123 | Daftar log aktivitas tampil dengan detail: pengguna, jenis aktivitas, deskripsi, waktu | |
| 50 | LAKT-002 | Log Aktivitas | Sukses - Filter Log Aktivitas Berdasarkan Jenis | 1. Login sebagai admin 2. Buka halaman "Log Aktivitas" 3. Filter berdasarkan jenis aktivitas 4. Lihat hasil filter | Jenis: Peminjaman | Daftar log terfiter menampilkan hanya aktivitas jenis tertentu | |
| 51 | DASH-001 | Dashboard | Sukses - Admin Lihat Dashboard | 1. Login sebagai admin 2. Buka halaman Dashboard /admin/dashboard 3. Tunggu dashboard dimuat | Username: admin Password: Admin123 | Dashboard admin tampil dengan statistik: total pengguna, total alat, peminjaman aktif, denda belum bayar | |
| 52 | DASH-002 | Dashboard | Sukses - Petugas Lihat Dashboard | 1. Login sebagai petugas 2. Buka halaman Dashboard /petugas/dashboard | Username: petugas Password: Petugas123 | Dashboard petugas tampil dengan statistik: peminjaman menunggu, pengembalian pending, denda | |
| 53 | DASH-003 | Dashboard | Sukses - Peminjam Lihat Katalog Alat | 1. Login sebagai peminjam 2. Buka halaman Dashboard /peminjam/dashboard atau /peminjam/katalog | Username: peminjam Password: Peminjam123 | Dashboard peminjam tampil dengan katalog alat yang dapat dipinjam, stok, dan kondisi | |
| 54 | DASH-004 | Dashboard | Sukses - Peminjam Lihat Riwayat Peminjaman | 1. Login sebagai peminjam 2. Dari dashboard klik menu "Riwayat Peminjaman" | - | Riwayat peminjaman tampil dengan status terkini | |

---

## Credential Test

### Akun Admin
- Username: `admin`
- Password: `Admin123`
- Role: Admin

### Akun Petugas
- Username: `petugas`
- Password: `Petugas123`
- Role: Petugas

### Akun Peminjam
- Username: `peminjam`
- Password: `Peminjam123`
- Role: Peminjam

---

## Catatan Testing

1. **Module yang diuji**: 9 modul utama (Autentikasi, Pengguna, Kategori, Alat, Peminjaman, Pengembalian, Denda, Laporan, Log Aktivitas, Dashboard)
2. **Total Test Case**: 54 test case
3. **Jenis Testing**: Functional Testing (Positive & Negative Testing)
4. **Cakupan Testing**: 
   - Happy Path (Sukses)
   - Error Handling (Gagal)
   - Access Control (Role-based)
   - Data Validation
5. **Data Validation**:
   - Username/Email uniqueness
   - Kode alat uniqueness
   - Nama kategori uniqueness
   - Validasi durasi peminjaman
   - Validasi perhitungan denda

---

## Checklist Pre-Testing

- [ ] Database sudah di-setup dan di-seed dengan data dummy
- [ ] Semua migrasi sudah dijalankan
- [ ] Seeders sudah dijalankan untuk membuat data testing
- [ ] Server Laravel sudah running
- [ ] All routes sudah tested dan accessible
- [ ] Authentication middleware sudah berfungsi
- [ ] Authorization (role-based access) sudah berfungsi

---

## Checklist Post-Testing

Setelah semua test case selesai dijalankan:

- [ ] Catat jumlah test case yang LULUS
- [ ] Catat jumlah test case yang GAGAL
- [ ] Identifikasi bug/issue yang ditemukan
- [ ] Buat laporan bug dengan detail
- [ ] Prioritas bug (Critical, High, Medium, Low)
- [ ] Buat action plan untuk fixing bugs

