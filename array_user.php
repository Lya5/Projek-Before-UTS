<?php
$user = array(
    "iduser" => 1,
    "nama"   => "Sani Amalia",
    "email"  => "Sani@mail.com",
    "role"   => "Admin"
);

var_dump($user);
?>

<?php
$daftar_user = array(
    "Sani@mail.com" => array("nama" => "Sani Amalia",    "role" => "Admin"),
    "siti@mail.com" => array("nama" => "Siti Aminah", "role" => "Dokter")
);

print_r($daftar_user);
echo $daftar_user["siti@mail.com"]["nama"];   // Siti Aminah
?>
