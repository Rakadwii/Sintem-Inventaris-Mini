<?php
session_start();
// Pastikan hanya yang sudah login yang bisa menghapus
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Jalankan perintah hapus
    $query = mysqli_query($conn, "DELETE FROM barang WHERE id = '$id'");

    if ($query) {
        // Jika berhasil, balikkan ke halaman utama
        header("Location: index.php");
        exit;
    } else {
        die("Gagal menghapus: " . mysqli_error($conn));
    }
} else {
    // Jika tidak ada ID di URL, balik ke index
    header("Location: index.php");
}
?>