# Dokumentasi SIJAMAT-PRO
**Sistem Informasi Peminjaman Alat Produktif**

---

## 📖 Tentang SIJAMAT-PRO

SIJAMAT-PRO adalah sistem informasi berbasis web yang dirancang untuk mengelola peminjaman alat-alat produktif secara digital, efisien, dan terstruktur. Sistem ini membantu institusi dalam mengatur, memantau, dan melacak peminjaman peralatan dengan mudah.

### 🎯 Tujuan Aplikasi
- Digitalisasi proses peminjaman alat
- Meningkatkan efisiensi pengelolaan inventaris
- Meminimalisir kehilangan atau kerusakan alat
- Mempermudah tracking status peminjaman
- Mengotomatisasi perhitungan denda keterlambatan
- Menyediakan laporan yang akurat dan real-time

### 💡 Manfaat
- **Untuk Admin:** Kontrol penuh atas sistem dan data
- **Untuk Petugas:** Proses approval dan pengembalian lebih cepat
- **Untuk Peminjam:** Pengajuan peminjaman mudah dan transparan
- **Untuk Institusi:** Data terpusat dan laporan terorganisir

---

## 👥 Pengguna Sistem

### 1. **Admin**
Administrator dengan akses penuh ke seluruh fitur sistem.

**Hak Akses:**
- ✅ Kelola data user (tambah, edit, hapus)
- ✅ Kelola data alat dan kategori
- ✅ Kelola data role
- ✅ Lihat semua peminjaman dan pengembalian
- ✅ Generate laporan
- ✅ Atur tarif denda
- ✅ Lihat log aktivitas sistem

### 2. **Petugas**
Pengelola operasional peminjaman dan pengembalian.

**Hak Akses:**
- ✅ Approve/reject pengajuan peminjaman
- ✅ Proses pengembalian alat
- ✅ Lihat data alat dan stok
- ✅ Input denda keterlambatan
- ✅ Catat kondisi alat saat dikembalikan

### 3. **Peminjam**
Pengguna yang mengajukan peminjaman alat.

**Hak Akses:**
- ✅ Ajukan peminjaman alat
- ✅ Lihat riwayat peminjaman pribadi
- ✅ Lihat status pengajuan (pending/disetujui/ditolak)
- ✅ Lihat estimasi denda jika terlambat
- ✅ Lihat katalog alat tersedia

---

## 🔐 Akses & Login

### Cara Login
1. Buka aplikasi di browser
2. Masukkan **Username** dan **Password**
3. Centang "Ingat saya" jika ingin tetap login (opsional)
4. Klik tombol **"Masuk"**

### Default Credentials (Demo)
```
Admin:
Username: admin
Password: adminadmin

Petugas:
Username: petugas
Password: adminadmin

Peminjam:
Username: peminjam
Password: adminadmin
```

> **Penting:** Ganti password default setelah login pertama!

---

## 📑 Fitur Lengkap

### 1️⃣ Dashboard
**Tampilan Berbeda per Role:**

**Dashboard Admin:**
- 📊 Total alat dalam sistem
- 👥 Total user terdaftar
- 📋 Total peminjaman (semua status)
- ✅ Peminjaman aktif
- ⏳ Peminjaman pending
- 📈 Grafik statistik

**Dashboard Petugas:**
- 📋 Peminjaman yang perlu diproses
- 🔄 Pengembalian hari ini
- 📊 Statistik bulanan

**Dashboard Peminjam:**
- 📦 Peminjaman aktif
- ⏰ Status pengajuan
- ⚠️ Notifikasi keterlambatan
- 💰 Estimasi denda real-time

---

### 2️⃣ Manajemen Alat

#### **Fitur:**
- ➕ Tambah alat baru
- ✏️ Edit informasi alat
- 🗑️ Hapus alat
- 🔍 Cari dan filter alat
- 📷 Upload foto alat (opsional)

#### **Informasi yang Dikelola:**
- Kode Alat (unik)
- Nama Alat
- Kategori
- Stok tersedia
- Kondisi (Baik/Rusak)
- Deskripsi

#### **Stok Otomatis:**
- Stok berkurang saat peminjaman disetujui
- Stok bertambah saat alat dikembalikan
- Validasi: tidak bisa dipinjam jika stok habis

---

### 3️⃣ Manajemen Kategori

#### **Fitur:**
- ➕ Tambah kategori baru
- ✏️ Edit nama kategori
- 🗑️ Hapus kategori (jika tidak ada alat terkait)

#### **Contoh Kategori:**
- Elektronik
- Alat Praktik
- Alat Ukur
- Peralatan Kantor
- Laboratorium

---

### 4️⃣ Peminjaman

