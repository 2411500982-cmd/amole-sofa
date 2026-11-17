# AMOLE SOFA

**Website E-Commerce Penjualan Sofa**

## 1. Deskripsi Aplikasi

Amole Sofa merupakan website e-commerce yang dibuat untuk memudahkan pengguna dalam melihat, mencari, dan membeli berbagai produk sofa secara online. Website ini juga menyediakan halaman admin untuk mengelola produk dan kategori.

## 2. Fitur Utama

- Menampilkan katalog produk sofa.
- Menampilkan detail produk dan kategori.
- Fitur pencarian produk.
- Keranjang belanja.
- Wishlist produk.
- Proses checkout dan pemesanan.
- Halaman admin untuk mengelola produk dan kategori.
- Pengelolaan gambar produk.

## 3. Teknologi yang Digunakan

- **Backend:** PHP dan Laravel
- **Database:** MySQL
- **Frontend:** HTML, CSS, dan JavaScript
- **Code Editor:** Visual Studio Code

## 4. Prasyarat Instalasi

Sebelum menjalankan aplikasi, pastikan perangkat sudah memiliki:

- PHP
- Composer
- MySQL atau XAMPP
- Node.js dan NPM jika diperlukan.

## 5. Cara Menjalankan Aplikasi

1. Clone repository project:

```bash
git clone [2411500982-cmd/amole-sofa]
```

2. Masuk ke folder project:

```bash
cd amole-sofa
```

3. Install dependency:

```bash
composer install
```

4. Salin file konfigurasi:

```bash
copy .env.example .env
```

5. Buat application key:

```bash
php artisan key:generate
```

6. Sesuaikan konfigurasi database pada file `.env`.

7. Jalankan migration:

```bash
php artisan migrate
```

8. Buat symbolic link penyimpanan gambar:

```bash
php artisan storage:link
```

9. Jalankan aplikasi:

```bash
php artisan serve
```

## 6. Konfigurasi Database

Buat database dengan nama `amole_sofa` melalui phpMyAdmin atau MySQL.

Sesuaikan konfigurasi pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=amole_sofa
DB_USERNAME=root
DB_PASSWORD=
```

## 7. Struktur Folder

```text
amole-sofa/
├── app/
│   ├── Http/
│   └── Models/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
│   └── views/
├── routes/
├── storage/
├── tests/
├── .env.example
├── .gitignore
├── composer.json
└── README.md
```

## 8. Anggota Kelompok

- Ketua Kelompok: [Nama Anggota]
- Anggota 1: [Idzan Hauza Saptutra_2411500982]
- Anggota 2: [Muhammad Rosi Fattah Satria_2411501360]
- Anggota 3: [Muhammad Adib Fauzi_2411501634]

## 9. Dosen Pembimbing

[Dr. Ir. Achmad Solichin, S.Kom., M.T.I]