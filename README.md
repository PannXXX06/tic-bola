# Tic-bola - Web Pemesanan Tiket Sepak Bola

![Laravel Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

## Tentang Aplikasi

Tiket Bola adalah sebuah web pemesanan tiket pertandingan sepak bola secara online. Dibangun dengan Laravel framework, aplikasi ini memudahkan pengguna dalam memesan tiket pertandingan favorit mereka.

## Fitur Utama

- Pendaftaran & Login Pengguna
- Pencarian Pertandingan
- Pemilihan Kursi
- Proses Pemesanan Tiket
- Pembayaran Online
- Riwayat Transaksi
- Manajemen Pertandingan (Admin)
- Manajemen Stadion (Admin)

## Teknologi

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5, jQuery
- **Database**: MySQL
- **Autentikasi**: Laravel Sanctum

## Instalasi

1. Clone repository:
   ```bash
   git clone https://github.com/PannXXX06/tic-bola.git
   cd tic-bola

2. Install dependencies:
    ```bash
    composer install
    npm install

3. Setup environment:
    ```bash
    cp .env.example .env
    php artisan key:generate

4. Konfigurasi database di .env:
   ```env
    DB_DATABASE=nama_database
    DB_USERNAME=username
    DB_PASSWORD=password

5.Migrasi database:
    ```bash
    php artisan migrate --seed

6. Build assets:
    ```bash
    npm run dev

7. Jalankan server:
    ```bash
    php artisan serve

## Penggunaan

-Akses: http://localhost:8000

-Admin:

    Email: admin@example.com

    Password: password
-Pengguna: Daftar melalui halaman register

