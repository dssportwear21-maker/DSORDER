-- ============================================
-- DATABASE SCHEMA: Sistem Pencatatan Order
-- Import file ini ke phpMyAdmin atau MySQL CLI
-- ============================================

CREATE DATABASE IF NOT EXISTS `sistem_order` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sistem_order`;

-- Tabel users (admin login)
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_order` varchar(100) NOT NULL,
  `tim_order` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jenis_order` enum('JAKET','JERSEY','CELANA TRAINING','SETELAN TRAINING') NOT NULL,
  `jenis_bahan` varchar(100) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `pembayaran` enum('DP','LUNAS') NOT NULL,
  `jenis_krah` varchar(100) NOT NULL,
  `dateline` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data contoh (opsional, bisa dihapus)
INSERT INTO `orders` (`nama_order`, `tim_order`, `jumlah`, `jenis_order`, `jenis_bahan`, `tanggal_transfer`, `pembayaran`, `jenis_krah`, `dateline`) VALUES
('Order Tim Bola A', 'Tim Senja', 15, 'JERSEY', 'Dri-Fit', '2026-11-01', 'DP', 'Bordir', '2026-11-20'),
('Order Jaket Tim B', 'Tim Pagi', 10, 'JAKET', 'Parachute', '2026-11-05', 'LUNAS', 'Sablon', '2026-11-25');