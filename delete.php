<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?error=ID order tidak valid.');
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header('Location: index.php?success=Order berhasil dihapus.');
    exit;
} catch (PDOException $e) {
    header('Location: index.php?error=Gagal menghapus data: ' . urlencode($e->getMessage()));
    exit;
}