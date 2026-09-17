<?php
include_once("bootstrap.php");

try {
    $db     = new DBconnection();
    $respon = $db->send_query('SELECT * FROM role ORDER BY idrole');

    echo "status  : " . ($respon->status ? "true" : "false") . "<br>";
    echo "message : " . $respon->message . "<br>";
    echo "jumlah  : " . (is_array($respon->data) ? count($respon->data) : 0) . " baris<br><br>";

    // Query yang salah tetap mengembalikan object Respon
    $gagal = $db->send_query('SELECT * FROM tabel_tidak_ada');
    echo "status  : " . ($gagal->status ? "true" : "false") . "<br>";
    echo "message : " . $gagal->message;

    $db->close_connection();
} catch (DatabaseException $e) {
    echo "Kesalahan database: " . $e->getMessage();
}