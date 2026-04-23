<?php
session_start();

// 1. Proteksi Halaman
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// 2. WAJIB include file koneksi di sini
include 'koneksi.php';

// 3. Ambil ID dari URL dan pastikan ada
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// 4. Ambil data barang yang akan diedit
$sql = "SELECT * FROM barang WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

// Cek apakah data ditemukan
if (mysqli_num_rows($result) > 0) {
    $b = mysqli_fetch_assoc($result);
} else {
    die("Data tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang - Inventaris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 600px;">
        <h2>Edit Data Barang</h2>
        <p style="color: var(--text-secondary); margin-bottom: 20px;">Silakan ubah informasi barang di bawah ini.</p>

        <form action="proses_edit.php" method="POST">
            <input type="hidden" name="id" value="<?= $b['id'] ?>">

            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" value="<?= htmlspecialchars($b['nama_barang']) ?>" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" value="<?= htmlspecialchars($b['stok']) ?>" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" required>
                    <?php
                    $kat_query = mysqli_query($conn, "SELECT * FROM kategori");
                    while ($kat = mysqli_fetch_assoc($kat_query)) {
                        // Logika agar kategori yang sudah dipilih otomatis terpilih (selected)
                        $selected = ($kat['id'] == $b['kategori_id']) ? "selected" : "";
                        echo "<option value='{$kat['id']}' $selected>{$kat['nama_kategori']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div style="margin-top: 30px; display: flex; gap: 10px;">
                <button type="submit" name="submit" class="btn btn-success">Update Data</button>
                <a href="index.php" class="btn btn-outline" style="background: #95a5a6; color: white; border: none;">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>