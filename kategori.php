<?php
session_start();

// 1. Proteksi Halaman
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Inventaris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Daftar Kategori</h2>
            <div style="text-align: right;">
                <span class="badge badge-success">ADMIN: <?= strtoupper($_SESSION['username'] ?? 'ADMIN') ?></span>
                <a href="logout.php" class="btn btn-outline" style="padding: 5px 15px; margin-left: 10px; font-size: 0.8rem;">Logout</a>
            </div>
        </div>

        <div class="nav-menu" style="display: flex; gap: 10px; margin-bottom: 25px;">
            <a href="index.php" class="btn btn-outline">Kelola Barang</a>
            <a href="kategori.php" class="btn btn-primary">Kelola Kategori</a>
        </div>

        <a href="tambah_kategori.php" class="btn btn-success" style="margin-bottom: 20px;">+ Tambah Kategori</a>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="width: 80px; text-align: center;">NO</th>
                        <th>NAMA KATEGORI</th>
                        <th style="text-align: center; width: 200px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pastikan query ke database benar
                    $sql = "SELECT * FROM kategori ORDER BY id DESC";
                    $query = mysqli_query($conn, $sql);
                    $no = 1;

                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td><strong><?= htmlspecialchars($row['nama_kategori']) ?></strong></td>
                                <td style="text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <a href="edit_kategori.php?id=<?= $row['id'] ?>" class="btn" style="background: #f1c40f; color: white; padding: 6px 12px; font-size: 0.75rem;">Edit</a>
                                        <a href="hapus_kategori.php?id=<?= $row['id'] ?>" class="btn" style="background: #e74c3c; color: white; padding: 6px 12px; font-size: 0.75rem;" onclick="return confirm('Yakin ingin menghapus kategori ini? Data barang dengan kategori ini mungkin akan terpengaruh.')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Tampilan jika tabel kosong
                        echo "<tr><td colspan='3' style='text-align:center; padding: 40px; color: #64748b;'>Belum ada data kategori. Klik tombol di atas untuk menambah.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>