<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = :id");
$stmt->execute(['id' => $id]);
$order = $stmt->fetch();

if (!$order) {
    header('Location: index.php?error=Order tidak ditemukan.');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran - Order #<?php echo $order['id']; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="nota-container">
        <a href="index.php" class="btn btn-primary no-print">← Kembali ke Data Order</a>

        <div class="nota-card">
            <div class="nota-header">
                <div>
                    <div class="nota-title">🧾 NOTA PEMBAYARAN</div>
                    <div style="color: var(--purple-dark); font-weight: 700; font-size: 1.1rem;">Order #<?php echo $order['id']; ?></div>
                </div>
                <div class="nota-meta">
                    <div><strong>Tanggal Nota:</strong> <?php echo date('d/m/Y H:i'); ?></div>
                    <div><strong>Status:</strong> 
                        <span class="badge badge-<?php echo strtolower($order['pembayaran']); ?>">
                            <?php echo htmlspecialchars($order['pembayaran']); ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="nota-body">
                <table>
                    <tr>
                        <th>Nama Order</th>
                        <td><?php echo htmlspecialchars($order['nama_order']); ?></td>
                    </tr>
                    <tr>
                        <th>Tim Order</th>
                        <td><?php echo htmlspecialchars($order['tim_order']); ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td><?php echo (int)$order['jumlah']; ?> pcs</td>
                    </tr>
                    <tr>
                        <th>Jenis Order</th>
                        <td><?php echo htmlspecialchars($order['jenis_order']); ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Bahan</th>
                        <td><?php echo htmlspecialchars($order['jenis_bahan']); ?></td>
                    </tr>
                    <tr>
                        <th>Jenis Krah</th>
                        <td><?php echo htmlspecialchars($order['jenis_krah']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Transfer Masuk</th>
                        <td><?php echo date('d/m/Y', strtotime($order['tanggal_transfer'])); ?></td>
                    </tr>
                    <tr>
                        <th>Pembayaran</th>
                        <td><?php echo htmlspecialchars($order['pembayaran']); ?></td>
                    </tr>
                    <tr>
                        <th>Dateline</th>
                        <td><?php echo date('d/m/Y', strtotime($order['dateline'])); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Input</th>
                        <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                    </tr>
                </table>

                <div class="nota-footer">
                    <div class="signature">
                        <div class="signature-line"></div>
                        <div>Pembuat Nota</div>
                    </div>
                    <div class="signature">
                        <div class="signature-line"></div>
                        <div>Diterima Oleh</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="print-btn">
            <button onclick="window.print()" class="btn btn-success no-print">🖨️ Cetak Nota</button>
        </div>
    </div>
</body>
</html>