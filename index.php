<?php
session_start();

// 1. Proteksi Halaman: Wajib login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// 2. Inisialisasi variabel agar tidak muncul "Undefined Variable"
$search = isset($_GET['search']) ? $_GET['search'] : '';

// 3. Persiapan Query SQL dengan LEFT JOIN
$sql = "SELECT barang.*, kategori.nama_kategori 
        FROM barang 
        LEFT JOIN kategori ON barang.kategori_id = kategori.id";

// Jika ada pencarian, tambahkan filter WHERE
if ($search != '') {
    $search_safe = mysqli_real_escape_string($conn, $search);
    $sql .= " WHERE barang.nama_barang LIKE '%$search_safe%'";
}

$sql .= " ORDER BY barang.id DESC";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Inventaris - Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Daftar Inventaris</h2>
            <div style="margin-bottom: 20px; display: flex; gap: 10px;">
    <a href="index.php" class="btn btn-primary">Kelola Barang</a>
    <a href="kategori.php" class="btn btn-outline">Kelola Kategori</a>
</div>
            <div style="text-align: right;">
                <span class="badge badge-success">ADMIN: <?= strtoupper($_SESSION['username']) ?></span>
                <a href="logout.php" class="btn btn-outline" style="padding: 5px 15px; margin-left: 10px; font-size: 0.8rem;">Logout</a>
            </div>
        </div>
        
        <div class="search-container">
            <form method="GET" action="" style="display: flex; width: 100%; gap: 10px;">
                <input type="text" name="search" placeholder="Cari nama barang..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="index.php" class="btn btn-outline">Reset</a>
            </form>
        </div>

        <a href="tambah.php" class="btn btn-success" style="margin-bottom: 20px;">+ Tambah Barang</a>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>NAMA BARANG</th>
                        <th style="width: 100px;">STOK</th>
                        <th style="width: 150px;">KATEGORI</th>
                        <th style="text-align: center; width: 180px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Cek apakah query berhasil dijalankan
                    if ($query) {
                        if (mysqli_num_rows($query) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= htmlspecialchars($row['nama_barang']) ?></strong></td>
                                    <td>
                                        <span class="badge <?= $row['stok'] < 5 ? 'badge-danger' : 'badge-success' ?>">
                                            <?= $row['stok'] ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($row['nama_kategori'] ?? 'Tanpa Kategori') ?></td>
                                    <td style="text-align: center;">
                                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn" style="background:#f1c40f; color:white; padding:6px 12px; font-size:0.75rem;">Edit</a>
                                        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn" style="background:#e74c3c; color:white; padding:6px 12px; font-size:0.75rem;" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align:center; padding: 20px;'>Data tidak ditemukan.</td></tr>";
                        }
                    } else {
                        // Jika query gagal (misal tabel belum dibuat)
                        echo "<tr><td colspan='5' style='text-align:center; color:red; padding: 20px;'>Error Database: " . mysqli_error($conn) . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>