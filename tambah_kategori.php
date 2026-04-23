<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2>Tambah Kategori</h2>
        <form action="proses_tambah_kategori.php" method="POST">
            <div class="form-group">
                <label>Nama Kategori Baru</label>
                <input type="text" name="nama_kategori" placeholder="Misal: Sembako, Elektronik..." required>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" name="submit" class="btn btn-success">Simpan Kategori</button>
                <a href="kategori.php" class="btn btn-outline" style="background: #95a5a6; color: white; border: none;">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>