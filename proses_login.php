<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) > 0) {
    $_SESSION['login'] = true;
    $_SESSION['username'] = $data['username'];
    header("Location: index.php");
} else {
    echo "<script>alert('Login Gagal!'); window.location='login.php';</script>";
}