#### **Proses Peminjaman:**

**Langkah 1: Pengajuan (Peminjam)**
1. Klik **"Ajukan Peminjaman"**
2. Pilih alat yang ingin dipinjam
3. Tentukan jumlah (max = stok tersedia)
4. Bisa pilih **multiple alat** dalam 1 pengajuan
5. Tentukan tanggal kembali
6. Tambahkan catatan (opsional)
7. Submit pengajuan
8. Status: **Pending**

**Langkah 2: Approval (Petugas)**
1. Lihat pengajuan di menu **"Peminjaman"**
2. Review detail peminjaman
3. Periksa ketersediaan alat
4. Pilih aksi:
   - ✅ **Setujui** → Stok berkurang, status jadi "Disetujui"
   - ❌ **Tolak** → Status jadi "Ditolak"

**Langkah 3: Monitoring**
- Peminjam bisa cek status di dashboard
- Sistem tracking otomatis
- Notifikasi jika mendekati deadline

#### **Status Peminjaman:**
- 🟡 **Pending:** Menunggu approval
- 🟢 **Disetujui:** Sudah approve, alat bisa diambil
- 🔴 **Ditolak:** Tidak disetujui
- ⚪ **Batal:** Dibatalkan oleh peminjam
- ✅ **Selesai:** Alat sudah dikembalikan

---

### 5️⃣ Pengembalian

#### **Proses Pengembalian (Petugas):**
1. Pilih peminjaman yang akan dikembalikan
2. Input **tanggal & waktu pengembalian real**
3. Sistem otomatis hitung denda (jika terlambat)
4. Input catatan kondisi alat
5. Konfirmasi pengembalian
6. Stok alat bertambah kembali
7. Status peminjaman jadi **"Selesai"**

#### **Perhitungan Denda:**

**Tarif Default:** Rp 24.000/hari = Rp 1.000/jam

**Formula:**
```
Total Jam Terlambat = (Hari × 24) + Jam + (Menit ÷ 60)
Denda = ⌈Total Jam⌉ × Rp 1.000
```

**Contoh:**
- Terlambat 10 jam 30 menit → Denda = 11 jam × Rp 1.000 = **Rp 11.000**
- Terlambat 1 hari 5 jam → Denda = 29 jam × Rp 1.000 = **Rp 29.000**
- Terlambat 3 hari 2 jam → Denda = 74 jam × Rp 1.000 = **Rp 74.000**

**Fitur Spesial:**
- ⏰ **Real-time tracking:** Estimasi denda update otomatis setiap menit
- 📈 **Multi-day accumulation:** Denda terus bertambah jika terlambat beberapa hari
- ✅ **Presisi tinggi:** Perhitungan per jam untuk keadilan

---

### 6️⃣ Laporan

#### **Laporan Peminjaman**
- Filter berdasarkan tanggal mulai dan akhir
- Tampilkan semua peminjaman dalam periode
- Detail: Kode, Peminjam, Alat, Tanggal, Status
- Export ke PDF (siap print)

#### **Laporan Pengembalian**
- Filter berdasarkan tanggal mulai dan akhir
- Tampilkan pengembalian dalam periode
- Detail: Kode, Peminjam, Alat, Tanggal Kembali, Denda
- Total denda terkumpul
- Export ke PDF (siap print)

#### **Kegunaan Laporan:**
- Evaluasi penggunaan alat
- Monitoring keterlambatan
- Laporan keuangan dari denda
- Audit trail
- Presentasi ke stakeholder

---

### 7️⃣ Manajemen User (Admin)

#### **Fitur:**
- ➕ Tambah user baru
- ✏️ Edit data user
- 🗑️ Hapus user
- 🔑 Ubah password
- 👤 Assign role

#### **Data User:**
- Nama lengkap
- Username (unik)
- Email (unik)
- Password (terenkripsi)
- Role (Admin/Petugas/Peminjam)

---

### 8️⃣ Pengaturan Denda (Admin)

#### **Fitur:**
- ✏️ Update tarif denda (per hari)
- 🔄 Aktifkan/nonaktifkan denda
- 📊 Lihat riwayat perubahan tarif

#### **Note:**
- Sistem hanya bisa punya **1 tarif aktif**
- Tarif baru langsung berlaku untuk semua perhitungan
- Default: Rp 24.000/hari

---

### 9️⃣ Log Aktivitas (Admin)

#### **Yang Dicatat:**
- Login/logout user
- Pembuatan peminjaman
- Approval/rejection peminjaman
- Pengembalian alat
- CRUD data master
- Perubahan data penting

#### **Informasi Log:**
- User yang melakukan aktivitas
- Jenis aktivitas
- Waktu kejadian (timestamp)

