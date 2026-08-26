<?php
    include_once("dbconnection.php");

    echo "Koneksi berhasil<br>";
    echo "Versi server: " . pg_version($dbconn)['server'];
?>
