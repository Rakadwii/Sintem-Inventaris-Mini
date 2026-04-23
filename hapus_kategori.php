<?php
session_start();
// 1. Proteksi Halaman
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// 2. Cek apakah ada ID yang dikirim
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // 3. Jalankan Query Hapus
    // Simpan hasilnya ke variabel $query agar tidak "Undefined"
    $query = mysqli_query($conn, "DELETE FROM kategori WHERE id = '$id'");

    // 4. Cek apakah query berhasil
    if ($query) {
        // Jika berhasil, balik ke halaman kategori
        header("Location: kategori.php?pesan=hapus_sukses");
        exit;
    } else {
        // Jika gagal (misal kategori masih dipakai di tabel barang)
        echo "Gagal menghapus: " . mysqli_error($conn);
    }
} else {
    // Jika tidak ada ID di URL
    header("Location: kategori.php");
    exit;
}
?>