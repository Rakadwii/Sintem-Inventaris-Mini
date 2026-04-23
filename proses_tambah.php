<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    $kategori_id = mysqli_real_escape_string($conn, $_POST['kategori_id']);

    if (empty($nama) || empty($stok) || empty($kategori_id)) {
        die("Kesalahan: Semua form wajib diisi!");
    }

    $sql = "INSERT INTO barang (nama_barang, stok, kategori_id) VALUES ('$nama', '$stok', '$kategori_id')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit(); 
    } else {
        die("Error SQL: " . mysqli_error($conn));
    }
} else {
    header("Location: index.php");
    exit();
}
?>