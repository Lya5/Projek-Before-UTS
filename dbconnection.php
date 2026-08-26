<?php
    $host     = "localhost";
    $port     = "5432";
    $dbname   = "kuliah_wf_2025";
    $user     = "postgres";
    $password = "";

    $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

    if (!$dbconn) {
        die("Connection failed: koneksi ke PostgreSQL tidak dapat dibuat.");
    }
?>