#### **Kegunaan:**
- Audit trail
- Tracking user behavior
- Security monitoring
- Troubleshooting

---

## 🎨 Antarmuka (UI/UX)

### Desain Karakteristik:
- **Modern & Minimalis:** Clean design tanpa elemen berlebihan
- **Gradient Accent:** Indigo-purple gradient untuk branding
- **Responsive:** Optimal di desktop, tablet, dan mobile
- **Intuitive:** Navigasi mudah dipahami
- **Accessible:** Contrast ratio yang baik untuk readability

### Komponen UI:
- Card-based layout
- Icon dari Heroicons
- Tailwind CSS utility classes
- Smooth transitions & animations
- Color-coded status badges

---

## 📱 Panduan Penggunaan

### Untuk Peminjam

#### **Cara Mengajukan Peminjaman:**
1. Login dengan akun peminjam
2. Klik menu **"Peminjaman"** → **"Ajukan Peminjaman"**
3. Klik **"Tambah Alat"** untuk setiap alat yang ingin dipinjam
4. Isi jumlah yang diinginkan
5. Pilih tanggal kembali
6. Klik **"Ajukan"**
7. Tunggu approval dari petugas

#### **Cara Cek Status:**
1. Login ke dashboard
2. Lihat card **"Peminjaman Aktif"** atau **"Menunggu Persetujuan"**
3. Klik **"Lihat Detail"** untuk info lengkap
4. Jika disetujui, ambil alat ke petugas
5. Perhatikan deadline pengembalian!

---

### Untuk Petugas

#### **Cara Approve Peminjaman:**
1. Login dengan akun petugas
2. Klik menu **"Peminjaman"**
3. Cari peminjaman dengan status **"Pending"**
4. Klik tombol **"Detail"**
5. Review informasi peminjaman:
   - Peminjam
   - Alat yang dipinjam
   - Jumlah
   - Tanggal kembali
6. Klik **"Setujui"** atau **"Tolak"**
7. Alat siap diserahkan kepada peminjam

#### **Cara Proses Pengembalian:**
1. Klik menu **"Pengembalian"** → **"Tambah Pengembalian"**
2. Pilih peminjaman yang akan dikembalikan
3. Sistem otomatis isi tanggal hari ini (bisa diubah jika perlu)
4. Cek kondisi alat, input catatan kondisi
5. Sistem otomatis hitung denda jika terlambat
6. Klik **"Simpan"**
7. Alat kembali ke stok, peminjaman selesai

---

### Untuk Admin

#### **Cara Kelola Alat:**
1. Login dengan akun admin
2. Klik menu **"Data Alat"**
3. Untuk tambah: Klik **"Tambah Alat"** → Isi form → **"Simpan"**
4. Untuk edit: Klik **"Edit"** pada baris alat → Ubah data → **"Update"**
5. Untuk hapus: Klik **"Hapus"** → Konfirmasi

#### **Cara Kelola User:**
1. Klik menu **"Manajemen User"**
2. Untuk tambah: Klik **"Tambah User"** → Isi data → Pilih role → **"Simpan"**
3. Untuk edit: Klik **"Edit"** → Ubah data → **"Update"**
4. Untuk hapus: Klik **"Hapus"** → Konfirmasi

#### **Cara Generate Laporan:**
1. Klik menu **"Laporan"** → Pilih jenis (Peminjaman/Pengembalian)
2. Tentukan periode (tanggal mulai - tanggal akhir)
3. Klik **"Tampilkan"**
4. Review data di layar
5. Klik **"Print"** untuk cetak PDF

---

## ⚙️ Pengaturan Sistem

### Konfigurasi Denda
1. Login sebagai admin
2. Menu **"Pengaturan"** → **"Denda"**
3. Klik **"Edit"** pada tarif aktif
4. Update nilai **"Jumlah Denda"** (tarif per hari)
5. Klik **"Simpan"**
6. Tarif baru langsung berlaku

### Manajemen Role
Role default sudah tersedia:
- Admin
- Petugas
- Peminjam

### Backup Data
Disarankan backup database secara berkala:
- Export database MySQL
- Simpan file backup di lokasi aman
- Schedule backup otomatis (mingguan/bulanan)

---

## ❓ FAQ (Pertanyaan Umum)

### **Q: Apa yang terjadi jika saya lupa password?**
A: Hubungi admin untuk reset password. Admin bisa update password Anda melalui menu Manajemen User.

### **Q: Bisakah saya meminjam alat yang berbeda kategori sekaligus?**
A: Ya, Anda bisa memilih beberapa alat dari kategori berbeda dalam 1 pengajuan peminjaman.

