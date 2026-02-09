# Dokumentasi Teknis SIJAMAT-PRO
**Sistem Informasi Peminjaman Alat Produktif**

---

## 📋 Daftar Isi
- [Informasi Sistem](#informasi-sistem)
- [Tech Stack](#tech-stack)
- [Arsitektur Sistem](#arsitektur-sistem)
- [Struktur Database](#struktur-database)
- [Struktur Folder](#struktur-folder)
- [Fitur Utama](#fitur-utama)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [API & Helper Functions](#api--helper-functions)
- [Testing](#testing)

---

## 🖥️ Informasi Sistem

### Detail Aplikasi
- **Nama:** SIJAMAT-PRO (Sistem Informasi Peminjaman Alat Produktif)
- **Versi:** 1.0
- **Framework:** Laravel 12.50.0
- **PHP Version:** 8.3.29
- **Database:** MySQL
- **Frontend:** Blade Template Engine + Tailwind CSS

### Environment Requirements
```
PHP >= 8.2
Composer
MySQL >= 8.0
Node.js & NPM (untuk kompilasi assets)
```

---

## 🛠️ Tech Stack

### Backend
- **Framework:** Laravel 12.50.0
- **PHP:** 8.3.29
- **Database ORM:** Eloquent
- **Authentication:** Laravel Session-based Auth
- **Validation:** Laravel Form Requests

### Frontend
- **Template Engine:** Blade
- **CSS Framework:** Tailwind CSS 3.x
- **JavaScript:** Vanilla JS (Real-time calculations)
- **Icons:** Heroicons (SVG)

### Development Tools
- **Package Manager:** Composer (PHP), NPM (Node)
- **Build Tool:** Vite
- **Code Style:** PSR-12

---

## 🏗️ Arsitektur Sistem

### Design Pattern
Sistem menggunakan **MVC Architecture** dengan Service Layer:

```
Request → Route → Controller → Service → Model → Database
                     ↓
                  View (Blade)
```

### Layer Architecture

#### 1. **Routes Layer** (`routes/web.php`)
- Mendefinisikan semua endpoint aplikasi
- Grouping berdasarkan middleware (auth, role)
- RESTful resource routing

#### 2. **Controller Layer** (`app/Http/Controllers/`)
- Menerima HTTP request
- Validasi input via Form Requests
- Delegate business logic ke Service
- Return view dengan data

#### 3. **Service Layer** (`app/Services/`)
- Business logic utama
- Transaksi database
- Logging aktivitas
- Kalkulasi kompleks

#### 4. **Model Layer** (`app/Models/`)
- Eloquent ORM models
- Relationships definition
- Accessors & Mutators
- Scopes untuk query reusability

#### 5. **View Layer** (`resources/views/`)
- Blade templates
- Component-based UI
- Layout inheritance
- Real-time JavaScript

---

## 🗄️ Struktur Database

### Tabel Utama

#### 1. **users**
```sql
- id (PK)
- username (unique)
- email (unique)
- password (hashed)
- name
- role_id (FK → roles)
- created_at, updated_at
```

#### 2. **roles**
```sql
- id (PK)
- nama_role (admin, petugas, peminjam)
- created_at, updated_at
```

#### 3. **kategori**
```sql
- id_kategori (PK)
- nama_kategori
- deskripsi
- created_at, updated_at
```

#### 4. **alat**
```sql
- id_alat (PK)
- nama_alat
- kode_alat (unique)
- kategori_id (FK → kategori)
- stok
- kondisi (enum: baik, rusak)
- deskripsi
- gambar (nullable)
- created_at, updated_at
```

#### 5. **peminjaman**
```sql
- id_peminjaman (PK)
- user_id (FK → users)
- petugas_id (FK → users, nullable)
- tanggal_pinjam (datetime)
- tanggal_kembali_rencana (datetime)
- status (enum: pending, disetujui, ditolak, selesai, batal)
- catatan
- created_at, updated_at
```

#### 6. **detail_peminjaman**
```sql
- id (PK)
- peminjaman_id (FK → peminjaman)
- alat_id (FK → alat)
- jumlah
- created_at, updated_at
```

#### 7. **pengembalian**
```sql
- id (PK)
- peminjaman_id (FK → peminjaman)
- tanggal_kembali_real (datetime)
- denda (decimal)
- catatan_kondisi
- petugas_id (FK → users)
- created_at, updated_at
```

#### 8. **dendas**
```sql
- id (PK)
- jumlah_denda (decimal) - tarif per hari
- is_active (boolean)
- created_at, updated_at
```

#### 9. **log_aktivitas**
```sql
- id (PK)
- user_id (FK → users)
- aktivitas (text)
- created_at, updated_at
```

### Relationships

```
users (1) → (N) peminjaman
users (1) → (N) log_aktivitas
roles (1) → (N) users
kategori (1) → (N) alat
peminjaman (1) → (N) detail_peminjaman
peminjaman (1) → (1) pengembalian
alat (1) → (N) detail_peminjaman
```

---

## 📁 Struktur Folder

```
tugasukk-naura/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controller files
│   │   ├── Middleware/        # Custom middleware
│   │   └── Requests/          # Form validation classes
│   ├── Models/                # Eloquent models
│   ├── Services/              # Business logic layer
│   ├── Helpers/               # Helper utilities
│   │   ├── FormatHelper.php   # Date/time formatting
│   │   └── helpers.php        # Global functions
│   └── Providers/             # Service providers
├── database/
│   ├── migrations/            # Database schema
│   └── seeders/               # Sample data
├── resources/
│   ├── views/                 # Blade templates
│   │   ├── admin/            # Admin pages
│   │   ├── petugas/          # Petugas pages
│   │   ├── peminjam/         # Peminjam pages
│   │   ├── components/       # Reusable components
│   │   ├── partials/         # Sidebar, header, footer
│   │   └── auth/             # Login page
│   ├── css/
│   └── js/
├── routes/
│   └── web.php               # Route definitions
├── public/                    # Public assets
├── storage/                   # File uploads, logs
├── tests/                     # Unit & feature tests
├── .env                       # Environment config
├── composer.json              # PHP dependencies
├── package.json               # Node dependencies
└── vite.config.js            # Build configuration
```

---

## ⚙️ Fitur Utama

### 1. **Authentication & Authorization**
- Login dengan username/password
- Session-based authentication
- Role-based access control (RBAC)
- 3 Role: Admin, Petugas, Peminjam

### 2. **Manajemen Data Master**
- **Alat:** CRUD alat dengan kategori
- **Kategori:** CRUD kategori alat
- **User:** CRUD user dengan role
- **Pengaturan Denda:** Konfigurasi tarif denda

### 3. **Peminjaman**
- Request peminjaman oleh peminjam
- Approval/rejection oleh petugas
- Multi-item peminjaman
- Status tracking (pending → disetujui → selesai)

### 4. **Pengembalian**
- Input pengembalian oleh petugas
- Kalkulasi denda otomatis (per jam)
- Real-time tracking keterlambatan
- Catatan kondisi alat

### 5. **Late Fee System**
- **Tarif:** Per hari (dibagi 24 untuk per jam)
- **Perhitungan:** `ceil(total_hours) × (tarif_harian / 24)`
- **Real-time:** Update setiap 60 detik
- **Multi-day:** Akumulasi denda untuk keterlambatan >24 jam

### 6. **Laporan**
- Laporan peminjaman (filter by date range)
- Laporan pengembalian (filter by date range)
- Export to print (PDF-ready view)

### 7. **Log Aktivitas**
- Track semua aktivitas user
- Timestamp setiap action
- Audit trail untuk compliance

---

## 📦 Instalasi

### 1. Clone Repository
```bash
git clone <repository-url>
cd tugasukk-naura
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tugasukk_naura
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migration & Seeder
```bash
php artisan migrate:fresh --seed
```

### 6. Build Assets
```bash
npm run build
# atau untuk development:
npm run dev
```

### 7. Run Application
```bash
php artisan serve
```

Akses: `http://localhost:8000`

---

## 🔧 Konfigurasi

### Default Users (Seeder)
```
Username: admin
Password: adminadmin
Role: Admin

Username: petugas
Password: adminadmin
Role: Petugas

Username: peminjam
Password: adminadmin
Role: Peminjam
```

### Denda Configuration
Default tarif denda: **Rp 24.000/hari** (Rp 1.000/jam)

Ubah di `database/seeders/DendaSeeder.php`:
```php
'jumlah_denda' => 24000, // tarif per hari
```

### Timezone
Set di `.env`:
```env
APP_TIMEZONE=Asia/Jakarta
```

---

## 🔌 API & Helper Functions

### Global Helper Functions

#### 1. **formatLateDuration($targetDate, $currentDate = null)**
```php
// Menghitung durasi keterlambatan
$duration = formatLateDuration($peminjaman->tanggal_kembali_rencana);
// Returns: ['days' => 1, 'hours' => 10, 'minutes' => 30, 'formatted' => '1 hari 10 jam 30 menit']
```

#### 2. **totalMinutes($days, $hours, $minutes)**
```php
// Convert durasi ke total menit
$totalMins = totalMinutes(1, 10, 30);
// Returns: 2070
```

#### 3. **getTarifDendaAktif()**
```php
// Ambil tarif denda aktif
$tarif = getTarifDendaAktif();
// Returns: 24000 (atau nilai aktif dari database)
```

#### 4. **hitungDendaKeterlambatan($days, $hours, $minutes)**
```php
// Hitung total denda
$denda = hitungDendaKeterlambatan(1, 10, 30);
// Formula: ceil((1*24 + 10 + 30/60)) × (24000/24)
// Returns: 35000
```

### Service Layer Methods

#### **PeminjamanService**
```php
// Buat peminjaman baru
create(array $data, array $alat): Peminjaman

// Approve peminjaman
approve(Peminjaman $peminjaman): bool

// Reject peminjaman
reject(Peminjaman $peminjaman): bool

// Cancel peminjaman
cancel(Peminjaman $peminjaman): bool
```

#### **PengembalianService**
```php
// Proses pengembalian
create(array $data): Pengembalian

// Hitung denda
hitungDenda(Peminjaman $peminjaman, Carbon $tanggalKembali): float
```

---

## 🧪 Testing

### Run Tests
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter PeminjamanTest

# Run with coverage
php artisan test --coverage
```

### Manual Testing Checklist

#### Authentication
- [ ] Login berhasil dengan kredensial valid
- [ ] Login gagal dengan kredensial invalid
- [ ] Logout berhasil
- [ ] Redirect ke dashboard sesuai role

#### Peminjaman Flow
- [ ] Peminjam bisa request peminjaman
- [ ] Petugas bisa approve peminjaman
- [ ] Petugas bisa reject peminjaman
- [ ] Stok berkurang saat disetujui
- [ ] Status berubah sesuai flow

#### Pengembalian Flow
- [ ] Petugas bisa input pengembalian
- [ ] Denda terhitung otomatis
- [ ] Stok bertambah kembali
- [ ] Status peminjaman jadi "selesai"

#### Late Fee Calculation
- [ ] Denda 0 jika tepat waktu
- [ ] Denda benar untuk keterlambatan <1 hari
- [ ] Denda benar untuk keterlambatan >1 hari
- [ ] Real-time update berjalan setiap 60 detik

---

## 🔐 Security Best Practices

1. **Password Hashing:** Menggunakan bcrypt via Laravel Hash facade
2. **CSRF Protection:** Token CSRF di semua form
3. **SQL Injection Prevention:** Eloquent ORM + prepared statements
4. **XSS Prevention:** Blade automatic escaping `{{ }}`
5. **Authentication:** Session-based dengan middleware protection
6. **Authorization:** Role-based access control (RBAC)

---

## 🚀 Deployment

### Production Checklist

```bash
# 1. Set environment
APP_ENV=production
APP_DEBUG=false

# 2. Optimize application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Build production assets
npm run build

# 4. Set permissions
chmod -R 775 storage bootstrap/cache
```

---

## 📝 Changelog

### Version 1.0 (2026-02-09)
- ✅ Initial release
- ✅ Authentication & RBAC
- ✅ CRUD Alat, Kategori, User
- ✅ Peminjaman & Pengembalian
- ✅ Late fee calculation (per jam)
- ✅ Real-time tracking
- ✅ Laporan peminjaman & pengembalian
- ✅ Log aktivitas
- ✅ Modern login UI
- ✅ Responsive dashboard

---

## 👨‍💻 Developer Notes

### Code Style
- Follow PSR-12 standard
- Use meaningful variable names
- Add comments untuk logic kompleks
- Use type hints di function parameters

### Naming Conventions
- **Models:** Singular (User, Peminjaman)
- **Controllers:** {Model}Controller
- **Services:** {Model}Service
- **Views:** kebab-case (peminjaman/index.blade.php)

### Database Conventions
- **Table names:** Plural atau singular konsisten
- **Primary keys:** id atau id_{table_name}
- **Foreign keys:** {table}_id
- **Timestamps:** created_at, updated_at

---

## 📞 Support & Maintenance

### Common Issues

**Issue:** Helper function not found
```bash
Solution: php artisan optimize:clear && composer dump-autoload
```

**Issue:** View tidak update
```bash
Solution: php artisan view:clear
```

**Issue:** Route tidak ditemukan
```bash
Solution: php artisan route:clear
```

**Issue:** Denda tidak sesuai
```bash
Check: DendaSeeder jumlah_denda value
Run: php artisan migrate:fresh --seed
```

---

## 📄 License
Proprietary - Internal Use Only

---

**Last Updated:** 9 Februari 2026  
**Maintainer:** Development Team  
**Version:** 1.0
