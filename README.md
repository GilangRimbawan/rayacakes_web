<div align="center">

# Website Inventory (IMS v2)
## Backend API & Sistem Inventory Produksi

### Projek Tugas Akhir / Skripsi

<br>

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

</div>

---

# Tentang Proyek

Website Inventory (IMS v2) merupakan sistem manajemen inventaris berbasis web yang dibangun menggunakan CodeIgniter 3.

Sistem ini memiliki dua fungsi utama:

1. Sebagai dashboard administrasi inventaris berbasis web
2. Sebagai Backend REST API untuk aplikasi mobile Flutter

Aplikasi menggunakan arsitektur Client-Server dan melakukan komunikasi data menggunakan format JSON.

---

# Repository Mobile Frontend

Raya Cakes App (Flutter):  
https://github.com/GilangRimbawan/rayacakes_app.git

---

# Fitur Utama Backend

## Secure CORS Handler

Backend telah dikonfigurasi dengan:
- Header CORS khusus
- Dukungan request:
  - GET
  - POST
  - OPTIONS

Memungkinkan aplikasi Flutter berkomunikasi secara aman di jaringan lokal.

---

## Autentikasi API

Menyediakan endpoint login untuk:
- Validasi akun pengguna
- Kontrol akses aplikasi mobile

---

## Engine Produksi & Transaksi Otomatis

### create()

Berfungsi untuk:
- Menerima data resep
- Menghitung kebutuhan bahan baku
- Mengurangi stok gudang
- Menambahkan stok produk jadi

---

### remove()

Berfungsi untuk:
- Membatalkan histori produksi
- Mengembalikan stok bahan baku
- Mengurangi stok produk jadi

---

# Proteksi Integritas Data

Sistem menggunakan mekanisme Pre-Check Validation.

Sebelum transaksi database dijalankan:
- Sistem mengecek seluruh stok bahan
- Validasi dilakukan di level backend
- Transaksi dibatalkan jika stok tidak cukup

Jika validasi gagal:
- Database tidak akan dimanipulasi
- API mengirim response error JSON ke Flutter

Tujuan:
- Mencegah stok minus
- Menjaga konsistensi data inventaris

---

# Sistem Laporan

Backend menyediakan endpoint:
- Rekap laporan produksi
- Filter berdasarkan tanggal
- Data histori produksi

Digunakan untuk:
- Administrasi
- Monitoring produksi
- Pelaporan pemilik usaha

---

# Instalasi Localhost

## 1. Clone Repository

Clone project ke direktori web server:

```bash
git clone https://github.com/GilangRimbawan/rayacakes_web.git
````

---

## 2. Rename Folder Project

Ubah nama folder menjadi:

```text
imsv2
```

Agar sesuai dengan konfigurasi endpoint API.

---

# Konfigurasi Database

## 1. Buat Database Baru

nama database:

```text
stock_v2
```

---

## 2. Import File SQL

Import file SQL yang berada pada folder:

```text
DATABASE_FILE/
```

---

## 3. Konfigurasi Database

Buka file:

```text
application/config/database.php
```

Sesuaikan konfigurasi berikut:

```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'stock_v2',
```

---

# Konfigurasi Base URL

Buka file:

```text
application/config/config.php
```

Lalu ubah:

```php
$config['base_url'] = 'http://localhost/imsv2/';
```

---

# Testing Endpoint API

Contoh endpoint:

```text
http://localhost/imsv2/index.php/api/bahan_baku
```

Test menggunakan:

* Browser
* Postman
* Flutter App

---

# Struktur Inti MVC

## Controller

```text
application/controllers/Api.php
```

Berfungsi sebagai:

* Endpoint API utama
* Handler request JSON
* Routing laporan
* Konfigurasi CORS

---

## Model

```text
application/models/Model_produksi.php
```

Berisi:

* Logika bisnis produksi
* Kalkulasi bahan baku
* Fungsi pembatalan produksi
* Sistem anti stok minus

---

# Teknologi yang Digunakan

* CodeIgniter 3
* PHP 7.4+
* MySQL
* Bootstrap
* REST API
* JSON

---

# Developer

<div align="center">

### Projek Tugas Akhir / Skripsi

### Gilang Akhbara Rimbawan

</div>