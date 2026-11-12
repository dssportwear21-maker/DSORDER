<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

// Ambil parameter pencarian
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Query data order dengan pencarian
if ($search !== '') {
    $stmt = $pdo->prepare("
        SELECT * FROM orders 
        WHERE nama_order LIKE :search 
           OR tim_order LIKE :search 
           OR jenis_order LIKE :search 
           OR jenis_bahan LIKE :search 
           OR jenis_krah LIKE :search
        ORDER BY created_at DESC
    ");
    $stmt->execute(['search' => "%{$search}%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
}
$orders = $stmt->fetchAll();

include 'includes/header.php';
?>

<div class="container">
    <?php if (isset($_GET['success'])): ?>
        <div class="flash success"><?php echo htmlspecialchars($_GET['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="flash error"><?php echo htmlspecialchars($_GET['error']); ?></div>
    <?php endif; ?>

    <div class="search-actions">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari nama order, tim, jenis, bahan, krah..." 
                   value="<?php echo htmlspecialchars($search); ?>">
        </div>
        <a href="create.php" class="btn btn-primary">➕ Tambah Order Baru</a>
    </div>

    <div class="table-wrapper">
        <?php if (count($orders) > 0): ?>
            <table>
                <thead>
                    <tr>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $index => $order): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><strong><?php echo htmlspecialchars($order['nama_order']); ?></strong></td>
                            <td><?php echo htmlspecialchars($order['tim_order']); ?></td>
                            <td><?php echo (int)$order['jumlah']; ?></td>
                            <td>
                                <span class="badge badge-<?php echo strtolower(str_replace(' ', '-', $order['jenis_order'])); ?>">
                                    <?php echo htmlspecialchars($order['jenis_order']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($order['jenis_bahan']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($order['tanggal_transfer'])); ?></td>
                            <td>
                                <span class="badge badge-<?php echo strtolower($order['pembayaran']); ?>">
                                    <?php echo htmlspecialchars($order['pembayaran']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($order['jenis_krah']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($order['dateline'])); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $order['id']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                                <a href="nota.php?id=<?php echo $order['id']; ?>" class="btn btn-info btn-sm">🧾 Nota</a>
                                <a href="delete.php?id=<?php echo $order['id']; ?>" class="btn btn-danger btn-sm btn-delete">🗑️ Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <h3>Belum ada data order</h3>
                <p>Mulai dengan menambahkan order pertama Anda.</p>
                <a href="create.php" class="btn btn-primary">➕ Tambah Order</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const query = this.value;
    const url = new URL(window.location);
    url.searchParams.set('search', query);
    window.location.href = url.toString();
});
</script>