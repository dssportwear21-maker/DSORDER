<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: index.php?error=ID order tidak valid.');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = :id");
$stmt->execute(['id' => $id]);
$order = $stmt->fetch();

if (!$order) {
    header('Location: index.php?error=Order tidak ditemukan.');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_order    = trim($_POST['nama_order'] ?? '');
    $tim_order     = trim($_POST['tim_order'] ?? '');
    $jumlah        = (int)($_POST['jumlah'] ?? 0);
    $jenis_order   = $_POST['jenis_order'] ?? '';
    $jenis_bahan   = trim($_POST['jenis_bahan'] ?? '');
    $tgl_transfer  = $_POST['tanggal_transfer'] ?? '';
    $pembayaran    = $_POST['pembayaran'] ?? '';
    $jenis_krah    = trim($_POST['jenis_krah'] ?? '');
    $dateline      = $_POST['dateline'] ?? '';

    if (empty($nama_order) || empty($tim_order) || empty($jenis_order) || 
        empty($jenis_bahan) || empty($tgl_transfer) || empty($pembayaran) || 
        empty($jenis_krah) || empty($dateline) || $jumlah <= 0) {
        $error = 'Semua field wajib diisi dan jumlah harus lebih dari 0.';
    } else {
        try {
            $stmt = $pdo->prepare("
                UPDATE orders 
                SET nama_order = :nama_order, tim_order = :tim_order, jumlah = :jumlah,
                    jenis_order = :jenis_order, jenis_bahan = :jenis_bahan, 
                    tanggal_transfer = :tanggal_transfer, pembayaran = :pembayaran,
                    jenis_krah = :jenis_krah, dateline = :dateline
                WHERE id = :id
            ");
            $stmt->execute([
                'nama_order'     => $nama_order,
                'tim_order'      => $tim_order,
                'jumlah'         => $jumlah,
                'jenis_order'    => $jenis_order,
                'jenis_bahan'    => $jenis_bahan,
                'tanggal_transfer' => $tgl_transfer,
                'pembayaran'     => $pembayaran,
                'jenis_krah'     => $jenis_krah,
                'dateline'       => $dateline,
                'id'             => $id,
            ]);
            header('Location: index.php?success=Order berhasil diperbarui.');
            exit;
        } catch (PDOException $e) {
            $error = 'Gagal memperbarui data: ' . $e->getMessage();
        }
    }
}

include 'includes/header.php';
?>

<div class="container">
    <?php if ($error): ?>
        <div class="flash error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div class="form-container">
        <h2>✏️ Edit Order</h2>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group">
                    <label class="required">Nama Order</label>
                    <input type="text" name="nama_order" placeholder="Contoh: Order Tim Bola A" 
                           value="<?php echo htmlspecialchars($order['nama_order']); ?>" required>
                </div>
                <div class="form-group">
                    <label class="required">Tim Order</label>
                    <input type="text" name="tim_order" placeholder="Contoh: Tim Senja" 
                           value="<?php echo htmlspecialchars($order['tim_order']); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required">Jumlah</label>
                    <input type="number" name="jumlah" min="1" value="<?php echo (int)$order['jumlah']; ?>" required>
                </div>
                <div class="form-group">
                    <label class="required">Jenis Order</label>
                    <select name="jenis_order" required>
                        <option value="JAKET" <?php echo ($order['jenis_order'] === 'JAKET') ? 'selected' : ''; ?>>JAKET</option>
                        <option value="JERSEY" <?php echo ($order['jenis_order'] === 'JERSEY') ? 'selected' : ''; ?>>JERSEY</option>
                        <option value="CELANA TRAINING" <?php echo ($order['jenis_order'] === 'CELANA TRAINING') ? 'selected' : ''; ?>>CELANA TRAINING</option>
                        <option value="SETELAN TRAINING" <?php echo ($order['jenis_order'] === 'SETELAN TRAINING') ? 'selected' : ''; ?>>SETELAN TRAINING</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="required">Jenis Bahan Yang Dipakai</label>
                <input type="text" name="jenis_bahan" placeholder="Contoh: Dri-Fit, Parachute, Cotton" 
                       value="<?php echo htmlspecialchars($order['jenis_bahan']); ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="required">Tanggal Transfer Masuk</label>
                    <input type="date" name="tanggal_transfer" value="<?php echo htmlspecialchars($order['tanggal_transfer']); ?>" required>
                </div>
                <div class="form-group">
                    <label class="required">Pembayaran</label>
                    <select name="pembayaran" required>
                        <option value="DP" <?php echo ($order['pembayaran'] === 'DP') ? 'selected' : ''; ?>>DP (Down Payment)</option>
                        <option value="LUNAS" <?php echo ($order['pembayaran'] === 'LUNAS') ? 'selected' : ''; ?>>LUNAS</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required">Jenis Krah</label>
                    <input type="text" name="jenis_krah" placeholder="Contoh: Bordir, Sablon, Heat Press" 
                           value="<?php echo htmlspecialchars($order['jenis_krah']); ?>" required>
                </div>
                <div class="form-group">
                    <label class="required">Dateline</label>
                    <input type="date" name="dateline" value="<?php echo htmlspecialchars($order['dateline']); ?>" required>
                </div>
            </div>

            <div class="form-actions">
                <a href="index.php" class="btn" style="background:#6c757d;color:white;">Batal</a>
                <button type="submit" class="btn btn-success">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>