<?php
require_once 'config/database.php';
require_once 'includes/auth.php';

$error = '';
$success = '';

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
                INSERT INTO orders 
                (nama_order, tim_order, jumlah, jenis_order, jenis_bahan, tanggal_transfer, pembayaran, jenis_krah, dateline) 
                VALUES (:nama_order, :tim_order, :jumlah, :jenis_order, :jenis_bahan, :tanggal_transfer, :pembayaran, :jenis_krah, :dateline)
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
            ]);
            header('Location: index.php?success=Order berhasil ditambahkan.');
            exit;
        } catch (PDOException $e) {
            $error = 'Gagal menyimpan data: ' . $e->getMessage();
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
        <h2>📝 Tambah Order Baru</h2>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group">
                    <label class="required">Nama Order</label>
                    <input type="text" name="nama_order" placeholder="Contoh: Order Tim Bola A" 
                           value="<?php echo htmlspecialchars($_POST['nama_order'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label class="required">Tim Order</label>
                    <input type="text" name="tim_order" placeholder="Contoh: Tim Senja" 
                           value="<?php echo htmlspecialchars($_POST['tim_order'] ?? ''); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required">Jumlah</label>
                    <input type="number" name="jumlah" min="1" value="<?php echo htmlspecialchars($_POST['jumlah'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label class="required">Jenis Order</label>
                    <select name="jenis_order" required>
                        <option value="">-- Pilih --</option>
                        <option value="JAKET" <?php echo (($_POST['jenis_order'] ?? '') === 'JAKET') ? 'selected' : ''; ?>>JAKET</option>
                        <option value="JERSEY" <?php echo (($_POST['jenis_order'] ?? '') === 'JERSEY') ? 'selected' : ''; ?>>JERSEY</option>
                        <option value="CELANA TRAINING" <?php echo (($_POST['jenis_order'] ?? '') === 'CELANA TRAINING') ? 'selected' : ''; ?>>CELANA TRAINING</option>
                        <option value="SETELAN TRAINING" <?php echo (($_POST['jenis_order'] ?? '') === 'SETELAN TRAINING') ? 'selected' : ''; ?>>SETELAN TRAINING</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="required">Jenis Bahan Yang Dipakai</label>
                <input type="text" name="jenis_bahan" placeholder="Contoh: Dri-Fit, Parachute, Cotton" 
                       value="<?php echo htmlspecialchars($_POST['jenis_bahan'] ?? ''); ?>" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="required">Tanggal Transfer Masuk</label>
                    <input type="date" name="tanggal_transfer" value="<?php echo htmlspecialchars($_POST['tanggal_transfer'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label class="required">Pembayaran</label>
                    <select name="pembayaran" required>
                        <option value="">-- Pilih --</option>
                        <option value="DP" <?php echo (($_POST['pembayaran'] ?? '') === 'DP') ? 'selected' : ''; ?>>DP (Down Payment)</option>
                        <option value="LUNAS" <?php echo (($_POST['pembayaran'] ?? '') === 'LUNAS') ? 'selected' : ''; ?>>LUNAS</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required">Jenis Krah</label>
                    <input type="text" name="jenis_krah" placeholder="Contoh: Bordir, Sablon, Heat Press" 
                           value="<?php echo htmlspecialchars($_POST['jenis_krah'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label class="required">Dateline</label>
                    <input type="date" name="dateline" value="<?php echo htmlspecialchars($_POST['dateline'] ?? ''); ?>" required>
                </div>
            </div>

            <div class="form-actions">
                <a href="index.php" class="btn" style="background:#6c757d;color:white;">Batal</a>
                <button type="submit" class="btn btn-success">💾 Simpan Order</button>
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>