### **Q: Apakah bisa membatalkan peminjaman yang sudah diajukan?**
A: Ya, selama status masih **"Pending"**, peminjam bisa cancel melalui halaman detail peminjaman.

### **Q: Bagaimana jika alat yang ingin dipinjam stoknya habis?**
A: Sistem akan menampilkan notifikasi bahwa stok tidak mencukupi. Anda perlu menunggu hingga alat dikembalikan.

### **Q: Apakah denda bisa dihapus atau dikurangi?**
A: Sistem menghitung denda otomatis. Jika ada kebutuhan khusus, hubungi admin untuk adjustment manual di database.

### **Q: Berapa lama proses approval peminjaman?**
A: Tergantung ketersediaan petugas. Biasanya 1-2 hari kerja. Cek status secara berkala di dashboard.

### **Q: Apakah sistem bisa diakses dari HP?**
A: Ya, sistem responsive dan bisa diakses dari perangkat mobile melalui browser.

### **Q: Bagaimana cara mengetahui jam berapa deadline pengembalian?**
A: Sistem menggunakan tanggal + waktu. Detail deadline lengkap dengan jam bisa dilihat di halaman detail peminjaman.

---

## 🚨 Troubleshooting

### Masalah Login
**Gejala:** Tidak bisa login
- ✅ Pastikan username dan password benar (case-sensitive)
- ✅ Cek koneksi internet
- ✅ Clear browser cache
- ✅ Hubungi admin jika masih gagal

### Estimasi Denda Tidak Muncul
**Gejala:** Denda tidak ter-update real-time
- ✅ Refresh halaman (F5)
- ✅ Pastikan JavaScript browser aktif
- ✅ Tunggu 60 detik untuk auto-update

### Stok Tidak Update
**Gejala:** Stok alat tidak berkurang setelah approval
- ✅ Pastikan peminjaman sudah status "Disetujui"
- ✅ Refresh halaman
- ✅ Hubungi admin untuk cek database

### Laporan Kosong
**Gejala:** Laporan tidak menampilkan data
- ✅ Cek periode tanggal (pastikan ada data di range tersebut)
- ✅ Perlebar range tanggal
- ✅ Pastikan ada data peminjaman/pengembalian di sistem

---

## 📊 Keunggulan SIJAMAT-PRO

### ✨ Dibanding Sistem Manual:
| Sistem Manual | SIJAMAT-PRO |
|---------------|-------------|
| Pencatatan di buku/Excel | Database digital terstruktur |
| Perhitungan denda manual | Kalkulasi otomatis & akurat |
| Sulit tracking status | Real-time monitoring |
| Laporan manual | Generate laporan otomatis |
| Rawan kesalahan input | Validasi otomatis |
| Akses terbatas | Multi-user dengan role |

### 🎯 Nilai Tambah:
- **Efisiensi:** Proses lebih cepat dan paperless
- **Akurasi:** Minim human error
- **Transparansi:** Semua pihak bisa cek status
- **Akuntabilitas:** Log aktivitas lengkap
- **Fleksibel:** Bisa diakses kapan saja, dimana saja
- **Scalable:** Mudah ditambah fitur baru

---

## 📞 Kontak & Dukungan

Untuk pertanyaan, bantuan, atau pelaporan bug:
- **Email:** support@sijamat-pro.com
- **Telepon:** (021) xxx-xxxx
- **Jam Operasional:** Senin-Jumat, 08:00-17:00 WIB

---

## 📅 Roadmap Fitur Mendatang

### Version 2.0 (Planned)
- [ ] Notifikasi email otomatis
- [ ] SMS reminder deadline
- [ ] QR Code untuk alat
- [ ] Mobile app (Android/iOS)
- [ ] Dashboard analytics lebih lengkap
- [ ] Export laporan ke Excel
- [ ] Multi-bahasa (ID/EN)
- [ ] Dark mode
- [ ] API untuk integrasi eksternal

---

## 📄 Kesimpulan

SIJAMAT-PRO adalah solusi modern untuk manajemen peminjaman alat yang:
- ✅ **Mudah digunakan** dengan interface intuitif
- ✅ **Efisien** menghemat waktu dan tenaga
- ✅ **Akurat** menghitung denda otomatis
- ✅ **Transparan** dengan tracking real-time
- ✅ **Aman** dengan sistem autentikasi & authorization
- ✅ **Lengkap** dari peminjaman hingga laporan

Sistem ini siap membantu institusi Anda dalam mengelola aset produktif dengan lebih baik!

---

**Terima kasih telah menggunakan SIJAMAT-PRO!** 🎉

---

**Versi Dokumen:** 1.0  
**Tanggal:** 9 Februari 2026  
**Status:** Ready for Presentation
