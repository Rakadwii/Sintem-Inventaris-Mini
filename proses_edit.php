<?php
include 'koneksi.php';
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama_barang'];
    $stok = $_POST['stok'];

    mysqli_query($conn, "UPDATE barang SET nama_barang='$nama', stok='$stok' WHERE id=$id");
    header("Location: index.php");
}
?>