<?php
// Konfigurasi koneksi database
// Sesuaikan dengan detail hosting Anda (nama database, username, password)
$host = 'localhost';
$dbname = 'sistem_order';
$username = 'root';   // ganti dengan username database hosting Anda
$password = '';       // ganti dengan password database hosting Anda
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}