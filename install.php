<?php
require_once 'config/database.php';

try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $count = $stmt->fetchColumn();
    if ($count > 0) {
        echo "<h3>Admin sudah terdaftar.</h3><p>Hapus file <code>install.php</code> untuk alasan keamanan.</p><a href='login.php'>Kembali ke Login</a>";
        exit;
    }
} catch (PDOException $e) {
    echo "Tabel users belum ada. Import dulu database.sql.";
    exit;
}

$hash = password_hash('admin123', PASSWORD_DEFAULT);
$pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'admin')")
    ->execute(['admin', $hash]);

echo "<h3>✅ Admin berhasil dibuat!</h3>";
echo "<p><strong>Username:</strong> admin</p>";
echo "<p><strong>Password:</strong> admin123</p>";
echo "<p>Silakan hapus file <code>install.php</code> setelah ini.</p>";
echo "<a href='login.php'>➡️ Klik di sini untuk Login</a>";