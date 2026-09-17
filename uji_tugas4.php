<?php
require_once("classes.php");

// Inisialisasi User & Role
$user = new User();
$user->set_user(1, "Budi Susanto", "budi@mail.com", "12345678");

$role1 = new Role(); $role1->set_role(1, "Admin", true);   // Role aktif awal
$role2 = new Role(); $role2->set_role(2, "Dokter", false);
$role3 = new Role(); $role3->set_role(3, "Pasien", false);

$user->set_role($role1);
$user->set_role($role2);
$user->set_role($role3);

echo "<h3>1. Kondisi Awal:</h3>";
echo "Role Aktif: <b>" . $user->get_role_aktif()->get_data()['nama_role'] . "</b><br><hr>";

// Uji set_role_aktif()
$user->set_role_aktif("Dokter");
echo "<h3>2. Setelah set_role_aktif('Dokter'):</h3>";
echo "Role Aktif Sekarang: <b>" . $user->get_role_aktif()->get_data()['nama_role'] . "</b><br><hr>";

// Uji hapus_role() yang sedang aktif
$user->hapus_role("Dokter");
echo "<h3>3. Setelah hapus_role('Dokter') [Role Aktif Dihapus]:</h3>";
echo "Role Aktif Otomatis Berganti Ke: <b>" . $user->get_role_aktif()->get_data()['nama_role'] . "</b><br>";
?>