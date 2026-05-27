<div align="center">
  <h1>Website Inventory (IMS v2)</h1>
  <p>
    <strong>Aplikasi Manajemen Inventaris Berbasis Web - Projek Skripsi</strong>
  </p>
  <p>
    <img src="https://img.shields.io/badge/CodeIgniter-3.x-EF4223?style=flat-square&logo=codeigniter&logoColor=white" alt="CodeIgniter 3" />
    <img src="https://img.shields.io/badge/PHP-7.4+-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP Version" />
    <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL" />
    <img src="https://img.shields.io/badge/Bootstrap-Framework-563D7C?style=flat-square&logo=bootstrap&logoColor=white" alt="Bootstrap" />
  </p>
</div>

---

## Deskripsi Proyek

**Website Inventory (IMS v2)** adalah sebuah Sistem Manajemen Inventaris yang dibangun sebagai bagian dari Projek Skripsi. Aplikasi ini dirancang untuk memudahkan pencatatan, pelacakan, dan pengelolaan barang secara digital, efisien, dan terstruktur.

## Fitur Utama

- **Autentikasi Pengguna**: Sistem login yang aman dengan pembagian hak akses (Role-based access).
- **Manajemen Barang**: Tambah, edit, hapus, dan lihat data barang dengan mudah.
- **Barang Masuk & Keluar**: Pencatatan transaksi stok barang masuk dan keluar secara real-time.
- **Laporan Terintegrasi**: Pembuatan laporan inventaris yang bisa di-export ke format cetak, PDF, atau Excel.
- **Desain Responsif**: Antarmuka pengguna (UI) yang nyaman diakses melalui perangkat desktop maupun mobile.

## Teknologi yang Digunakan

- **Backend**: [CodeIgniter 3](https://codeigniter.com/userguide3/) (PHP Framework)
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap
- **Database**: MySQL
- **Web Server**: Apache (via Laragon / XAMPP)

## Prasyarat (Prerequisites)

Sebelum menjalankan aplikasi ini, pastikan sistem Anda memiliki:
- **PHP** (disarankan versi 7.4)
- **MySQL** Database Server
- **Web Server** (Apache/Nginx, terintegrasi di Laragon atau XAMPP)

## Panduan Instalasi (Localhost)

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di komputer lokal:

1. **Clone Repository**
   ```bash
   git clone https://github.com/GilangRimbawan/websiteinvemtory.git
   ```

2. **Pindahkan ke Direktori Web Server**
   - Pindahkan folder proyek ke `htdocs` (jika menggunakan XAMPP) atau `www` (jika menggunakan Laragon).
   - Pastikan nama foldernya adalah `imsv2` (sesuai URL localhost Anda).

3. **Konfigurasi Database**
   - Buka phpMyAdmin (`http://localhost/phpmyadmin`).
   - Buat database baru (contoh: `db_inventory` atau sesuaikan dengan file SQL Anda).
   - Import file SQL yang berada di dalam folder `DATABASE_FILE/` ke database yang baru dibuat.

4. **Konfigurasi Sistem (CodeIgniter)**
   - Buka file `application/config/database.php`.
   - Sesuaikan konfigurasi database:
     ```php
     'hostname' => 'localhost',
     'username' => 'root', // Sesuaikan dengan user mysql Anda
     'password' => '',     // Kosongkan jika default
     'database' => 'nama_database_anda', // Nama database yang Anda buat
     ```
   - Buka file `application/config/config.php` dan pastikan `base_url` sudah sesuai dengan path lokal Anda:
     ```php
     $config['base_url'] = 'http://localhost/imsv2/';
     ```

5. **Jalankan Aplikasi**
   - Buka browser dan akses URL: `http://localhost/imsv2`


## Pengembang

- **Gilang Rimbawan** - *Projek Skripsi* - [Profil GitHub](https://github.com/GilangRimbawan)

## Lisensi

Proyek ini didistribusikan di bawah Lisensi MIT. Lihat file `license.txt` untuk informasi lebih lanjut.
