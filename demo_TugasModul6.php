<?php
include_once("bootstrap.php");

try {
    $db = new DBconnection();

    echo "<h2>--- UJI TUGAS MODUL 6 ---</h2>";

    // Menyimpan berbagai jenis laporan dalam satu perulangan (Polymorphism)
    $daftar_laporan = [
        new LaporanUser($db),
        new LaporanPemilik($db)
    ];

    foreach ($daftar_laporan as $lap) {
        $lap->isi();
    }

    $db->close_connection();
} catch (DatabaseException $e) {
    echo "Kesalahan database: " . $e->getMessage();
}