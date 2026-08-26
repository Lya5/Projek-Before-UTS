<?php
    include_once("fungsi_lib.php");
    mulai_session();

    if (!isset($_SESSION['user'])) {
        set_flash("Silakan login terlebih dahulu.");
        header("Location: login.php");
        exit();
    }

    $user = $_SESSION['user'];
    catat_log("AKSES", [
        "email"  => $user['email'],
        "method" => $_SERVER['REQUEST_METHOD'],
        "url"    => $_SERVER['REQUEST_URI']
    ]);
?>

<h1>Selamat datang, <?= $user['nama'] ?></h1>
<p>Anda login sebagai <?= $user['email'] ?></p>
<a href="logout.php">Logout</a>
