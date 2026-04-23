<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Barang Baru</h2>
        <form action="proses_tambah.php" method="POST">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" required>
            </div>

            <div class="form-group">
    <label>Kategori</label>
    <select name="kategori_id" required>
        <option value="">-- Pilih Kategori --</option>
        <?php
        include 'koneksi.php';
        
        // Ambil data kategori
        $kat_query = mysqli_query($conn, "SELECT * FROM kategori");

        // Cek apakah query berhasil
        if ($kat_query) {
            // Cek apakah ada data di tabel kategori
            if (mysqli_num_rows($kat_query) > 0) {
                while ($kat = mysqli_fetch_assoc($kat_query)) {
                    echo "<option value='{$kat['id']}'>{$kat['nama_kategori']}</option>";
                }
            } else {
                echo "<option value=''>Kategori masih kosong!</option>";
            }
        } else {
            // Tampilkan error jika query bermasalah
            echo "<option value=''>Error: " . mysqli_error($conn) . "</option>";
        }
        ?>
    </select>
</div>

            <button type="submit" name="submit" class="btn btn-success">Simpan Barang</button>
            <a href="index.php" class="btn" style="background:#95a5a6; color:white;">Kembali</a>
        </form>
    </div>
</body>
</html>