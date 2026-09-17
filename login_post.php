<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("bootstrap.php");

$email    = strtolower(trim($_POST['email'] ?? $_POST['username'] ?? ''));
$password = $_POST['password'] ?? '';
$ip       = $_SERVER['REMOTE_ADDR'] ?? '-';

if (!empty($email) && !empty($password)) {
    try {
        $db        = new DBconnection();
        $userModel = new UserModel($db);
        
        // Memanggil verifikasi() yang mengembalikan object User, Pemilik, atau null
        $userObj = $userModel->verifikasi($email, $password);
        $db->close_connection();

        if ($userObj !== null) {
            // Menyimpan data array user dan nama class-nya
            $_SESSION['user']       = $userObj->get_user();
            $_SESSION['jenis_user'] = get_class($userObj);

            if (class_exists('Log')) {
                Log::catat("LOGIN", ["email" => $email, "status" => "SUKSES", "ip" => $ip]);
            }

            header("Location: dashboard.php");
            exit();
        }

        if (class_exists('Log')) {
            Log::catat("LOGIN", ["email" => $email, "status" => "GAGAL", "ip" => $ip]);
        }
        if (class_exists('Flash')) {
            Flash::set("Email atau password salah.");
        }
    } catch (Exception $e) {
        if (class_exists('Flash')) {
            Flash::set("Terjadi kesalahan database: " . $e->getMessage());
        }
    }
} else {
    if (class_exists('Flash')) {
        Flash::set("Email dan password wajib diisi.");
    }
}

header("Location: login.php");
exit();