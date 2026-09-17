<?php 
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once("bootstrap.php"); 

$wajib = ['nama', 'email', 'password'];
if (!Validasi::tidak_kosong($_POST, $wajib)) {
    if (class_exists('Flash')) Flash::set("Semua kolom wajib diisi.");
    header("Location: registrasi.php");
    exit();
}

$email      = strtolower(trim($_POST['email']));
$password   = $_POST['password'];
$repassword = $_POST['repassword'] ?? $_POST['retype_password'] ?? '';

if (!Validasi::email_valid($email)) {
    if (class_exists('Flash')) Flash::set("Format email tidak valid.");
    header("Location: registrasi.php");
    exit();
}

if (!Validasi::password_kuat($password)) {
    if (class_exists('Flash')) Flash::set("Password minimal 8 karakter, harus ada huruf besar, kecil, dan angka.");
    header("Location: registrasi.php");
    exit();
}

if ($password !== $repassword) { 
    if (class_exists('Flash')) Flash::set("Password dan Konfirmasi Password tidak cocok."); 
    header("Location: registrasi.php"); 
    exit(); 
} 

try { 
    $db           = new DBconnection(); 
    $userModel    = new UserModel($db);
    $pemilikModel = new PemilikModel($db);
    $dokterModel  = new DokterModel($db);

    if ($userModel->find_by_email($email) !== null) { 
        if (class_exists('Flash')) Flash::set("Email tersebut sudah terdaftar."); 
        $db->close_connection();
        header("Location: registrasi.php"); 
        exit(); 
    } 

    $db->mulai_transaksi();

   
    $respon = $userModel->insert($_POST); 

    if ($respon->status && !empty($respon->data)) { 
        $iduser = (int) $respon->data[0]['iduser']; 
        $idrole = (int) ($_POST['idrole'] ?? 0);
        if ($idrole > 0) {
            $userModel->simpan_role_aktif($iduser, $idrole);
        }

        
        $no_wa  = trim($_POST['no_wa'] ?? '');
        $alamat = trim($_POST['alamat'] ?? '');
        if ($no_wa !== '' && $alamat !== '') {
            $pemilikModel->insert([
                'no_wa'  => $no_wa,
                'alamat' => $alamat,
                'iduser' => $iduser,
            ]);
        }

        $no_izin      = trim($_POST['no_izin'] ?? '');
        $spesialisasi = trim($_POST['spesialisasi'] ?? '');

        if ($no_izin !== '' && $spesialisasi !== '') {
            $dokterModel->insert([
                'no_izin'      => $no_izin,
                'spesialisasi' => $spesialisasi,
                'iduser'       => $iduser,
            ]);
        }

        $db->commit();

        if (class_exists('Log')) Log::catat("REGISTRASI", ["email" => $email, "iduser" => $iduser]); 
        if (class_exists('Flash')) Flash::set("Registrasi berhasil. Silakan login."); 
        
        $db->close_connection();
        ob_end_clean();
        header("Location: login.php"); 
        exit(); 
    } else { 
        $db->rollback();
        if (class_exists('Flash')) Flash::set("Registrasi gagal: " . $respon->message); 
    } 

    $db->close_connection(); 
} catch (Exception $e) { 
    if (isset($db)) $db->rollback();
    if (class_exists('Flash')) Flash::set("Kesalahan database: " . $e->getMessage()); 
} 

ob_end_clean();
header("Location: registrasi.php"); 
exit();