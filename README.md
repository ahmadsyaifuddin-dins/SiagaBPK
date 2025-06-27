<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

# 🚒 SiagaBPK - Sistem Informasi Manajemen Penugasan dan Laporan Kebakaran

SiagaBPK adalah aplikasi berbasis web yang dikembangkan menggunakan Laravel 12. Aplikasi ini dirancang untuk membantu Badan Pemadam Kebakaran (BPK) dalam mengelola laporan insiden, jadwal siaga petugas, dokumentasi, serta eksport data dalam bentuk PDF.

---

## 🔧 Fitur Utama

- ✅ Manajemen Laporan Insiden Kebakaran
  - Tambah, edit, dan lihat laporan
  - Upload dokumentasi insiden (foto)
  - Statistik insiden berdasarkan status
- ✅ Jadwal Siaga Petugas
  - Input jadwal bertugas harian
  - Status siaga, tugas, istirahat
- ✅ Kelola Data Petugas
  - Role berdasarkan Laravel Spatie (Admin / Relawan)
- ✅ Laporan Lengkap & Ekspor PDF
  - Filter laporan berdasarkan tanggal & status
  - Ekspor data ke PDF (laporan rekap / laporan lengkap)
- ✅ Dashboard Statistik
  - Statistik insiden real-time
  - Total insiden, status terkini, dll
- ✅ Role Akses
  - Admin: CRUD penuh
  - Relawan: akses hanya baca (read-only)

---

## ⚙️ Instalasi & Setup

Pastikan sudah terinstall:

- PHP ≥ 8.2
- Composer
- Node.js ≥ v18 (disarankan Node.js v22)
- MySQL / MariaDB
- Laragon (pastikan pakai Phpmyadmin bukan heidisql)
kalau belum silahkan install dulu di https://files.phpmyadmin.net/phpMyAdmin/5.2.2/phpMyAdmin-5.2.2-all-languages.zip
lalu di extract dulu zipnya letak in folder nya di laragon/etc/app/"paste disini" rename foldernya jadi phpMyAdmin

### 1. Clone Repo

```bash
git clone https://github.com/username/siagabpk.git
```
```bash
cd siagabpk
```

### 2. Install Dependency Laravel
```bash
composer install
```

### 3. Install Dependency Frontend
```bash
npm install
```

### 4. Salin dan Konfigurasi .env
```bash
cp .env.example .env
```
Lalu sesuaikan konfigurasi database di file .env:
```css
DB_DATABASE=siagabpk
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Key & Migrasi Database
```bash
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### 6. Jalankan Aplikasi (buka 2 windows cmd atau pakai cmder bawaan laragon)
di cmd pertama
```bash
php artisan serve
```
cmd kedua
```bash
npm run dev
```

| Role    | Email                                       | Password |
| ------- | ------------------------------------------- | -------- |
| Admin   | [admin@bpk.com](mailto:admin@bpk.com)       | adminbpk123 |
| Relawan | [lina@bpk.com](mailto:lina@bpk.com)         | relawanbpk123 |


### 📸 Screenshot UI
![ss utama aplikasi](https://github.com/user-attachments/assets/1a8bcee8-f304-425a-bcc2-53956850ff62)

