<?php include_once("fungsi_lib.php"); ?>

<!DOCTYPE html>
<html lang="id">
<head><title>Registrasi</title></head>
<body>
    <h1>Halaman Registrasi</h1>
    <?php tampilkan_flash(); ?>

    <form action="proses_registrasi.php" method="POST">
        <label>Nama:</label>            <input type="text" name="nama" required><br><br>
        <label>Email:</label>           <input type="email" name="email" required><br><br>
        <label>Password:</label>        <input type="password" name="password" required><br><br>
        <label>Retype Password:</label> <input type="password" name="retype_password" required><br><br>
        <input type="submit" value="Daftar">
    </form>
</body>
</html>
