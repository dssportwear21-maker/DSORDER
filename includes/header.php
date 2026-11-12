<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pencatatan Order</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header class="glass-header">
            <div class="brand">
                <h1>📋 Sistem Order</h1>
                <p class="subtitle">Pencatatan Order Jaket, Jersey, Celana & Setelan Training</p>
            </div>
        </header>

        <nav class="glass-nav">
            <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : ''; ?>">📊 Data Order</a>
            <a href="create.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'create.php' ? 'active' : ''; ?>">➕ Tambah Order</a>
            <a href="export_excel.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) === 'export_excel.php' ? 'active' : ''; ?>">📤 Export Excel</a>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="logout.php" class="nav-link btn-logout">🚪 Logout (<?php echo htmlspecialchars($_SESSION['username']); ?>)</a>
            <?php endif; ?>
        </nav>