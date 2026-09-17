<?php
include_once("dbconnection.php");

// 1. Fungsi Pencatatan Log
function catat_log($aksi, $detail) {
    $file = 'log_aktivitas.txt';
    $waktu = date('Y-m-d H:i:s');
    $log = "$waktu $aksi $detail\n";
    file_put_contents($file, $log, FILE_APPEND);
}

// 2. Fungsi Tampilkan Flash Message
function tampilkan_flash() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['flash_message'])) {
        echo '<div style="color: red; font-weight: bold; margin-bottom: 15px;">' 
             . htmlspecialchars($_SESSION['flash_message']) . 
             '</div>';
        unset($_SESSION['flash_message']);
    }
}

// 3. Fungsi Proteksi Autentikasi Halaman
function cek_autentikasi() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_obj']) || !$_SESSION['user_obj']->isLoggedIn()) {
        $_SESSION['flash_message'] = "Anda harus login terlebih dahulu!";
        header("Location: login.php");
        exit();
    }
}

// 4. Fungsi Validasi Registrasi 
function validasi_registrasi($nama, $email, $password) {
    global $conn;

    // A. Seluruh input tidak boleh kosong
    if (empty($nama) || empty($email) || empty($password)) {
        return "Seluruh input wajib diisi!";
    }

    // B. Format email harus valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Format email tidak valid!";
    }

    // C. Panjang password minimal 8 karakter
    if (strlen($password) < 8) {
        return "Panjang password minimal 8 karakter!";
    }

    // D. Email belum terdaftar pada table "user"
    $query = 'SELECT * FROM "user" WHERE email = $1';
    $res = pg_query_params($conn, $query, array($email));
    if ($res && pg_num_rows($res) > 0) {
        return "Email sudah terdaftar pada sistem!";
    }

    return null; // Return null artinya validasi lolos
}
?>