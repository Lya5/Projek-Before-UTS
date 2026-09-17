<?php
include_once("fungsi_lib.php");

$lines = file('log_aktivitas.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$rekap = array();

foreach ($lines as $line) {
    $kolom = explode(" ", trim($line));
    if (count($kolom) < 3) continue;

    $aksi = $kolom[2];

    // Ambil semua pasangan key-value dalam satu baris (mendukung format '=' maupun '-')
    $data = array();
    for ($i = 3; $i < count($kolom); $i++) {
        // Cek pemisah '=' atau '-'
        if (strpos($kolom[$i], '=') !== false) {
            $kv = explode("=", $kolom[$i], 2);
        } else {
            $kv = explode("-", $kolom[$i], 2);
        }
        
        if (count($kv) == 2) {
            $data[$kv[0]] = $kv[1];
        }
    }

    $email = isset($data['email']) ? $data['email'] : null;
    if (!$email) continue; // Skip jika baris tidak punya email

    // Inisialisasi email di array rekap jika belum ada
    if (!array_key_exists($email, $rekap)) {
        $rekap[$email] = array(
            "email"        => $email,
            "ip"           => isset($data['ip']) ? $data['ip'] : "-",
            "login_sukses" => 0,
            "login_gagal"  => 0,
            "akses"        => array()
        );
    }

    // Olah data berdasarkan Aksi
    if ($aksi == "LOGIN") {
        $status = isset($data['status']) ? $data['status'] : "";
        if ($status == "SUKSES") {
            $rekap[$email]["login_sukses"]++;
        } else if ($status == "GAGAL") {
            $rekap[$email]["login_gagal"]++;
        }
    } else if ($aksi == "AKSES") {
        $rekap[$email]["akses"][] = array(
            "method" => isset($data['method']) ? $data['method'] : "-",
            "url"    => isset($data['url']) ? $data['url'] : "-"
        );
    }
}

echo "<pre>";
print_r($rekap);
echo "</pre>";
?>