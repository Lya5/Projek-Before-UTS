<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once("bootstrap.php");


$user   = $_SESSION['user'] ?? null;
$email  = $user['email'] ?? ($_SESSION['email'] ?? '-');
$iduser = $user['iduser'] ?? ($_SESSION['user_id'] ?? '-');


if (class_exists('Log')) {
    Log::catat("LOGOUT", ["email" => $email, "iduser" => $iduser]);
}


$_SESSION = array();
session_destroy();


header("Location: login.php?msg=logout");
exit();