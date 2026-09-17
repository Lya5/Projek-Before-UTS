<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("bootstrap.php");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Login</title>
</head>
<body>

    <h2>Halaman Login</h2>

    <?php 
    $pesan = '';

    if (isset($_GET['msg']) && $_GET['msg'] === 'logout') {
        $pesan = "Anda berhasil logout.";
    } elseif (class_exists('Flash') && method_exists('Flash', 'get')) {
        $pesan = Flash::get();
    }

    if (!empty($pesan)) {
        echo "<p style='color: red; font-weight: bold;'>$pesan</p>";
    }
    ?>

    <form action="login_post.php" method="POST">
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required>
        </div>
        <br>
        <div>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <br>
        <button type="submit">Login</button>
    </form>

    <br>
    <p>Belum punya akun? <a href="registrasi.php">Daftar di sini</a></p>

</body>
</html>