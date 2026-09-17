<?php
include_once("bootstrap.php");
$db = new DBconnection();
$userModel = new UserModel($db);


$data = $userModel->find_all();

echo "<pre>";
print_r($data);
echo "</pre>";