<?php
    include_once("fungsi_lib.php");

    $lines = file('log_aktivitas.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    $rekap = array();

    foreach ($lines as $line) {
        $kolom = explode(" ", $line);

        if ($kolom[2] == "LOGIN") {
            $email  = ambil_nilai($kolom[3]);
            $status = ambil_nilai($kolom[4]);
            $ip     = ambil_nilai($kolom[5]);

            if (!array_key_exists($email, $rekap)) {
                $rekap[$email] = array(
                    "email"        => $email,
                    "ip"           => $ip,
                    "login_sukses" => 0,
                    "login_gagal"  => 0,
                    "akses"        => array()
                );
            }

            if ($status == "SUKSES") {
                $rekap[$email]["login_sukses"]++;
            } else {
                $rekap[$email]["login_gagal"]++;
            }
        }
        elseif ($kolom[2] == "AKSES") {
            $email  = ambil_nilai($kolom[3]);
            $method = ambil_nilai($kolom[4]);
            $url    = ambil_nilai($kolom[5]);

            // pengaman: baris AKSES yang emailnya belum pernah muncul pada baris LOGIN
            if (!array_key_exists($email, $rekap)) {
                $rekap[$email] = array(
                    "email"        => $email,
                    "ip"           => "-",
                    "login_sukses" => 0,
                    "login_gagal"  => 0,
                    "akses"        => array()
                );
            }

            $rekap[$email]["akses"][] = array(
                "method" => $method,
                "url"    => $url
            );
        }
        // baris dengan jenis lain (misalnya LOGOUT) diabaikan pada rekapitulasi ini
    }

    print_r($rekap);
?>
