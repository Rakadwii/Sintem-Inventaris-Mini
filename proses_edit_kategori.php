<?php
include 'koneksi.php';
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama' WHERE id=$id");
    header("Location: kategori.php");
}
?>