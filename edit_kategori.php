<?php
session_start();
// Proteksi Halaman
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    header("Location: kategori.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Ambil data kategori berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '$id'");
$k = mysqli_fetch_assoc($query);

// Cek jika data tidak ditemukan
if (!$k) {
    die("Error: Data kategori tidak ditemukan!");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - Inventaris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <div style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2); width: 100%; max-width: 450px;">
        
        <div style="border-bottom: 3px solid #10b981; width: 50px; margin-bottom: 15px;"></div>
        <h2 style="margin: 0; color: #2d3748; font-size: 1.8rem;">Edit Kategori</h2>
        <p style="color: #718096; margin-bottom: 30px; font-size: 0.9rem;">Silakan ubah informasi kategori di bawah ini.</p>

        <form action="proses_edit_kategori.php" method="POST">
            <input type="hidden" name="id" value="<?= $k['id'] ?>">

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; color: #4a5568; font-weight: 600; font-size: 0.85rem;">Nama Kategori</label>
                <input type="text" name="nama_kategori" 
                       value="<?= htmlspecialchars($k['nama_kategori']) ?>" 
                       style="width: 100%; padding: 12px 15px; border: 1.5px solid #e2e8f0; border-radius: 10px; font-size: 1rem; transition: all 0.3s;"
                       required>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 10px;">
                <button type="submit" name="update" 
                        style="flex: 1; background: #10b981; color: white; border: none; padding: 12px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: background 0.3s;">
                    Update Data
                </button>
                <a href="kategori.php" 
                   style="flex: 1; background: #a0aec0; color: white; text-decoration: none; text-align: center; padding: 12px; border-radius: 10px; font-weight: 600; transition: background 0.3s;">
                    Batal
                </a>
            </div>
        </form>
    </div>

</body>
</html>