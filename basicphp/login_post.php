<?php
    include_once("dbconnection.php");
    include_once("fungsi_lib.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $row = cari_user_by_email($dbconn, $username);

    if ($row === null) {
        catat_log("LOGIN", ["email" => $username, "status" => "GAGAL", "ip" => $_SERVER['REMOTE_ADDR']]);
        set_flash("Email tidak terdaftar.");
        header("Location: login.php");
        exit();
    }

    if (!password_verify($password, $row['password'])) {
        catat_log("LOGIN", ["email" => $username, "status" => "GAGAL", "ip" => $_SERVER['REMOTE_ADDR']]);
        set_flash("Password salah.");
        header("Location: login.php");
        exit();
    }

    mulai_session();
    $_SESSION['user'] = array(
        'id'        => $row['iduser'],
        'nama'      => $row['nama'],
        'email'     => $row['email'],
        'logged_in' => true
    );

    catat_log("LOGIN", ["email" => $username, "status" => "SUKSES", "ip" => $_SERVER['REMOTE_ADDR']]);
    pg_close($dbconn);
    header("Location: dashboard.php");
    exit();
?>
