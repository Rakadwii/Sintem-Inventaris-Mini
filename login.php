<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Sistem Inventaris</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container" style="max-width: 450px; margin-top: 50px;">
    <h2>Selamat Datang</h2>
    <p style="color: var(--text-secondary); margin-bottom: 30px;">Silakan login untuk mengelola inventaris.</p>
    
    <form action="proses_login.php" method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username..." required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password..." required 
                   style="width: 100%; padding: 14px 16px; border: 2px solid var(--border); border-radius: var(--radius-sm);">
        </div>
        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Masuk ke Sistem</button>
    </form>
</div>
</body>
</html>