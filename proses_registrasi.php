<?php
    include_once("dbconnection.php");
    include_once("fungsi_lib.php");

    $nama            = $_POST['nama'];
    $email           = strtolower(trim($_POST['email']));
    $password        = $_POST['password'];
    $retype_password = $_POST['retype_password'];

    if ($password !== $retype_password) {
        set_flash("Password dan Retype Password tidak cocok.");
        header("Location: registrasi.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query  = 'INSERT INTO "user" (nama, email, password) VALUES ($1, $2, $3) RETURNING iduser';
    $result = pg_query_params($dbconn, $query, array($nama, $email, $hashed_password));

    if ($result) {
        $baris = pg_fetch_assoc($result);
        set_flash("Registrasi berhasil. ID pengguna: " . $baris['iduser']);
    } else {
        set_flash("Terjadi kesalahan: " . pg_last_error($dbconn));
    }

    pg_close($dbconn);
    header("Location: registrasi.php");
    exit();
?>
