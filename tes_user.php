<?php
include_once("bootstrap.php");

$role1 = new Role(1, "Admin", false);
$role2 = new Role(2, "User", true); 


$user = new User(101, "Test User", "testuser@gmail.com");


$user->set_role($role1);
$user->set_role($role2);

echo "<h3>1. Data Awal User:</h3>";
echo "<pre>";
print_r($user->get_user());
echo "</pre>";

$user->set_role_aktif(1);

echo "<h3>2. Setelah set_role_aktif(1) (Role Admin Aktif):</h3>";
echo "Role Aktif Sekarang: " . $user->get_role_aktif()->get_data()['nama_role'] . "<br>";


$user->hapus_role(2);

echo "<h3>3. Setelah hapus_role(2) (Role User Dihapus):</h3>";
echo "<pre>";
print_r($user->get_user());
echo "</pre>";