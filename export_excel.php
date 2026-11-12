<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

// Ambil semua order untuk diexport
$stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmt->fetchAll();

// Header untuk file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_order_" . date('Ymd_His') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Order - Excel</title>
</head>
<body>
    <h2>Laporan Data Order</h2>
    <p>Tanggal export: <?php echo date('d/m/Y H:i:s'); ?></p>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr style="background:#8e44ad; color:white;">
                <th>#</th>
                <th>Nama Order</th>
                <th>Tim Order</th>
                <th>Jumlah</th>
                <th>Jenis Order</th>
                <th>Jenis Bahan</th>
                <th>Tgl Transfer</th>
                <th>Pembayaran</th>
                <th>Jenis Krah</th>
                <th>Dateline</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $index => $o): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($o['nama_order']); ?></td>
                        <td><?php echo htmlspecialchars($o['tim_order']); ?></td>
                        <td><?php echo (int)$o['jumlah']; ?></td>
                        <td><?php echo htmlspecialchars($o['jenis_order']); ?></td>
                        <td><?php echo htmlspecialchars($o['jenis_bahan']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($o['tanggal_transfer'])); ?></td>
                        <td><?php echo htmlspecialchars($o['pembayaran']); ?></td>
                        <td><?php echo htmlspecialchars($o['jenis_krah']); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($o['dateline'])); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($o['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11" style="text-align:center;">Belum ada data order.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>