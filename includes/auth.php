<?php
// Proteksi halaman: hanya yang login boleh mengakses
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}