<?php
include 'koneksi.php';
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    header("Location: kategori.php");
}
?>