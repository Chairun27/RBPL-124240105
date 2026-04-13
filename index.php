<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem</title>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
<!-- Redirect halaman sesuai role ada di proses_login.php -->
<div class="mobile-wrapper"> 
    <div class="login-header"> 
        <h2>LOGIN KE SISTEM</h2> 
        <br>
        <img src="assets/Logo Toko Elektronik.png" alt="Logo Toko" class="logo">
    </div>
        
        <div class="login-card"> 
            <form action="proses_login.php" method="POST">
                <label>Pilih Role</label>
                <select name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="Kasir">Kasir</option>
                    <option value="Admin">Admin</option>
                    <option value="Petugas_Gudang">Petugas Gudang</option>
                    <option value="Manajer_Gudang">Manajer Gudang</option>
                    <option value="Supplier">Supplier</option>
                </select>

                <label>Username</label>
                <input type="text" name="username" placeholder="Username" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">MASUK</button>
            </form>
        </div>
</div> 
</body>
</html>