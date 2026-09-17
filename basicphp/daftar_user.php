<?php
$daftar_user = array(
    array("nama" => "John Doe",    "email" => "john@mail.com", "role" => "Admin"),
    array("nama" => "Siti Aminah", "email" => "siti@mail.com", "role" => "Dokter")
);
?>

<table border="1" cellpadding="6">
    <tr><th>No</th><th>Nama</th><th>Email</th><th>Role</th></tr>
    <?php foreach ($daftar_user as $i => $user) { ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $user["nama"] ?></td>
            <td><?= $user["email"] ?></td>
            <td><?= $user["role"] ?></td>
        </tr>
    <?php } ?>
</table>
