<?php
include_once("bootstrap.php");

$daftar_pengguna = [
    new User(1, "Sani Amalia", "Sani@mail.com"),
    new Pemilik(2, "Hanifah", "Hani@mail.com", "081234567890", "Jl. Airlangga 4, Surabaya"),
];

foreach ($daftar_pengguna as $pengguna) {
    echo get_class($pengguna) . " -> " . $pengguna . "<br>";
    print_r($pengguna->get_user());
    echo "<br><br>";
}

try {
    $db = new DBconnection();
    foreach ([new UserModel($db), new RoleModel($db), new PemilikModel($db)] as $model) {
        echo get_class($model) . " -> tabel " . $model->nama_tabel() . " berisi " . count($model->find_all()) . " baris<br>";
    }
    $db->close_connection();
} catch (DatabaseException $e) {
    echo "Kesalahan database: " . $e->getMessage();
}