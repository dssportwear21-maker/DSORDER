# 📋 Sistem Pencatatan Order

Website pencatatan order lengkap untuk jenis pakaian olahraga (jaket, jersey, celana training, setelan training). **Siap upload ke hosting** dengan tema Glass (putih + ungu), Login Admin, Export Excel, dan Nota Pembayaran.

## 📁 Struktur File

```
sistem-order/
├── config/
│   └── database.php        # Koneksi database (PDO)
├── includes/
│   ├── auth.php            # Proteksi halaman (harus login)
│   ├── header.php          # Header + navigasi (glass theme)
│   └── footer.php          # Footer
├── assets/
│   ├── css/
│   │   └── style.css       # Glassmorphism CSS (putih + ungu)
│   └── js/
│       └── script.js       # Interaksi frontend
├── database.sql            # Skema database (import ke phpMyAdmin)
├── install.php             # Buat admin default (hapus setelah pakai)
├── index.php               # Daftar order + pencarian + link nota
├── login.php               # Halaman login admin
├── logout.php              # Logout
├── create.php              # Tambah order baru
├── edit.php                # Edit order
├── delete.php              # Hapus order
├── export_excel.php        # Export data ke Excel (.xls)
├── nota.php                # Cetak nota pembayaran per order
└── README.md               # Panduan ini
```

## 🚀 Cara Install (Upload ke Hosting)

### 1. Buat Database
- Login ke cPanel / phpMyAdmin hosting Anda.
- Buat database baru, misalnya nama: `sistem_order`.
- Import file `database.sql` ke database tersebut.

### 2. Konfigurasi Koneksi
Buka file `config/database.php` dan sesuaikan:

```php
$host = 'localhost';
$dbname = 'sistem_order';   // nama database Anda
$username = 'root';         // username database hosting
$password = '';             // password database hosting
```

### 3. Buat Admin Default
Jalankan `install.php` melalui browser:
```
https://domainanda.com/sistem-order/install.php
```
Ini akan membuat admin default:
- **Username:** `admin`
- **Password:** `admin123`

⚠️ **Hapus file `install.php` setelah selesai** untuk alasan keamanan.

### 4. Upload File
Upload semua file dalam folder `sistem-order/` ke `public_html` (atau folder root website) hosting Anda melalui FTP / File Manager cPanel.

### 5. Akses Website
Buka browser dan kunjungi:
```
https://domainanda.com/sistem-order/login.php
```
Login dengan username `admin` dan password `admin123`.

## ✅ Fitur Utama

| Fitur | Keterangan |
|-------|------------|
| 🔐 **Login Admin** | Sistem autentikasi dengan session, hanya admin yang bisa mengakses |
| 📊 **Data Order** | Tabel lengkap dengan pencarian real-time |
| ➕ **Tambah / ✏️ Edit / 🗑️ Hapus** | CRUD lengkap dengan validasi input |
| 🧾 **Nota Pembayaran** | Cetak nota per order dengan detail pembayaran |
| 📤 **Export Excel** | Export semua data order ke file .xls |
| 🎨 **Glass Theme** | Desain glassmorphism putih + ungu, responsif mobile |
| 🛡️ **Keamanan** | PDO prepared statements (anti SQL Injection), proteksi halaman |

## 📋 Field Order

| Field | Keterangan |
|-------|------------|
| Nama Order | Nama pemesan / judul order |
| Tim Order | Nama tim / divisi |
| Jumlah | Banyaknya item |
| Jenis Order | JAKET, JERSEY, CELANA TRAINING, SETELAN TRAINING |
| Jenis Bahan | Bahan yang digunakan (contoh: Dri-Fit, Parachute) |
| Tanggal Transfer Masuk | Tanggal transfer pembayaran |
| Pembayaran | DP atau LUNAS |
| Jenis Krah | Jenis kerah / finishing |
| Dateline | Tanggal batas selesai |

## 🔧 Kebutuhan Server

- PHP 7.4 atau lebih baru
- MySQL / MariaDB
- Ekstensi PDO (`pdo_mysql`)

## 📄 Lisensi

Gratis untuk digunakan dan dikembangkan.